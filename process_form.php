<?php

$host = "localhost"; 
$username = "root";
$password = ""; 
$database = "vista"; 

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone_number = $_POST['number'];
$address = $_POST['address'];

$sql = "INSERT INTO user_info (name, email, phone_number, address) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $phone_number, $address);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: payment.html");
exit();
?>
