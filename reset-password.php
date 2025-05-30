<?php
// Prevent unauthorized access — token and email must be present
$token = $_GET['token'] ?? '';
$email = $_GET['email'] ?? '';

if (!$token || !$email) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | Domain Archive</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="hero">
        <!-- Left: Info block -->
        <div class="container details-div">
            <div class="logo"><img src="images/logo.png" alt="logo"></div>
            <h1>Access Solutions <br> Limited</h1>
            <h2>Domain Archive</h2>
            <hr class="underline">
            <p>Enter your new password to regain secure access to your Domain Archive.</p>
        </div>

        <!-- Right: Reset Form -->
        <div class="container form-div">
            <h1 class="welcome-txt">Reset Your Password</h1>
            <hr class="welcome-line">

            <div class="form-bg">
                <form id="resetForm">
                    <input type="hidden" id="email" value="<?= htmlspecialchars($email) ?>">
                    <input type="hidden" id="token" value="<?= htmlspecialchars($token) ?>">

                    <input class="form-control" type="password" id="new_password" placeholder="New Password" required>
                    <input class="form-control" type="password" id="confirm_password" placeholder="Confirm Password" required>

                    <input type="submit" value="RESET PASSWORD" class="submit mt-3">
                    <a href="login.php">Back to login</a>
                </form>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="reset-password.js"></script>
</body>
</html>
