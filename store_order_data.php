<?php
$json_data = file_get_contents('php://input');
$order_data = json_decode($json_data, true); 

$name = $order_data['name'];
$email = $order_data['email'];
$phoneNumber = $order_data['phoneNumber'];
$address = $order_data['address'];
$products = $order_data['products'];

$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "vista"; 

$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_order = "INSERT INTO ordersq (name, email, phone_number, address) VALUES ('$name', '$email', '$phoneNumber', '$address')";
if ($conn->query($sql_order) === TRUE) {
    $last_order_id = $conn->insert_id; 

    foreach ($products as $product) {
        $productName = $product['name'];
        $quantity = $product['quantity'];
        $price = $product['price'];
        $sql_order_details = "INSERT INTO order_details (order_id, product_name, quantity, price) VALUES ('$last_order_id', '$productName', '$quantity', '$price')";
        $conn->query($sql_order_details);
    }
    echo "Order stored successfully.";
} else {
    echo "Error: " . $sql_order . "<br>" . $conn->error;
}

$conn->close();
?>
