<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style/header.css">
    <link rel="stylesheet" type="text/css" href="Style/sanpham.css">
    <link rel="stylesheet" type="text/css" href="Style/footer.css">
    <title>NEMO SHOP</title>
</head>
<body>
        <header>
            <div class="header">
                <?php require"page/header.php"; ?>
            </div>
        </header>


    </div>
        <div class="newsanpham">
        <?php 
        if (isset($_GET['page'])) {
           require('page/chitiet.php');
        }
        else 
            require('page/sanpham.php'); 
        ?>
        </div>


        <footer>
        <span>thông tin nhà phát triển: nhà phát triển uchiha nemo</span>
        <span>tin tức:Nemo 20 tuổi nhưng có cái lưng của người 70 tuổi</span>
        </footer>
        


        


</body>
</html>