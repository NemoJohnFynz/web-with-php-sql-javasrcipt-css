<head>
    <link rel="stylesheet" type="text/css" href="./css/suasanpham.css">
</head>
<?php
$xemsp = getCTSP($conn, $id);
if (mysqli_num_rows($xemsp) > 0){
$dsLoai = getTbl_Loai($conn);
$sp = mysqli_fetch_array($xemsp);
$uid = $sp["loai"];
$loaisp = getsptheoloai($conn, $uid);
$lsp = mysqli_fetch_array($loaisp);
?>

<div class="container_xemchitietsp">
<div class="left_suasanpham"><img src="../img/<?php echo $sp["hinh"] ?>" class="img_ctsp" /></div>
<form method="post" enctype="multipart/form-data">
<div class="right_suasanpham">
    <div class="box">
        <div class="tx_suasp">Hình: </div>
        <div class="box_right">
            <input type="file" name="hinhup" class="file"/>
        </div>
    </div>
    <div class="box">
        <div class="tx_suasp">Tên sản phẩm : </div>
        <div class="box_right_textandnummber">
            <input class="inputext_number_suasanpham" type="text" value="<?php echo $sp["ten"] ?>" name="ten" required/>
        </div>
    </div>
    <div class="box">
        <div class="tx_suasp" >Giá : </div>
        <div class="box_right_textandnummber">
            <input class="inputext_number_suasanpham" type="number" value="<?php echo $sp["gia"] ?>" name="gia" required/> 
        </div>
        <span class="tx_suasp" > VNĐ</span>
    </div>

    <div class="mota_text">Mô tả : </div><textarea name="mota" class="mota_input"><?php echo $sp["mota"] ?></textarea> <br>
    
    <div class="box">
        <div class="tx_suasp">Loại sản phẩm :</div>
        <div class="box_right_textandnummber_select">
            <select class="sl_input" name="loai">
                    <?php while ($row = mysqli_fetch_array($dsLoai)) {
                        $selected = ($row["ten"] === $lsp["ten"]) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $row["id"]; ?>" <?php echo $selected; ?>><?php echo $row["ten"]; ?></option>
                    <?php
                    }
                    ?>
            </select>
        </div>
    </div>
    <div class="box">
        <div class="tx_suasp">Số lượng :</div>
        <div class="box_right_textandnummber">
            <input class="inputext_number_suasanpham" type="number" name="soluong" value="<?php echo $sp["soluong"] ?>" required/>
        </div>
    </div>
</div>
<input type="submit" name="suasanpham" class="bt_suasanpham" value="sửa sản phẩm">


</form>
</div>
</body>
<?php
if (isset($_POST["suasanpham"])) {
    $ten = $_POST["ten"];
    $gia = $_POST["gia"];
    $mota = $_POST["mota"];
    $loai = $_POST["loai"];
    $soluong = $_POST["soluong"];
    
    if(strlen($ten)>99){
        echo "<script>alert('tạo sản phẩm $ten thất bại : tên vượt quá kí tự cho phép');</script>";
    }
    else if(($gia)>2147483646){
        echo "<script>alert('tạo sản phẩm $ten thất bại : giá vượt quá kí tự cho phép');</script>";
    }
    else if(strlen($mota)>999){
        echo "<script>alert('tạo sản phẩm $ten thất bại : mô tả quá kí tự cho phép');</script>";
    }
    else if(strlen($soluong)>6){
        echo "<script>alert('tạo sản phẩm $ten thất bại : số lượng vượt quá kí tự cho phép');</script>";
    }
    else if(strlen($ten)<100 and ($gia)<2147483646 and strlen($mota)<1000 and strlen($soluong)<7){
        if(isset($_FILES['hinhup']) && $_FILES['hinhup']['error'] !== UPLOAD_ERR_NO_FILE) {
            $hinhs = $_FILES["hinhup"]["name"];
            move_uploaded_file($_FILES["hinh"]["tmp_name"],"../img/".$_FILES["hinh"]["name"]);
        }
        else{
            $hinhs = $sp["hinh"];
        }
        $idsanpham=$sp["id"];
        $sqlInsert = "update tbl_sanpham set ten='$ten',gia=$gia,hinh='$hinhs',mota='$mota',loai='$loai',soluong='$soluong' where id=$idsanpham;";
        if(mysqli_query($conn, $sqlInsert)){
            echo "<script>alert('cập nhật thành công sản phẩm $ten');</script>";
            $path="";
            if (isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] != "") {
                $path = $path . "?" . $_SERVER["QUERY_STRING"];
            }
            header("Refresh:0,url='$path'");
        }
        else{
            echo " cập nhật thất bại";    }
    }
    else{
        echo "<script>alert('tạo thất bại sản phẩm $ten lý do chưa biết');</script>";
    }
}
?>

<?php
}
else{
    echo "sản phẩm không tồn tại ";
}
?>