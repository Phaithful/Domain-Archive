<?php
// Debugging settings
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

header('Content-Type: application/json');

// Include DB connection
include '../config/db-connect.php';

// Include PHPMailer dependencies via Composer autoload
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Ensure POST method
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

// Sanitize and validate email
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email address"]);
    exit;
}

// Check if email exists in database
$stmt = $conn->prepare("SELECT email FROM userdata WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo json_encode(["status" => "error", "message" => "No account found with that email"]);
    exit;
}

// Generate OTP and expiry
$otp = random_int(100000, 999999);
$otp_expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

// Save OTP and expiry to database
$update = $conn->prepare("UPDATE userdata SET reset_pwd_link = ?, pass_expire = ? WHERE email = ?");
$update->bind_param("sss", $otp, $otp_expiry, $email);

if (!$update->execute()) {
    echo json_encode(["status" => "error", "message" => "Failed to save OTP. Try again later."]);
    exit;
}

// Send OTP via Gmail SMTP using PHPMailer
$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;

    // 🔐 Your Gmail and 16-char App Password
    $mail->Username   = 'danassco360@gmail.com'; // <-- replace with your Gmail
    $mail->Password   = 'fjvuyrphwfdpxwqf'; // <-- no spaces, no quotes

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Sender & recipient
    $mail->setFrom('danassco360@gmail.com', 'Domain Archive');
    $mail->addAddress($email);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Your OTP Code';
    $mail->Body    = "
        <p>Hello,</p>
        <p>Your OTP code is <strong>$otp</strong>.</p>
        <p>This code will expire in 10 minutes.</p>
        <p>If you did not request a password reset, please ignore this message.</p>
    ";

    $mail->send();

    echo json_encode(["status" => "success", "message" => "OTP sent", "email" => $email]);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Mailer Error: " . $mail->ErrorInfo]);
}
?>
