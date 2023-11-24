<?php
session_start();
require 'configuser.php';
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $address = $_POST["diachi"];
    $email = $_POST["email"];
    $uname = $_POST["uname"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["xnpassword"];
    $hashpassword = password_hash($password, PASSWORD_DEFAULT);
    $duplicate = mysqli_query($conn, "SELECT * FROM tbl_user WHERE user='$uname' OR email ='$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script>alert('Tài khoản hoặc email đã tồn tại');</script>";
    } else {
        if ($password == $confirmpassword) {
            $query = "INSERT INTO tbl_user VALUES ('NULL','$name', '$address', '$email', '$uname', '$hashpassword','NULL')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Đăng ký thành công');</script>";
                echo "<script>window.location.href='login.php';</script>";

            } else {
                echo "<script>alert('Lỗi khi thực hiện đăng ký');</script>";

            }
        } else {
            echo "<script>alert('Mật khẩu không khớp');</script>";

        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Style/dangky.css">
    <title>Document</title>
</head>
<body>
    
    <form action="" class="formdk" method="post"autocomplete="off">
    <h3>ĐĂNG KÝ TÀI KHOẢN</h3>
    <input type="text" class="ddk" name="name" id="name" placeholder="Nhập họ tên của bạn" required><br>
    <input type="text" class="ddk" name="diachi" id="dc" placeholder="địa chỉ"><br>
    <input type="text" class="ddk" name="email" id="email" placeholder="email"required><br>
    <input type="text" class="ddk" name="uname" id="uname" placeholder="tên tài khoản" required> <br>
    <input type="password" class="ddk" name="password" id="pass" placeholder="mật khẩu"required><br>
    <input type="password" class="ddk" name="xnpassword" id="pass"placeholder="xác nhận mật khẩu" required><br>
    <button class="dangky" type="submit" name="submit">ĐĂNG KÝ</button>
    <button class ="dangnhap"><a href="login.php">Bạn đã có tải khoản</a></button>
    <button class="trangchu"><a href="index.php">Quay lại trang chủ</a></button>
    </form>
    <br>
</body>
</html>
<!-- oni-chan3k -->