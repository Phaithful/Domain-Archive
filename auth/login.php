<?php
include '../config/db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert alert-danger'>Invalid email format</div>";
        exit;
    }

    $stmt = $conn->prepare("SELECT password FROM userdata WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        $secret_key = "mySuperSecretKey123";
        $decoded_data = base64_decode($stored_password);
        $iv = substr($decoded_data, 0, 16);
        $encrypted_password = substr($decoded_data, 16);
        $decrypted_password = openssl_decrypt($encrypted_password, 'AES-128-CBC', $secret_key, 0, $iv);

        if ($password === $decrypted_password) {
            echo "<div class='alert alert-success'>Login successful! Redirecting...</div>";
        } else {
            echo "<div class='alert alert-danger'>Incorrect password.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>No account found with that email.</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
