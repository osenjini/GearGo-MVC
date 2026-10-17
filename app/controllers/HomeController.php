<?php

/** HomeController — the public landing page (formerly index.php). */
class HomeController
{
    public function index(): void
    {
        $is_logged_in = !empty($_SESSION['user_id']) || !empty($_SESSION['supplier_id']);
        $user_name = !empty($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'User';
        $user_role = !empty($_SESSION['role']) ? $_SESSION['role'] : 'customer';

        require __DIR__ . '/../views/home.php';
    }
}
