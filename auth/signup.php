<?php
include '../config/db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $fname = htmlspecialchars(trim($_POST['fname']));
    $lname = htmlspecialchars(trim($_POST['lname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert'>Invalid email format</div>";
        exit;
    }

    // AES encryption config
    $secret_key = "mySuperSecretKey123"; // Use env or config in production
    $iv = openssl_random_pseudo_bytes(16);
    $encrypted_password = openssl_encrypt($password, 'AES-128-CBC', $secret_key, 0, $iv);

    // Encode IV with password so it can be decoded later
    $encrypted_password_with_iv = base64_encode($iv . $encrypted_password);

    // Use email as username
    $username = $email;

    // Store data (include `username`)
    $stmt = $conn->prepare("INSERT INTO userdata (username, firstname, lastname, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $fname, $lname, $email, $encrypted_password_with_iv);

    if ($stmt->execute()) {
        echo "<div class='alert success'>Registration successful!</div>";
        echo "<script>
                setTimeout(() => {
                window.location.href = '../login.php';
                }, 3000);
            </script>";
    } else {
        echo "<div class='alert'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
