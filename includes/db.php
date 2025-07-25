<?php
$conn = new mysqli("localhost", "root", "", "subscription_store");
if ($conn->connect_error) die("DB Connection failed: " . $conn->connect_error);
?>