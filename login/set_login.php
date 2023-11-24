
<?php

    if (isset($_POST['dn'])) {
        require '../config.php';
        $usernameemail = $_POST['usernameemail'];
        $matkhau = $_POST['matkhau'];
        $result = mysqli_query($conn,"SELECT * FROM tbl_user WHERE user ='$usernameemail' OR email = '$usernameemail'");
        $user =mysqli_fetch_array($result);
        if (mysqli_num_rows($result) > 0) {
            if (password_verify($matkhau, "$user[pass]")){
                if("$user[role]"==1){
                    echo "<script>alert('đăng nhập thành công');</script>";
                    
                    $path=$_SERVER["SCRIPT_NAME"];
                    if(isset($_SERVER["QUERY_STRING"])&&$_SERVER["QUERY_STRING"]!=""){
                        $path=$path."?".$_SERVER["QUERY_STRING"];                   
                    }
                    $out =$path;
                    $path = str_replace("login/container_login_register.php", "", $path);
                    $path = $path. "admin/index.php";
                    //echo $path;
                    header("Refresh:0,url='$path'"); 
                    session_start();
                    $_SESSION["username"] = $_POST['usernameemail'];
                    $_SESSION["out"]=$out;
                }
                else{
                    echo "<script>alert('đăng nhập không thành công vì đây không phải tài khoản dành cho quản trị viên');</script>";
                    require ("./login.php");
                }

            }
            else{
                echo "<script>alert('sai mật khẩu');</script>";
                require ("./login.php");
            }
        }
        else {
            echo "<script>alert('tài khoản không tồn tại');</script>";
            require ("./login.php");
        }
    }
?>