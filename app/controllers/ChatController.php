<?php
require_once __DIR__ . '/../models/ShopOwner.php';
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/Item.php';
require_once __DIR__ . '/../models/Message.php';

/** ChatController — one-to-one buyer/owner messaging thread (formerly chat.php). */
class ChatController
{
    private ShopOwner $shopOwnerModel;
    private Customer $customerModel;
    private Item $itemModel;
    private Message $messageModel;

    public function __construct()
    {
        $this->shopOwnerModel = new ShopOwner();
        $this->customerModel = new Customer();
        $this->itemModel = new Item();
        $this->messageModel = new Message();
    }

    public function index(): void
    {
        // Authentication check
        if (empty($_SESSION['user_id']) && empty($_SESSION['supplier_id']) && empty($_SESSION['customer_id'])) {
            header("Location: login.php");
            exit();
        }
        $current_user_id = $_SESSION['user_id'] ?? ($_SESSION['customer_id'] ?? $_SESSION['supplier_id']);
        $role = $_SESSION['role'] ?? 'customer';
        $customer_id = ($role === 'customer') ? $current_user_id : intval($_GET['customer_id'] ?? 0);
        $supplier_id = ($role === 'customer') ? intval($_GET['supplier_id'] ?? 0) : $current_user_id;
        $item_id = intval($_GET['item_id'] ?? 0);
        $param_error = ($supplier_id <= 0 || $customer_id <= 0);

        if (!$param_error && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
            $msg_text = trim($_POST['message']);
            if (!empty($msg_text)) {
                $sender_type = ($role === 'customer') ? 'customer' : 'owner';
                if ($this->messageModel->send($msg_text, $customer_id, $supplier_id, $sender_type, $item_id)) {
                    $redirect_url = "chat.php?supplier_id=$supplier_id&item_id=$item_id";
                    if ($role !== 'customer') {
                        $redirect_url .= "&customer_id=$customer_id";
                    }
                    header("Location: $redirect_url");
                    exit();
                }
            }
        }

        $shop_name = 'Verified Shop';
        $customer_name = 'Customer';
        $item_details = null;
        if (!$param_error) {
            $sdata = $this->shopOwnerModel->findById($supplier_id);
            if ($sdata) {
                $shop_name = $sdata['Shopname'];
            }
            $cdata = $this->customerModel->findById($customer_id);
            if ($cdata) {
                $customer_name = $cdata['firstname'] . ' ' . $cdata['lastname'];
            }
            if ($item_id > 0) {
                $idata = $this->itemModel->getBasicDetails($item_id);
                if ($idata) {
                    $item_details = $idata;
                }
            }
            $messages_res = $this->messageModel->historyBetween($customer_id, $supplier_id);
        }

        require __DIR__ . '/../views/chat.php';
    }
}
