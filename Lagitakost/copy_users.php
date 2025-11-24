<?php

// Database configurations
$sourceDb = 'lagitalkost';
$targetDb = 'lagitakost';
$host = 'localhost';
$user = 'root';
$pass = '';

// Connect to source database
$sourceConn = new mysqli($host, $user, $pass, $sourceDb);
if ($sourceConn->connect_error) {
    die("Source connection failed: " . $sourceConn->connect_error);
}

// Connect to target database
$targetConn = new mysqli($host, $user, $pass, $targetDb);
if ($targetConn->connect_error) {
    die("Target connection failed: " . $targetConn->connect_error);
}

// Get users from source
$result = $sourceConn->query("SELECT * FROM users");
if ($result->num_rows > 0) {
    // Disable foreign key checks
    $targetConn->query("SET FOREIGN_KEY_CHECKS = 0");

    // Truncate target users table
    $targetConn->query("TRUNCATE TABLE users");

    // Insert into target
    while ($row = $result->fetch_assoc()) {
        $name = $targetConn->real_escape_string($row['name']);
        $email = $targetConn->real_escape_string($row['email']);
        $password = $targetConn->real_escape_string($row['password']);
        $is_admin = $row['is_admin'] ? 1 : 0;
        $created_at = $targetConn->real_escape_string($row['created_at']);
        $updated_at = $targetConn->real_escape_string($row['updated_at']);

        $sql = "INSERT INTO users (name, email, password, is_admin, created_at, updated_at) VALUES ('$name', '$email', '$password', $is_admin, '$created_at', '$updated_at')";
        if ($targetConn->query($sql) !== TRUE) {
            echo "Error inserting: " . $targetConn->error;
        }
    }

    // Re-enable foreign key checks
    $targetConn->query("SET FOREIGN_KEY_CHECKS = 1");

    echo "Users copied successfully.";
} else {
    echo "No users found in source database.";
}

$sourceConn->close();
$targetConn->close();
?>
