<?php
session_start(); // Add this at the very top

// Connect to DB
include '../../config/db-connect.php';

// Logged in user (from session)
$logged_in_user = $_SESSION['username'] ?? ''; // Replace 'username' if you're using a different key

// Get POST data
$domain_name = $_POST['domain_name'] ?? '';
$purchase_date = $_POST['purchase_date'] ?? '';
$expiry_date = $_POST['expiry_date'] ?? '';
$registrar = $_POST['registrar'] ?? '';

// Validate inputs
if (empty($domain_name) || empty($purchase_date) || empty($expiry_date) || empty($registrar) || empty($logged_in_user)) {
    echo "All fields are required.";
    exit;
}

// Insert with both domain_registered_by and registrar
$sql = "INSERT INTO domain_table (domain_name, purchase_date, expiry_date, domain_registered_by, registrar) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo "Prepare failed: " . $conn->error;
    exit;
}

$stmt->bind_param("sssss", $domain_name, $purchase_date, $expiry_date, $logged_in_user, $registrar);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Database error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
