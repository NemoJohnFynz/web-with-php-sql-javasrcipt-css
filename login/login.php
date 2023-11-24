<head>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
</head>

<form  method="POST" class="login">
        <h2>ĐĂNG NHẬP</h2>
        <div class="box_text">
            <label for="usernameemail">Tên Tài Khoản hoặc Email:</label>
            <input type="text" name="usernameemail" class="text_input" id="usernameemail" required><br>

            <label for="password">Mật Khẩu:</label>
            <input type="password" name="matkhau" class="text_input" id="matkhau" required ><br>
        </div>

        <div class="div_login">
            <button class="bt_login" type="submit" name="dn">Login</button>
        </div>      
</form>

