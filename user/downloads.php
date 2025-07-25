<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
require_once '../includes/access_control.php';
require_login();
$user_id = $_SESSION['user_id'];
$sql = "SELECT p.* FROM products p JOIN subscriptions s ON p.id=s.product_id WHERE s.user_id=? AND s.status='active' AND s.end_date >= CURDATE()";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$products = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Downloads</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav>
        <a href="../index.php">Home</a> |
        <a href="dashboard.php">Dashboard</a> |
        <a href="../logout.php">Logout</a>
    </nav>
    <div class="dashboard">
        <h2>My Downloads</h2>
        <div class="products">
            <?php while($row = $products->fetch_assoc()): ?>
                <div class="product-card">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                    <a href="../product.php?id=<?= $row['id'] ?>">Download</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html> 