<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
require_login();
$product_id = $_GET['product_id'];
// Fetch product info
$sql = "SELECT * FROM products WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();
$user_id = $_SESSION['user_id'];
$amount = $product['price'];
// Simulate payment (insert payment record)
$sql = "INSERT INTO payments (user_id, product_id, amount, status) VALUES (?, ?, ?, 'success')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iid", $user_id, $product_id, $amount);
$stmt->execute();
// Create subscription
$start = date('Y-m-d');
$end = date('Y-m-d', strtotime("+{$product['duration_days']} days"));
$sql = "INSERT INTO subscriptions (user_id, product_id, start_date, end_date, status) VALUES (?, ?, ?, ?, 'active')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $user_id, $product_id, $start, $end);
$stmt->execute();
header("Location: downloads.php");
exit; 