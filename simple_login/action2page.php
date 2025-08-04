<?php
session_start();

// DB credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if (empty($user) || empty($pass)) {
        echo "Please fill in both fields.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM test WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($pass, $row['password'])) {
                $_SESSION['user'] = $user;
                header("Location: dashboard.php");
                exit();
            }
        }

        echo "Invalid username or password.";
    }
}

$conn->close();
?>

