<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';
require_once 'includes/access_control.php';
require_login();
$product_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
if (!has_active_subscription($user_id, $product_id) && !is_admin()) die("Access denied.");
$sql = "SELECT file_path FROM products WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$file = $stmt->get_result()->fetch_assoc()['file_path'];
$file_path = "uploads/" . $file;
if (file_exists($file_path)) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
    readfile($file_path);
    exit;
} else echo "File not found."; 