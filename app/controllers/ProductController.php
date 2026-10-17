<?php
require_once __DIR__ . '/../models/Item.php';
require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../models/SavedItem.php';
require_once __DIR__ . '/../models/Review.php';

/** ProductController — single item detail/review/reserve page (formerly product-details.php). */
class ProductController
{
    private Item $itemModel;
    private Reservation $reservationModel;
    private SavedItem $savedItemModel;
    private Review $reviewModel;

    public function __construct()
    {
        $this->itemModel = new Item();
        $this->reservationModel = new Reservation();
        $this->savedItemModel = new SavedItem();
        $this->reviewModel = new Review();
    }

    public function show(): void
    {
        $is_logged_in = !empty($_SESSION['user_id']) || !empty($_SESSION['supplier_id']);
        $user_id = $_SESSION['user_id'] ?? ($_SESSION['customer_id'] ?? 0);
        $role = $_SESSION['role'] ?? 'guest';
        $user_name = $_SESSION['name'] ?? 'User';
        $item_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($item_id <= 0) {
            header("Location: marketplace.php");
            exit();
        }

        $flash_msg = '';
        $flash_error = '';

        // Handle Customer Actions (Reserve, Save, Review)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $role === 'customer') {
            // 1. Submit Review
            if (isset($_POST['submit_review'])) {
                $rating = intval($_POST['rating'] ?? 5);
                $review_text = trim($_POST['review_text'] ?? '');
                if ($rating >= 1 && $rating <= 5 && !empty($review_text)) {
                    if ($this->reviewModel->create($rating, $review_text, $user_id, $item_id)) {
                        $flash_msg = "Thank you! Your verified review and rating have been posted.";
                    } else {
                        $flash_error = "Error saving review: " . $this->reviewModel->lastError;
                    }
                } else {
                    $flash_error = "Please choose a rating and write a short review.";
                }
            }
            // 2. Reserve Item
            if (isset($_POST['action']) && $_POST['action'] === 'reserve') {
                $item_data = $this->itemModel->getStock($item_id);
                if ($item_data) {
                    if ($item_data['quantity'] > 0 && $item_data['availabilitystatus'] === 'IN STOCK') {
                        if ($this->reservationModel->reserve($user_id, $item_id) !== false) {
                            $new_qty = $item_data['quantity'] - 1;
                            $new_status = ($new_qty <= 0) ? 'OUT OF STOCK' : 'IN STOCK';
                            $this->itemModel->updateStockAfterReserve($item_id, $new_qty, $new_status);
                            $flash_msg = "Spare part reserved for you for 24 hours! You can now visit the shop or message the owner.";
                        }
                    } else {
                        $flash_error = "Sorry, this item is currently out of stock.";
                    }
                }
            }
            // 3. Save Item
            if (isset($_POST['action']) && $_POST['action'] === 'save') {
                $this->savedItemModel->save($user_id, $item_id);
                $flash_msg = "Item saved to your list! Message the shop owner below if you have any questions.";
            }
        }

        // Fetch Item & Shop Owner details
        $item = $this->itemModel->findWithShop($item_id);
        if (!$item) {
            header("Location: marketplace.php");
            exit();
        }

        // Parse Vehicle Model and Spare Part Name
        $raw_name = $item['Itemname'];
        $vehicle_model = 'Universal Fit';
        $part_name = $raw_name;
        if (strpos($raw_name, ' - ') !== false) {
            $split = explode(' - ', $raw_name, 2);
            $vehicle_model = trim($split[0]);
            $part_name = trim($split[1]);
        } elseif (strpos($raw_name, ' | ') !== false) {
            $split = explode(' | ', $raw_name, 2);
            $vehicle_model = trim($split[0]);
            $part_name = trim($split[1]);
        }
        $is_in_stock = ($item['availabilitystatus'] === 'IN STOCK' && $item['quantity'] > 0);
        $item_image = (!empty($item['image_path']) && file_exists($item['image_path'])) ? $item['image_path'] : 'default.jpg';

        // Fetch Reviews for this Item
        $reviews_result = $this->reviewModel->forItem($item_id);
        $total_reviews = $reviews_result ? $reviews_result->num_rows : 0;
        $avg_rating = 0;
        if ($total_reviews > 0) {
            $avg_rating = $this->reviewModel->averageRating($item_id);
        }

        require __DIR__ . '/../views/product/details.php';
    }
}
