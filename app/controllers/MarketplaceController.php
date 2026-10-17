<?php
require_once __DIR__ . '/../models/Item.php';
require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../models/SavedItem.php';

/** MarketplaceController — the main browse/search page (formerly marketplace.php). */
class MarketplaceController
{
    private Item $itemModel;
    private Reservation $reservationModel;
    private SavedItem $savedItemModel;

    public function __construct()
    {
        $this->itemModel = new Item();
        $this->reservationModel = new Reservation();
        $this->savedItemModel = new SavedItem();
    }

    public function index(): void
    {
        $is_logged_in = !empty($_SESSION['user_id']) || !empty($_SESSION['supplier_id']);
        $user_id = $_SESSION['user_id'] ?? ($_SESSION['supplier_id'] ?? 0);
        $role = $_SESSION['role'] ?? 'guest';
        $user_name = $_SESSION['name'] ?? 'Guest';

        $flash_msg = '';
        $flash_error = '';
        $saved_prompt_item = null;

        // Automatically restore stock for expired 24h reservations
        $this->reservationModel->releaseExpired();

        // Handle Customer Actions (Save, Unsave, Reserve)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $role === 'customer') {
            if (isset($_POST['action'])) {
                $action = $_POST['action'];
                $item_id = intval($_POST['item_id'] ?? 0);

                if ($action === 'save' && $item_id > 0) {
                    $this->savedItemModel->save($user_id, $item_id);
                    $flash_msg = "Item saved to your list!";

                    $prompt_data = $this->itemModel->getNameAndShop($item_id);
                    if ($prompt_data) {
                        $saved_prompt_item = [
                            'id' => $item_id,
                            'name' => $prompt_data['Itemname'],
                            'supplier_id' => $prompt_data['SupplierID'],
                            'shop_name' => $prompt_data['Shopname']
                        ];
                    }
                } elseif ($action === 'unsave' && $item_id > 0) {
                    $this->savedItemModel->unsave($user_id, $item_id);
                    $flash_msg = "Item removed from saved list.";
                } elseif ($action === 'reserve' && $item_id > 0) {
                    $item_data = $this->itemModel->getStock($item_id);
                    if ($item_data) {
                        if ($item_data['quantity'] > 0 && $item_data['availabilitystatus'] === 'IN STOCK') {
                            if ($this->reservationModel->reserve($user_id, $item_id) !== false) {
                                $new_qty = $item_data['quantity'] - 1;
                                $new_status = ($new_qty <= 0) ? 'OUT OF STOCK' : 'IN STOCK';
                                $this->itemModel->updateStockAfterReserve($item_id, $new_qty, $new_status);
                                $flash_msg = "Spare part reserved for you for 24 hours! Visit shop or chat with owner to arrange pickup.";
                            }
                        } else {
                            $flash_error = "Sorry, this item is currently out of stock.";
                        }
                    }
                }
            }
        }

        // Handle Shop Owner Item Deletion
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $role === 'owner' && isset($_POST['action']) && $_POST['action'] === 'delete_item') {
            $item_id = intval($_POST['item_id'] ?? 0);
            $row = $this->itemModel->findImageForSupplier($item_id, $user_id);
            if ($row) {
                if ($this->itemModel->deleteForSupplier($item_id, $user_id)) {
                    if (!empty($row['image_path']) && $row['image_path'] !== 'default.jpg' && file_exists($row['image_path'])) {
                        @unlink($row['image_path']);
                    }
                    $flash_msg = "Spare part successfully removed from your inventory.";
                } else {
                    $flash_error = "Error deleting item: " . $this->itemModel->getError();
                }
            }
        }

        // Search and Filter logic (Supports Vehicle Model and Spare Part Name)
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $view_tab = isset($_GET['tab']) ? trim($_GET['tab']) : 'all';

        $result = $this->itemModel->search($search, $view_tab, $role, $user_id);

        require __DIR__ . '/../views/marketplace.php';
    }
}
