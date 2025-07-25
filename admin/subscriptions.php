<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
require_admin();
$subs = $conn->query("SELECT s.*, u.email, p.title FROM subscriptions s JOIN users u ON s.user_id=u.id JOIN products p ON s.product_id=p.id ORDER BY s.start_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Subscriptions</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="products.php">Products</a> |
        <a href="users.php">Users</a> |
        <a href="subscriptions.php">Subscriptions</a> |
        <a href="../logout.php">Logout</a>
    </nav>
    <div class="admin-panel">
        <h2>Manage Subscriptions</h2>
        <table>
            <tr><th>ID</th><th>User</th><th>Product</th><th>Start</th><th>End</th><th>Status</th></tr>
            <?php while($row = $subs->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= $row['start_date'] ?></td>
                    <td><?= $row['end_date'] ?></td>
                    <td><?= ucfirst($row['status']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html> 