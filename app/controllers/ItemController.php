<?php
require_once __DIR__ . '/../models/Item.php';

/** ItemController — owner-only listing management (formerly add_item.php / edit_item.php). */
class ItemController
{
    private Item $itemModel;

    public function __construct()
    {
        $this->itemModel = new Item();
    }

    /** Handles the item_photo upload; returns the stored path, or null with $error set on failure. */
    private function handleUpload(?string &$error): ?string
    {
        if (!isset($_FILES['item_photo']) || $_FILES['item_photo']['error'] !== 0) {
            return null;
        }
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_ext = strtolower(pathinfo($_FILES["item_photo"]["name"], PATHINFO_EXTENSION));
        $allowed_exts = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($file_ext, $allowed_exts)) {
            $error = "Invalid image format. Allowed formats: JPG, JPEG, PNG, WEBP.";
            return null;
        }
        $filename = time() . "_" . uniqid() . "." . $file_ext;
        $target_file = $target_dir . $filename;
        if (move_uploaded_file($_FILES["item_photo"]["tmp_name"], $target_file)) {
            return $target_file;
        }
        return null;
    }

    public function add(): void
    {
        // Authorization check: ONLY Spare Parts Shop Owners can access this page
        if (empty($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'owner') {
            header("Location: marketplace.php");
            exit();
        }
        $supplier_id = $_SESSION['supplier_id'] ?? $_SESSION['user_id'];
        $error = '';
        $success = '';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $vehicle_model = trim($_POST['vehicle_model'] ?? '');
            $part_name = trim($_POST['part_name'] ?? '');
            $price = floatval($_POST['price'] ?? 0);
            $quantity = intval($_POST['quantity'] ?? 0);
            $status = ($quantity > 0) ? 'IN STOCK' : 'OUT OF STOCK';

            if (empty($vehicle_model) || empty($part_name)) {
                $error = "Please provide both Vehicle Model and Spare Part Name.";
            } elseif ($price <= 0) {
                $error = "Please enter a valid Price (LKR) greater than 0.";
            } elseif ($quantity < 1) {
                $error = "Quantity must be at least 1.";
            } else {
                $combined_item_name = $vehicle_model . " - " . $part_name;

                $image_path = 'default.jpg';
                $uploaded = $this->handleUpload($error);
                if ($uploaded !== null) {
                    $image_path = $uploaded;
                }

                if (empty($error)) {
                    $new_item_id = $this->itemModel->create($supplier_id, $combined_item_name, $price, $quantity, $status, $image_path);
                    if ($new_item_id !== false) {
                        header("Location: marketplace.php?item_added=success");
                        exit();
                    } else {
                        $error = "Database Error: " . $this->itemModel->getError();
                    }
                }
            }
        }

        require __DIR__ . '/../views/item/add.php';
    }

    public function edit(): void
    {
        // Authorization check: Only Shop Owners can edit items
        if (empty($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'owner') {
            header("Location: marketplace.php");
            exit();
        }
        $supplier_id = $_SESSION['supplier_id'] ?? $_SESSION['user_id'];
        $item_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $error = '';
        $success = '';

        // Fetch existing item details
        $item = $this->itemModel->findForSupplier($item_id, $supplier_id);
        if (!$item) {
            echo "<script>alert('Item not found or permission denied.'); window.location='marketplace.php';</script>";
            exit();
        }

        // Handle Delete Request
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'delete') {
            if (!empty($item['image_path']) && $item['image_path'] !== 'default.jpg' && file_exists($item['image_path'])) {
                @unlink($item['image_path']);
            }
            $this->itemModel->deleteForSupplier($item_id, $supplier_id);
            header("Location: marketplace.php?item_deleted=success");
            exit();
        }

        // Parse existing Vehicle Model and Part Name
        $raw_item_name = $item['Itemname'];
        $existing_vehicle_model = "Universal Fit";
        $existing_part_name = $raw_item_name;
        if (strpos($raw_item_name, ' - ') !== false) {
            $parts = explode(' - ', $raw_item_name, 2);
            $existing_vehicle_model = trim($parts[0]);
            $existing_part_name = trim($parts[1]);
        } elseif (strpos($raw_item_name, ' | ') !== false) {
            $parts = explode(' | ', $raw_item_name, 2);
            $existing_vehicle_model = trim($parts[0]);
            $existing_part_name = trim($parts[1]);
        }

        // Handle Update Request
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'update') {
            $vehicle_model = trim($_POST['vehicle_model'] ?? '');
            $part_name = trim($_POST['part_name'] ?? '');
            $price = floatval($_POST['price'] ?? 0);
            $quantity = intval($_POST['quantity'] ?? 0);
            $status = $_POST['status'] ?? 'IN STOCK';
            if ($quantity <= 0) {
                $status = 'OUT OF STOCK';
            }
            if (!empty($vehicle_model)) {
                $combined_name = $vehicle_model . " - " . $part_name;
            } else {
                $combined_name = $part_name;
            }

            $image_path = $item['image_path'];
            $uploaded = $this->handleUpload($error);
            if ($uploaded !== null) {
                if (!empty($item['image_path']) && $item['image_path'] !== 'default.jpg' && file_exists($item['image_path'])) {
                    @unlink($item['image_path']);
                }
                $image_path = $uploaded;
            }

            if (empty($error)) {
                if ($this->itemModel->update($item_id, $supplier_id, $combined_name, $price, $quantity, $status, $image_path)) {
                    header("Location: marketplace.php?item_updated=success");
                    exit();
                } else {
                    $error = "Update failed: " . $this->itemModel->lastError;
                }
            }
        }

        require __DIR__ . '/../views/item/edit.php';
    }
}
