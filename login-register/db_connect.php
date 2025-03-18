<?php
// Load .env variables
$env_file = __DIR__ . '/../.env';
if (!file_exists($env_file)) {
    error_log("Error: .env file not found.");
    die("Internal Server Error. Please contact support.");
}

$lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    putenv(trim($line)); // Load each line as an environment variable
}

// Get database credentials from environment
$servername = getenv("DB_HOST");
$username = getenv("DB_USER");
$password = getenv("DB_PASS");
$dbname = getenv("DB_NAME");

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Internal Server Error. Please try again later.");
}
?>
