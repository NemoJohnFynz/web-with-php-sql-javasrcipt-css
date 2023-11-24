<head>
    <link rel="stylesheet" type="text/css" href="./css/xemchitietsp.css">
</head>

<?php
$xemsp = getCTSP($conn, $id);
if (mysqli_num_rows($xemsp) > 0){
$sp = mysqli_fetch_array($xemsp);
$uid = $sp["loai"];
$loaisp = getsptheoloai($conn, $uid);
$lsp = mysqli_fetch_array($loaisp);

?>
<div class="container_xemchitietsp">
<img src="../img/<?php echo $sp["hinh"] ?>" class="img_ctsp" />
<div class="ttct">
    <div>tên sản phẩm : <?php echo $sp["ten"] ?></div>
    <div>giá : <?php echo $sp["gia"] ?> Đ</div>
    <div>mô tả : <?php echo $sp["mota"] ?></div>
    <div>loại : <?php echo $lsp["ten"] ?></div>
    <div>số lượng : <?php echo $sp["soluong"] ?></div>
</div>


<div class="container_select_chitietsp">
<a href="?page=suasanpham&spid=<?php echo $id?>"><input type="submit" class="bt_slsua1" value="" name="sua"></a><span class="text_bt_slsua1">sửa</span>
</div>
</div>
<?php
if (isset($_GET["suasanpham"])) {
    require("./contten/suasanpham.php");
}
?>
<?php
}
else{
    echo "sản phẩm không tồn tại";
}
?>
</div>
</body>