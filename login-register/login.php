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
    $password = isset($_POST["password"]) ? $_POST["password"] : null;

    if (!$email || !$password) {
        die("Please enter both email and password.");
    }

    $sql = "SELECT id, full_name, password_hash FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();  // ✅ Needed before fetching
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $full_name, $password_hash);
        $stmt->fetch();
        if (password_verify($password, $password_hash)) {
            session_start();
            $_SESSION["user_id"] = $id;
            $_SESSION["full_name"] = $full_name;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with this email.";
    }
    $stmt->close();
    $conn->close();
    
}
?>
