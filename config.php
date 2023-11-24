<?php
$servername = "localhost";
$database = "bcw";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database) or die("kết nối 0 thành công". mysqli_error($conn));

function deletelow($conn,$so){
    $sql="delete from tbl_sanpham where soluong='$so'";
    return mysqli_query($conn, $sql);
};
$so=0;
deletelow($conn,$so);
?>
