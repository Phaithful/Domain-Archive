<?php
header('Content-Type: application/json');
include '../config/db-connect.php';

$email = $_POST['email'] ?? '';
$token = $_POST['token'] ?? '';
$newPassword = $_POST['new_password'] ?? '';

if (!$email || !$token || !$newPassword) {
    echo json_encode(["status" => "error", "message" => "Missing fields"]);
    exit;
}

// Validate token
$stmt = $conn->prepare("SELECT reset_pwd_link, pass_expire FROM userdata WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

$stmt->bind_result($storedToken, $expiry);
$stmt->fetch();

if ($storedToken !== $token) {
    echo json_encode(["status" => "error", "message" => "Invalid token"]);
    exit;
}

if (strtotime($expiry) < time()) {
    echo json_encode(["status" => "error", "message" => "Token has expired"]);
    exit;
}

// Hash password
$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

// Update password & clear token fields
$update = $conn->prepare("UPDATE userdata SET password = ?, reset_pwd_link = NULL, pass_expire = NULL WHERE email = ?");
$update->bind_param("ss", $hashedPassword, $email);
$update->execute();

echo json_encode(["status" => "success", "message" => "Password reset successful"]);
?>
