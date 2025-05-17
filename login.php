<?php
// Start session
session_start();

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "vista");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM user_form WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password']) {
            $_SESSION['username'] = $username;
           
            header("Location: index.html"); 
        } else {
            
           echo "<script>alert('Invalid password. Please try again.')</script>";
        }
    } else {
        
     echo "<script>alert('User not found. Please register.')</script>";
    }
}


mysqli_close($conn);
?>
