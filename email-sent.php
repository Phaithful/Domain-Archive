<?php
// Get email from GET param — make sure you redirect from forgot-password with ?email=...
$email = $_GET['email'] ?? null;

if (!$email) {
    echo "Email not provided. Cannot proceed.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domain Archive</title>

    <!-- CSS and Fonts -->
    <link rel="stylesheet" href="email-sent.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

<!-- Nav Bar -->
<nav class="nav-bar">
    <div class="left-nav">
        <a href="https://accessng.com/">
            <img src="images/logo.png" alt="logo" width="50" height="46">
            <p class="name-txt">Access Solutions Limited</p>
        </a>
    </div>
    <div class="right-nav">
        <p>Don't have an account? <a href="index.php">Sign In</a></p>
    </div>
</nav>

<!-- OTP Section -->
<section class="hero">
    <img src="images/icons/sent-email.png" alt="Email Sent Icon" class="sent-img">
    <h1>Check your Email</h1>
    <p>We emailed a 6-digit code to <strong><?= htmlspecialchars($email) ?></strong>.<br>Enter the code below to recover your account.</p>

    <!-- Hidden input to make email available in JS -->
    <input type="hidden" id="user-email" value="<?= htmlspecialchars($email) ?>">

    <div class="inputs-div">
        <input type="text" class="otp" inputmode="numeric" maxlength="1" required>
        <input type="text" class="otp" inputmode="numeric" maxlength="1" required>
        <input type="text" class="otp" inputmode="numeric" maxlength="1" required>
        <input type="text" class="otp" inputmode="numeric" maxlength="1" required>
        <input type="text" class="otp" inputmode="numeric" maxlength="1" required>
        <input type="text" class="otp" inputmode="numeric" maxlength="1" required>
    </div>

    <button id="clearOtp" class="btn btn-outline-secondary clear-btn">Clear Code</button>

    <input type="submit" name="submit" value="Verify Code" class="submit">

    <a href="forgot-password.php" class="back-to-login">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#323842" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5"/>
        </svg>
        <p>Resend Code</p>
    </a>

    <p class="no-account">Don't have an account? <a href="index.php">Sign In</a></p>
</section>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="email-sent.js"></script>

</body>
</html>
