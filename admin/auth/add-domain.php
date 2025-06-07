<?php
session_start(); // Start session at the top

include '../../config/db-connect.php';

// Get the logged-in user (adjust key if you store it differently)
$logged_in_user = $_SESSION['username'] ?? '';

$domain_name = $_POST['domain_name'] ?? '';
$purchase_date = $_POST['purchase_date'] ?? '';
$expiry_date = $_POST['expiry_date'] ?? '';
$registrar = $_POST['registrar'] ?? '';
$auto_renew = isset($_POST['auto_renew']) ? (int)$_POST['auto_renew'] : 0; // Cast to int: 1 or 0

// Basic validation
if (
    empty($domain_name) ||
    empty($purchase_date) ||
    empty($expiry_date) ||
    empty($registrar) ||
    empty($logged_in_user)
) {
    echo "All fields are required.";
    exit;
}

// Prepare SQL with auto_renew
$sql = "INSERT INTO domain_table (domain_name, purchase_date, expiry_date, domain_registered_by, registrar, auto_renew)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo "Prepare failed: " . $conn->error;
    exit;
}

$stmt->bind_param("sssssi", $domain_name, $purchase_date, $expiry_date, $logged_in_user, $registrar, $auto_renew);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Database error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
