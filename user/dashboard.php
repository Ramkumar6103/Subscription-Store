<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
require_login();
$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];
$sql = "SELECT p.title, s.start_date, s.end_date, s.status FROM subscriptions s JOIN products p ON s.product_id=p.id WHERE s.user_id=? ORDER BY s.end_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$subs = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav>
        <a href="../index.php">Home</a> |
        <a href="downloads.php">My Downloads</a> |
        <a href="../logout.php">Logout</a>
    </nav>
    <div class="dashboard">
        <h2>Welcome, <?= htmlspecialchars($name) ?></h2>
        <h3>Your Subscriptions</h3>
        <table>
            <tr><th>Product</th><th>Start</th><th>End</th><th>Status</th></tr>
            <?php while($row = $subs->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= $row['start_date'] ?></td>
                    <td><?= $row['end_date'] ?></td>
                    <td><?= ucfirst($row['status']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <a href="../index.php">Subscribe to more products</a>
    </div>
</body>
</html> 