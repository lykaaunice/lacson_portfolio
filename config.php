<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'lacson_portfolio_db';
$conn = null;

try {
    mysqli_report(MYSQLI_REPORT_OFF);
    $candidate = @new mysqli($host, $user, $pass, $db);
    if (!$candidate->connect_errno) {
        $candidate->set_charset('utf8mb4');
        $conn = $candidate;
    }
} catch (Throwable $e) {
    $conn = null;
}
?>
