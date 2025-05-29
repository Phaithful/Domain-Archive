<?php
include '../config/db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $fname = htmlspecialchars(trim($_POST['fname']));
    $lname = htmlspecialchars(trim($_POST['lname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $username = $email; // Use email as username

    // === Server-side Validation ===
    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<div class='alert'>All fields are required.</div>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert'>Invalid email format.</div>";
        exit;
    }

    if (strlen($password) < 6) {
        echo "<div class='alert'>Password must be at least 6 characters long.</div>";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "<div class='alert'>Passwords do not match.</div>";
        exit;
    }

    // Check if email already exists
    $check_stmt = $conn->prepare("SELECT username FROM userdata WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "<div class='alert'>An account with this email already exists.</div>";
        $check_stmt->close();
        exit;
    }
    $check_stmt->close();

    // AES encryption
    $secret_key = "mySuperSecretKey123"; // Use env/config in production
    $iv = openssl_random_pseudo_bytes(16);
    $encrypted_password = openssl_encrypt($password, 'AES-128-CBC', $secret_key, 0, $iv);
    $encrypted_password_with_iv = base64_encode($iv . $encrypted_password);

    // Insert user
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
        echo "<div class='alert'>Error: " . htmlspecialchars($stmt->error) . "</div>";
                echo "<script>
                setTimeout(() => {
                window.location.href = '../index.php';
                }, 3000);
            </script>";
        
    }

    $stmt->close();
    $conn->close();
}
?>
