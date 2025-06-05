<?php
header('Content-Type: application/json');
include '../config/db-connect.php';

$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$token = $_POST['token'] ?? '';
$newPassword = $_POST['new_password'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !$token || !$newPassword) {
    echo json_encode(["status" => "error", "message" => "Missing or invalid fields"]);
    exit;
}

// Validate token
$stmt = $conn->prepare("SELECT reset_token, reset_token_expiry FROM userdata WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

$stmt->bind_result($storedToken, $expiry);
$stmt->fetch();

if (!$storedToken || !$expiry || $storedToken !== $token) {
    echo json_encode(["status" => "error", "message" => "Invalid token"]);
    exit;
}

if (strtotime($expiry) < time()) {
    echo json_encode(["status" => "error", "message" => "Token has expired"]);
    exit;
}

// Encrypt the new password using AES (same method as your login/signup)
$secret_key = "mySuperSecretKey123";
$iv = openssl_random_pseudo_bytes(16);
$encrypted = openssl_encrypt($newPassword, 'AES-128-CBC', $secret_key, 0, $iv);
$storedPassword = base64_encode($iv . $encrypted);

// Update password & clear token fields
$update = $conn->prepare("UPDATE userdata SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE email = ?");
$update->bind_param("ss", $storedPassword, $email);
$update->execute();

if ($update->affected_rows > 0) {
    echo json_encode(["status" => "success", "message" => "Password reset successful"]);
} else {
    echo json_encode(["status" => "error", "message" => "Could not update password"]);
}
?>
