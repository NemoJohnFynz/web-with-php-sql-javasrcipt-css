<?php 
    if (isset($_POST["dk"])) {
        require ("../config.php");
        $name = $_POST["name"];
        $address = $_POST["diachi"];
        $email = $_POST["email"];
        $uname = $_POST["uname"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["xnpassword"];
        $hashpassword = password_hash("$password", PASSWORD_DEFAULT);
        $duplicate = mysqli_query($conn, "SELECT * FROM tbl_user WHERE user='$uname' OR email ='$email'");
        
        if(strlen($name)>50){
            echo "<script>alert('tên người dùng vượt quá kí tự cho phép');</script>";
        }
        else if(strlen($address)>50){
            echo "<script>alert('địa chỉ vượt quá kí tự cho phép');</script>";
        }
        else if(strlen($email)>50){
            echo "<script>alert('email vượt quá kí tự cho phép');</script>";
        }
        else if(strlen($uname)>20){
            echo "<script>alert('tên đăng nhập vượt quá kí tự cho phép');</script>";
        }
        else if(strlen($password)>20){
            echo "<script>alert('mật khẩu vượt quá kí tự cho phép');</script>";
        }
        else{
            if (mysqli_num_rows($duplicate) > 0) {
                echo "<script>alert('Tài khoản hoặc email đã tồn tại');</script>";
                require ("./register.php");
            } else {
                if ($password == $confirmpassword) {
                    $query = "INSERT INTO tbl_user VALUES ('NULL','$name', '$address', '$email', '$uname', '$hashpassword','1' )";
                    if (mysqli_query($conn, $query)) {
                        echo "<script>alert('đăng ký thành công');</script>";
                    } else {
                        echo "<script>alert('Lỗi khi đăng ký');</script>";
                        require ("./register.php");
                    }
                }
                else {
                    echo "<script>alert('Mật khẩu không khớp');</script>";
                    require ("./register.php");
                }
            }
        }
    }
?>