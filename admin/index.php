<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./css/index.css">
</head>

<body>
    <div class="backgr">


    <div class="top_bar">
        <div class="select">
                <a href="?page=themsp"><input type="submit" class="bt_sl" name="tsp" value="thêm sản phẩm"></a>
                <a href="?page=themlsp"><input type="submit" class="bt_sl" name="tlsp" value="thêm loại sản phẩm"></a>
                <a href="?page=danhsachsp"><input type="submit" class="bt_sl" name="dssp" value="danh sách sản phẩm"></a>
        </div>
        <div class="right">

            <div class="hello">
                <form method="post">

                    <span class="loixinchao">Xin Chào: <?php require("./right_bar/name.php") ?></span>
                    <a href="" class="link_out"><input type="submit" name="out" value="Logout" class="bt_out"></a>
                    <?php
                    require("./right_bar/out.php");

                    ?>
                </form>
            </div>
        </div>
    </div>
    <div class="tach"></div>
    
    <div class="contten">
        
    <div class="tach"></div>
        <?php
        require("./admin_funcs.php");
        require("../config.php");
        $so=0;
        
        if (isset($_GET["page"])){
            if (isset($_GET["spid"])){
                $id=$_GET["spid"];
            }
            if (file_exists("./contten/".$_GET["page"].".php")) {
                require("./contten/".$_GET["page"].".php");
            } else {
                // Xử lý khi file không tồn tại
                echo "trang web không tồn tại";
            }
        }
        else{}
        ?>
    </div>
    
    </div>
</body>

</html>



