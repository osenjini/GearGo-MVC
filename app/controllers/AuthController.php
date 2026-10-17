<?php
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/ShopOwner.php';

/** AuthController — sign in, sign up, and sign out (formerly login.php / register.php / logout.php). */
class AuthController
{
    private ShopOwner $shopOwnerModel;
    private Customer $customerModel;

    public function __construct()
    {
        $this->shopOwnerModel = new ShopOwner();
        $this->customerModel = new Customer();
    }

    public function login(): void
    {
        if (!empty($_SESSION['user_id']) || !empty($_SESSION['supplier_id'])) {
            header("Location: marketplace.php");
            exit();
        }

        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error_message = "Please enter both your email and password.";
            } else {
                $authenticated = false;

                // 1. Check if Shop Owner
                $owner = $this->shopOwnerModel->findByEmail($email);
                if ($owner && (password_verify($password, $owner['password']) || $password === $owner['password'])) {
                    $authenticated = true;
                    $_SESSION['user_id'] = $owner['SupplierID'];
                    $_SESSION['supplier_id'] = $owner['SupplierID'];
                    $_SESSION['role'] = 'owner';
                    $_SESSION['name'] = $owner['firstname'] . ' ' . $owner['lastname'];
                    $_SESSION['email'] = $owner['email'];
                    $_SESSION['shop_name'] = $owner['Shopname'];
                    header("Location: marketplace.php");
                    exit();
                }

                // 2. Check if Customer
                if (!$authenticated) {
                    $customer = $this->customerModel->findByEmail($email);
                    if ($customer && (password_verify($password, $customer['password']) || $password === $customer['password'])) {
                        $authenticated = true;
                        $_SESSION['user_id'] = $customer['CustomerID'];
                        $_SESSION['customer_id'] = $customer['CustomerID'];
                        $_SESSION['role'] = 'customer';
                        $_SESSION['name'] = $customer['firstname'] . ' ' . $customer['lastname'];
                        $_SESSION['email'] = $customer['email'];
                        header("Location: marketplace.php");
                        exit();
                    }
                }

                $error_message = "Invalid email or password. Please check your credentials.";
            }
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    public function register(): void
    {
        if (!empty($_SESSION['user_id']) || !empty($_SESSION['supplier_id'])) {
            header("Location: marketplace.php");
            exit();
        }

        $error_message = '';
        $success_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account_type = $_POST['account_type'] ?? 'customer'; // 'customer' or 'owner'
            $firstname = trim($_POST['firstname'] ?? '');
            $lastname = trim($_POST['lastname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phonenumber = trim($_POST['phonenumber'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            // Validation
            if (empty($firstname) || empty($lastname) || empty($email) || empty($phonenumber) || empty($password)) {
                $error_message = "Please fill in all required fields.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_message = "Please provide a valid email address.";
            } elseif (strlen($phonenumber) !== 10 || !ctype_digit($phonenumber)) {
                $error_message = "Phone number must be exactly 10 digits (e.g. 0771234567).";
            } elseif (strlen($password) < 6) {
                $error_message = "Password must be at least 6 characters long.";
            } elseif ($password !== $confirm_password) {
                $error_message = "Passwords do not match. Please re-enter.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                if ($account_type === 'owner') {
                    $shopname = trim($_POST['shopname'] ?? '');
                    $shopaddress = trim($_POST['shopaddress'] ?? '');
                    $subscription_agree = !empty($_POST['subscription_agree']);

                    // Payment card details for owner subscription
                    $card_name = trim($_POST['card_name'] ?? '');
                    $card_number = preg_replace('/\s+/', '', $_POST['card_number'] ?? '');
                    $card_expiry = trim($_POST['card_expiry'] ?? '');
                    $card_cvv = trim($_POST['card_cvv'] ?? '');

                    // Strict Tickbox & Payment Details Requirement for Shop Owners
                    if (!$subscription_agree) {
                        $error_message = "You must agree to pay the monthly subscription fee of LKR 2,000 to register as a shop owner.";
                    } elseif (empty($shopname) || empty($shopaddress)) {
                        $error_message = "Please provide your Shop Name and Shop Address.";
                    } elseif (empty($card_name)) {
                        $error_message = "Please enter the Cardholder Name for your subscription.";
                    } elseif (strlen($card_number) < 15 || strlen($card_number) > 16 || !ctype_digit($card_number)) {
                        $error_message = "Please enter a valid 16-digit Card Number.";
                    } elseif (!preg_match('/^(0[1-9]|1[0-2])\/([0-9]{2})$/', $card_expiry)) {
                        $error_message = "Please enter a valid Expiry Date in MM/YY format.";
                    } elseif (!preg_match('/^[0-9]{3,4}$/', $card_cvv)) {
                        $error_message = "Please enter a valid 3 or 4-digit CVV/CVC code.";
                    } else {
                        if ($this->shopOwnerModel->emailExistsAnywhere($email)) {
                            $error_message = "This email is already registered. Please sign in or use another email.";
                        } else {
                            $new_id = $this->shopOwnerModel->create($firstname, $lastname, $shopname, $phonenumber, $email, $shopaddress, $hashed_password);
                            if ($new_id !== false) {
                                $_SESSION['user_id'] = $new_id;
                                $_SESSION['supplier_id'] = $new_id;
                                $_SESSION['role'] = 'owner';
                                $_SESSION['name'] = $firstname . ' ' . $lastname;
                                $_SESSION['email'] = $email;
                                $_SESSION['shop_name'] = $shopname;
                                header("Location: marketplace.php?signup=success");
                                exit();
                            } else {
                                $error_message = "Registration failed.";
                            }
                        }
                    }
                } else {
                    // Customer Registration
                    $address = trim($_POST['address'] ?? '');
                    if (empty($address)) {
                        $error_message = "Please provide your residential address.";
                    } else {
                        if ($this->customerModel->emailExistsAnywhere($email)) {
                            $error_message = "This email is already registered. Please sign in or use another email.";
                        } else {
                            $new_id = $this->customerModel->create($firstname, $lastname, $email, $phonenumber, $address, $hashed_password);
                            if ($new_id !== false) {
                                $_SESSION['user_id'] = $new_id;
                                $_SESSION['customer_id'] = $new_id;
                                $_SESSION['role'] = 'customer';
                                $_SESSION['name'] = $firstname . ' ' . $lastname;
                                $_SESSION['email'] = $email;
                                header("Location: index.php?signup=success");
                                exit();
                            } else {
                                $error_message = "Registration failed.";
                            }
                        }
                    }
                }
            }
        }

        require __DIR__ . '/../views/auth/register.php';
    }

    public function logout(): void
    {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        header("Location: login.php");
        exit();
    }
}
