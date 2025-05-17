<?php
$conn = mysqli_connect("localhost", "root", "", "vista");

if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $email = mysqli_real_escape_string($conn, $email);

    $query = "SELECT * FROM user_form WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        ?>
        <script> alert("Username or email already exists. Please choose a different one.");</script>
      
        <?php
    } else {
        $insertQuery = "INSERT INTO user_form (username, password, email) VALUES ('$username', '$password', '$email')";
        if (mysqli_query($conn, $insertQuery)) {
            header("Location: login.html"); 
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}


mysqli_close($conn);
?>


