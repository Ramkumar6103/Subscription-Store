<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
require_admin();
$users = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
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
        <h2>Manage Users</h2>
        <table>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Registered</th></tr>
            <?php while($row = $users->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= $row['role'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html> 