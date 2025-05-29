<?php
include '../config/db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert'>Invalid email format</div>";
        exit;
    }

    // Prepare SQL to prevent injection
    $stmt = $conn->prepare("SELECT password FROM userdata WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        // Decrypt password
        $secret_key = "mySuperSecretKey123";
        $decoded_data = base64_decode($stored_password);
        $iv = substr($decoded_data, 0, 16);
        $encrypted_password = substr($decoded_data, 16);
        $decrypted_password = openssl_decrypt($encrypted_password, 'AES-128-CBC', $secret_key, 0, $iv);

        // Compare passwords
        if ($password === $decrypted_password) {
            echo "<div class='alert success'>Login successful! Redirecting...</div>";
            echo "<script>
                    setTimeout(() => {
                        window.location.href = '../admin/index.php';
                    }, 3000);
                  </script>";
        } else {
            echo "<div class='alert'>Incorrect password.</div>";
        }
    } else {
        echo "<div class='alert'>No account found with that email.</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
