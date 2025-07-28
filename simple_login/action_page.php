<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
if ($_SERVER['REQUEST_METHOD'] == 'POST')

{
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $user = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash the password for security
    $email = $_POST['email'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO test(`firstname`, `lastname`, `username`, `password`, `email`) 
    VALUES (?, ?, ?, ?, ?)");
    
    // Check if statement was prepared successfully
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("sssss", $fname, $lname, $user, $pass, $email);

    if ($stmt->execute()) {
        echo "Registration successful!";
        echo "<p><a href='index2.html'>Click here to login</a></p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
