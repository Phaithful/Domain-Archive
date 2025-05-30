<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../config/db-connect.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$otp = trim($_POST['otp'] ?? '');

if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^\d{6}$/', $otp)) {
    echo json_encode(["status" => "error", "message" => "Invalid email or OTP"]);
    exit;
}

// 🔍 Fetch OTP and expiry
$stmt = $conn->prepare("SELECT reset_otp, reset_otp_expiry FROM userdata WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($storedOtp, $otpExpiry);
$stmt->fetch();

if (!$stmt->num_rows || !$storedOtp || $storedOtp !== $otp) {
    echo json_encode(["status" => "error", "message" => "Invalid OTP"]);
    exit;
}

if (strtotime($otpExpiry) < time()) {
    echo json_encode(["status" => "error", "message" => "OTP has expired"]);
    exit;
}

// ✅ OTP is valid — generate token
$token = bin2hex(random_bytes(32));
$tokenExpiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

// 🔁 Update DB
$update = $conn->prepare("
    UPDATE userdata 
    SET reset_token = ?, reset_token_expiry = ?, reset_otp = NULL, reset_otp_expiry = NULL 
    WHERE email = ?
");
$update->bind_param("sss", $token, $tokenExpiry, $email);
$update->execute();

echo json_encode([
    "status" => "success",
    "message" => "OTP verified",
    "token" => $token,
    "email" => $email
]);
?>
