<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
require_admin();
// Add product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration_days'];
    $file = $_FILES['file']['name'];
    $target = '../uploads/' . basename($file);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
        $sql = "INSERT INTO products (title, description, file_path, price, duration_days) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdi", $title, $desc, $file, $price, $duration);
        $stmt->execute();
    }
}
// Delete product
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$id");
}
$products = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
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
        <h2>Manage Products</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" required><br>
            <textarea name="description" placeholder="Description" required></textarea><br>
            <input type="number" name="price" placeholder="Price" step="0.01" required><br>
            <input type="number" name="duration_days" placeholder="Duration (days)" required><br>
            <input type="file" name="file" required><br>
            <button type="submit">Add Product</button>
        </form>
        <h3>Product List</h3>
        <table>
            <tr><th>ID</th><th>Title</th><th>Price</th><th>Duration</th><th>File</th><th>Action</th></tr>
            <?php while($row = $products->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td>$<?= $row['price'] ?></td>
                    <td><?= $row['duration_days'] ?> days</td>
                    <td><?= htmlspecialchars($row['file_path']) ?></td>
                    <td><a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete?')">Delete</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html> 