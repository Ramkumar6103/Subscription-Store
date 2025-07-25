<?php
require_once 'db.php';
function has_active_subscription($user_id, $product_id) {
    global $conn;
    $today = date('Y-m-d');
    $sql = "SELECT * FROM subscriptions WHERE user_id=? AND product_id=? AND status='active' AND end_date >= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $user_id, $product_id, $today);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}
?>