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
    // Check if fields are set
    $full_name = isset($_POST["full_name"]) ? $_POST["full_name"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null;
    $confirm_password = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : null;

    // Validate required fields
    if (!$full_name || !$email || !$phone || !$password || !$confirm_password) {
        die("All fields are required.");
    }
     
    // Check if email already exists
$check_sql = "SELECT id FROM users WHERE email = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $email);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    die("Email already exists! Try logging in.");
}
$check_stmt->close();

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash password securely
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement
    $sql = "INSERT INTO users (full_name, email, phone, password_hash) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $full_name, $email, $phone, $password_hash);

    if ($stmt->execute()) {
        echo "<script>
    alert('Registration successful! Redirecting to login...');
    window.location.href = 'login.html';
    </script>";
exit();

        
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
