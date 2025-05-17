<?php

session_start();
$conn = mysqli_connect("localhost", "root", "", "vista");
session_unset();
session_destroy();

header('location:login.html');
?>