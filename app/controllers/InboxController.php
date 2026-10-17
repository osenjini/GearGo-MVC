<?php
require_once __DIR__ . '/../models/Message.php';

/** InboxController — a shop owner's list of customer chat threads (formerly inbox.php). */
class InboxController
{
    private Message $messageModel;

    public function __construct()
    {
        $this->messageModel = new Message();
    }

    public function index(): void
    {
        // Authorization check: Only Shop Owners can access the shop inbox
        if (empty($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'owner') {
            header("Location: login.php");
            exit();
        }
        $supplier_id = $_SESSION['supplier_id'] ?? $_SESSION['user_id'];
        $user_name = $_SESSION['name'] ?? 'Shop Owner';

        $result = $this->messageModel->inboxForSupplier($supplier_id);

        require __DIR__ . '/../views/inbox.php';
    }
}
