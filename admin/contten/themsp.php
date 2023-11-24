<?php

$dsLoai = getTbl_Loai($conn);
?>
<head>
    <link rel="stylesheet" type="text/css" href="./css/themsp.css">
</head>
<?php

?>
<div class="container_xemchitietsp">
<form method="post" enctype="multipart/form-data">
<div class="right_suasanpham">

    <div class="box">
        <div class="tx_suasp">Hình: </div>
        <div class="box_right">
            <input type="file" name="hinh" class="file"/>
        </div>
    </div>

    <div class="box">
        <div class="tx_suasp">Tên sản phẩm : </div>
        <div class="box_right_textandnummber">
            <input class="inputext_number_suasanpham" type="text" name="ten" required/>
        </div>
    </div>
    <div class="box">
        <div class="tx_suasp" >Giá : </div>
        <div class="box_right_textandnummber">
            <input class="inputext_number_suasanpham" type="number" name="gia" required/> 
        </div>
        <span class="tx_suasp" > VNĐ</span>
    </div>

    <div class="mota_text">Mô tả : </div><textarea name="mota" class="mota_input"></textarea> <br>
    
    <div class="box">
        <div class="tx_suasp">Loại sản phẩm :</div>
        <div class="box_right_textandnummber_select">
            <select class="sl_input" name="loai">
            <?php while ($row = mysqli_fetch_array($dsLoai)) {
            ?>
                <option value="<?php echo $row["id"]; ?>"><?php echo $row["ten"]; ?></option>
            <?php
            }
            ?>
            </select>
        </div>
    </div>
    <div class="box">
        <div class="tx_suasp">Số lượng :</div>
        <div class="box_right_textandnummber">
            <input class="inputext_number_suasanpham" type="number" name="soluong" required/>
        </div>
    </div>
</div>
<input type="submit" name="taosanpham" class="bt_suasanpham" value="Tạo sản phẩm">


</form>
</div>

<?php
if (isset($_POST["taosanpham"])) {
    
    $ten = $_POST["ten"];
    $gia = $_POST["gia"];
    $mota = $_POST["mota"];
    $loai = $_POST["loai"];
    $soluong = $_POST["soluong"];
    $hinh = $_FILES["hinh"]["name"];
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
        move_uploaded_file($_FILES["hinh"]["tmp_name"],"../img/".$_FILES["hinh"]["name"]);
        $sqlInsert = "insert into tbl_sanpham values ('NULL','$ten',$gia,'$hinh','$mota','$loai','$soluong')";
        mysqli_query($conn, $sqlInsert);
        echo "<script>alert('tạo thành công sản phẩm $ten ');</script>";
    }
    else{
        echo "<script>alert('tạo thất bại sản phẩm $ten lý do chưa biết');</script>";
    }
}
?>