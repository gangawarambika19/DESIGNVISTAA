<?php
// Your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vista";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receive form data
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$cardName = $_POST['card'];
$cardNumber = $_POST['credit'];
$expMonth = $_POST['month'];
$expYear = $_POST['year'];
$cvv = $_POST['cvv'];

// SQL to insert form data into the database
$sql = "INSERT INTO y_table (full_name, email, address, city, state, pin_code, card_name, card_number, exp_month, exp_year, cvv) 
        VALUES ('$name', '$email', '$address', '$city', '$state', '$zip', '$cardName', '$cardNumber', '$expMonth', '$expYear', '$cvv')";

if ($conn->query($sql) === TRUE) {
    $response = array('status' => 'success', 'message' => 'New record inserted successfully into the database');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => "Error: " . $sql . "<br>" . $conn->error);
    echo json_encode($response);
}

// Close database connection
$conn->close();

?>
