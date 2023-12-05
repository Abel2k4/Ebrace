<?php

$servername = "localhost";
$dbname = "ebrace";
$username_db = "root";
$password_db = "";


$conn = new mysqli($servername, $username_db, $password_db, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}


function verifyPassword($password, $hashedPassword) {
    if($password==$hashedPassword){
        return 1;
    }
    else{
        return 0;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        
        

    
        if (verifyPassword($password, $row["password"])) {
            
            echo "Login successful!";
            header("location: abu.html");
            exit(); 
        } 
        else {
            
            echo "Invalid password";
            

        }
    } else {
       
        echo "User not found";
    }

    $stmt->close();
}

$conn->close();
?>
