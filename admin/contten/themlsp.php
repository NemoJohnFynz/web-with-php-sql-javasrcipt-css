<head>
    <link rel="stylesheet" type="text/css" href="./css/themlsp.css">
</head>
<form method="post" enctype="multipart/form-data">
    <div class="text_loai">tên loại sản phẩm: <input class="input_loai" type="text" name="tenlsp" required /></div>
    
        <input class="taoloai" type="submit" name="taoloaisanpham" value="tạo loại sản phẩm">
    
</form>
    
<?php
if (isset($_POST["taoloaisanpham"])) {
    
    if(mysqli_query($conn, "SELECT MAX(thuTu) AS sln FROM tbl_loai ")){
        $tenlsp = $_POST["tenlsp"];
        $tt = mysqli_query($conn, "SELECT MAX(thuTu) AS sln FROM tbl_loai ");
        $ttln = mysqli_fetch_array($tt);
        $solonnhat = $ttln['sln'] + 1;
        $sqlInsert = "insert into tbl_loai values ('NULL','$tenlsp','null','$solonnhat')";
        mysqli_query($conn, $sqlInsert);
        echo "<script>alert('thêm thành công loại sản phẩm $tenlsp');</script>";
    }
    else{
        echo "<script>alert('thêm thất bại loại sản phẩm $tenlsp );</script>";
    }

}
?>