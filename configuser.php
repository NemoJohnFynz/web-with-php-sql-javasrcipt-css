<?php
$servername = "localhost";
$database = "bcw";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database) or die("kết nối 0 thành công". mysqli_error($conn));
?>