<?php
/**
 * Database
 * Single shared mysqli connection for the whole application.
 * Mirrors the original db.php behaviour exactly (same host/creds/port
 * fallback logic), just wrapped so every Model can reuse one connection
 * instead of each page opening its own.
 */
class Database
{
    private static ?mysqli $connection = null;

    public static function getConnection(): mysqli
    {
        if (self::$connection !== null) {
            return self::$connection;
        }

        $host = "127.0.0.1";
        $user = "root";
        $password = "";
        $dbname = "geargo_db";
        $primary_port = 3307;  // Configured port for XAMPP MySQL
        $fallback_port = 3306; // Default MySQL port fallback

        $conn = @new mysqli($host, $user, $password, $dbname, $primary_port);

        if ($conn->connect_error) {
            $conn = @new mysqli($host, $user, $password, $dbname, $fallback_port);
            if ($conn->connect_error) {
                die("<div style='font-family:sans-serif; padding:20px; background:#fee2e2; color:#dc2626; border-radius:8px; margin:20px;'>
                    <h3>Database Connection Failed</h3>
                    <p>Could not connect to MySQL database <strong>$dbname</strong> on ports $primary_port or $fallback_port.</p>
                    <p><strong>Error:</strong> " . htmlspecialchars($conn->connect_error) . "</p>
                    <p>Please make sure MySQL is running in your XAMPP Control Panel.</p>
                </div>");
            }
        }

        $conn->set_charset("utf8mb4");
        self::$connection = $conn;
        return self::$connection;
    }
}
