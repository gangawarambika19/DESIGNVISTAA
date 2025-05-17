<?php
session_start();
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.html'); // Redirect to the login page
//     exit;
// }
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "vista"; 

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $name = sanitize($_POST["name"]);
    $email = sanitize($_POST["email"]);
    $message = sanitize($_POST["message"]);

    
    $stmt = $conn->prepare("INSERT INTO contact_form (name, email, message) VALUES (?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $message);
        if ($stmt->execute()) {
            header("Location: thank_you.html");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();

function sanitize($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>