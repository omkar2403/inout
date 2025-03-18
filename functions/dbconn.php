<?php
// declare(strict_types=1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "root";
$db = "inout";
$koha_db = "koha_library";

date_default_timezone_set("Asia/Kolkata");

try {
    $conn = new mysqli($servername, $username, $password, $db);
    $koha = new mysqli($servername, $username, $password, $koha_db);
    $conn->set_charset("utf8mb4");
    $koha->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

function sanitize(mysqli $conn, string|null $str): string {
    return $str !== null ? $conn->real_escape_string($str) : '';
}
?>
