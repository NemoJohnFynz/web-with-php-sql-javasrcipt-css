
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./css/container_login_register.css">
</head>
<body>
    <div class="background">

        <div class="container">
            <div class="select">
                <form method="post" class="select">
                    <input type="submit" value="đăng nhập" class="logins" name="logins"/>
                    <input type="submit" value="đăng ký" class="registers" name="registers"/>
                </form>
            </div>

            <div class="box">
                
                <?php
                    require ("./set_login.php");
                    if(isset($_POST["logins"])){
                        require ("./login.php");
                    }
                    require ("./set_register.php");
                    if(isset($_POST["registers"])){
                        require ("./register.php");
                    }
                ?> 

            </div>
        </div>

    </div>
</body>
</html>
