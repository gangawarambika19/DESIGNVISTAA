<?php
session_start();


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
    $product = sanitize($_POST["product"]);
    $quantity = sanitize($_POST["quantity"]);

    $stmt = $conn->prepare("INSERT INTO buy_form (name, email, product ,quantity) VALUES (?, ?, ?,?)");

    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $product , $quantity);
        if ($stmt->execute()) {
            header("Location: thank_you.php");
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