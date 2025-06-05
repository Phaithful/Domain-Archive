<?php
include '../config/db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = htmlspecialchars(trim($_POST['fname']));
    $lname = htmlspecialchars(trim($_POST['lname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $username = $email;

    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<div class='alert alert-danger'>All fields are required.</div>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert alert-danger'>Invalid email format.</div>";
        exit;
    }

    if (strlen($password) < 6) {
        echo "<div class='alert alert-danger'>Password must be at least 6 characters long.</div>";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "<div class='alert alert-danger'>Passwords do not match.</div>";
        exit;
    }

    $check_stmt = $conn->prepare("SELECT username FROM userdata WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "<div class='alert alert-danger'>An account with this email already exists.</div>";
        $check_stmt->close();
        exit;
    }
    $check_stmt->close();

    $secret_key = "mySuperSecretKey123";
    $iv = openssl_random_pseudo_bytes(16);
    $encrypted_password = openssl_encrypt($password, 'AES-128-CBC', $secret_key, 0, $iv);
    $encrypted_password_with_iv = base64_encode($iv . $encrypted_password);

    $stmt = $conn->prepare("INSERT INTO userdata (username, firstname, lastname, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $fname, $lname, $email, $encrypted_password_with_iv);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Registration successful! Redirecting...</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . htmlspecialchars($stmt->error) . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
