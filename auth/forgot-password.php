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
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    error_log("Invalid email: $email");
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
$update = $conn->prepare("UPDATE userdata SET reset_otp = ?, reset_otp_expiry = ? WHERE email = ?");
$update->bind_param("sss", $otp, $otp_expiry, $email);


if (!$update->execute()) {
    echo json_encode(["status" => "error", "message" => "Failed to save OTP. Try again later."]);
    exit;
}

// Send OTP via Gmail SMTP using PHPMailer
$mail = new PHPMailer(true);
 try {     
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'danassco360@gmail.com'; // your Gmail
    $mail->Password   = 'clhpkpoqqdaquoiz'; // your App Password
    $mail->SMTPSecure = "tls"; // Use TLS encryption
    $mail->Port       = 587;


    $mail->setFrom('danassco360@gmail.com', 'Domains Archive'); // same as username
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Your OTP Code';
    $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
        <meta charset="UTF-8">
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap");
        </style>
        </head>
        <body style="margin: 0; padding: 0; background-color: #181a1e; font-family: Montserrat, sans-serif; color: #edeffd;">

        <div style="max-width: 600px; margin: 40px auto; background-color: #1f2126; padding: 30px; border-radius: 10px;">
            <h2 style="color: #bd3470; margin-bottom: 20px;">Verify Your Email Address</h2>

            <p style="font-size: 16px; line-height: 1.6;">Hello,</p>
            <p style="font-size: 16px; line-height: 1.6;">
            Please use the following One-Time Password (OTP):
            </p>

            <div style="background-color: transparent; color: white; padding: 0 25px; font-size: 50px; font-weight: 900; text-align: left; border-radius: 8px; letter-spacing: 7px; margin: 20px 0;">
                ' . $otp . '
            </div>

            <p style="font-size: 16px; line-height: 1.6;">
            This passcode will expire in <strong>10 minutes</strong>.
            </p>

            <p style="font-size: 14px; color: #999999; margin-top: 30px;">
            If you did not request this, you can safely ignore this email.
            </p>

            <p style="font-size: 14px; color: #999999;"> Access Solution Limited</p>
        </div>

        </body>
        </html>';
    $mail->send();

    echo json_encode(["status" => "success", "message" => "OTP sent", "email" => $email]);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Mailer Error: " . $mail->ErrorInfo]);
}
?>

