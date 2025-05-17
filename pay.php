<?php
// Establish database connection
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "vista"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Extract form data
$fullName = $post_data['full_name'];
$email = $post_data['email'];
$address = $post_data['address'];
$pinCode = $post_data['zip']; // Changed variable name to pinCode to avoid conflicts
$city = $post_data['city'];

$sql = "INSERT INTO customer_info (full_name, email, address, pin_code, city)
        VALUES ('$fullName', '$email', '$address', '$pinCode', '$city')";

if ($conn->query($sql) === TRUE) {
    echo "New record inserted successfully into the database";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>
