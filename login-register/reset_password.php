<?php
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST["email"]) ? $_POST["email"] : null;

    if (!$email) {
        die("Email is required.");
    }

    // Check if email exists in the database
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Generate a new random password
        $new_password = bin2hex(random_bytes(8));  // Generate a secure random password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $update_sql = "UPDATE users SET password_hash=? WHERE email=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $hashed_password, $email);
        
        if ($update_stmt->execute()) {
            // Send email to the user with the new password
            $to = $email;
            $subject = "Your Password Reset - NomNomGo";
            $message = "Hello,\n\nYour password has been reset successfully. Your new password is: " . $new_password . "\n\nPlease log in and change it immediately.";
            $headers = "From: no-reply@nomnomgo.com\r\n";

            mail($to, $subject, $message, $headers);

            // Redirect to login page
            header("Location: login.html?reset=success");
            exit();
        } else {
            echo "Error updating password.";
        }

        $update_stmt->close();
    } else {
        echo "No account found with this email.";
    }

    $stmt->close();
    $conn->close();
}
?>
