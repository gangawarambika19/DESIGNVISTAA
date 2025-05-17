<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cartItems = $_POST['cartItems']; 

 
    $cartItemsArray = json_decode($cartItems, true);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vista";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $cartItems = json_decode($_POST['cartItems'], true);
    $totalSubtotal = $_POST['totalSubtotal'];
    foreach ($cartItemsArray as $item) {
        $name = $item['name'];
        $price = $item['price'];
        $quantity = $item['quantity'];
        $subtotal = $item['subtotal'];

        $sql = "INSERT INTO orders (name, price, quantity, subtotal) VALUES ('$name', '$price', '$quantity', '$subtotal')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
