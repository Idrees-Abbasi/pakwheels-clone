<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pakwheels_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Queries to get counts
$productCount = $conn->query("SELECT COUNT(*) AS count FROM products")->fetch_assoc()['count'];
$userCount    = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];
$sellerCount  = $conn->query("SELECT COUNT(*) AS count FROM sellers")->fetch_assoc()['count'];
$adminCount   = $conn->query("SELECT COUNT(*) AS count FROM admins")->fetch_assoc()['count'];

// Return JSON response
echo json_encode([
    "products" => $productCount,
    "users"    => $userCount,
    "sellers"  => $sellerCount,
    "admins"   => $adminCount
]);

$conn->close();
?>
