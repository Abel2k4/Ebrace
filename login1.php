<?php
// Replace these values with your actual database credentials
$servername = "localhost";
$dbname = "ebrace";

// Create connection
$conn = new mysqli($servername, "root", "", $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password (this should match the hashing method used during registration)
    // For example, using password_hash and PASSWORD_BCRYPT
    // $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Query the database to check user credentials
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $row["password"])) {
            // Authentication successful
            echo "Login successful!";
            header("location:abu.html");
        } else {
            // Invalid password
            echo "Invalid password";
            
        }
    } else {
        // User not found
        echo "User not found";
    }
}

// Close the database connection
$conn->close();
?>
