<?php
session_start();
require 'configuser.php';
    if (isset($_POST['lg'])) {
        $usernameemail = $_POST['usernameemail'];
        $password = $_POST['password'];
        $result = mysqli_query($conn,"SELECT * FROM tbl_user WHERE user ='$usernameemail' OR email = '$usernameemail'");
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            if (password_verify($password, $row["pass"])){
                    if($row['role']==0){
                    $_SESSION["lg"] = true;
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["username"] = $row["user"];
                    header("Location:index.php");
                    exit();
                    }elseif($row['role']==1){
                        echo "<script>alert('có những lúc mông lung\\n có những lúc lạc lối\\n có những lúc vạn vật mơ hồ \\n dẫu mọi thứ đổi thay\\n dù cuộc đời bế tắt\\n dù cuộc sống khổ cực\\n hãy nhớ mình là ADMIN');</script>";
                        echo "<script>window.location.href='login/container_login_register.php';</script>";
                        exit();
                    }
            }else{
                echo "<script>alert('sai mật khẩu');</script>";
            }
            
        }
        else {
            echo "<script>alert('tài khoản không tồn tại');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Style/login.css">
    <title>Document</title>
</head>
<body>
<form action="" method="POST">
        <h3>ĐĂNG NHẬP</h3>
        
        <input type="text" name="usernameemail" id="usernameemail" required placeholder="Tên đăng nhập hoặc Email" ><br>

       
        <input type="password" name="password" id="password" required placeholder="nhập mật khẩu"><br>

        <button class="dangnhap" type="submit" name=lg>Login</button>
        <button class="dangky"><a href="dangky.php">Bạn chưa có tài khoản</a></button>
        <button class ="trangchu"><a href="index.php">Quay lại trang chủ</a></button>
    </form>
</body>
</html>
<?php
?>