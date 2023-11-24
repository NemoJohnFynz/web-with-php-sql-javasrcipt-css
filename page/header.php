
<?php
session_start();
?>
<div class="menu">
    <ul>
        <div class="logo">
        <img src="img/logo.jpg" alt="logo" width="50px" height="50px">
        </div>
        <a href="index.php">trang chủ</a>
        <?php 
        if (isset($_SESSION["lg"]) && $_SESSION["lg"] === true) {
            // Nếu người dùng đã đăng nhập, hiển thị thông tin người dùng và nút đăng xuất
            echo "<span>  ".$_SESSION["username"]."</span> "; // Hiển thị username
            echo "<a href='cart.php'> Giỏ hàng </a>";
            echo "<a href='logout.php'>Đăng xuất</a>"; // Nút đăng xuất
        }else{ ?>
        
        <a href="login.php">Đăng nhập</a>
        <a href="dangky.php">Đăng ký</a>
        <?php 
        }?> 
    </ul>
</div>

