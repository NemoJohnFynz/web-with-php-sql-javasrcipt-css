<?php
function getTbl_Loai($conn){
    $sql="select * from tbl_loai";
    return mysqli_query($conn, $sql);
}
function getsptheoloai($conn,$id){
    $sql="SELECT DISTINCT  tbl_loai.ten FROM tbl_loai, tbl_sanpham WHERE tbl_loai.id = tbl_sanpham.loai AND tbl_sanpham.loai= '$id'";
    return mysqli_query($conn, $sql);
}
function getSP($conn){
    $sql="select * from tbl_sanpham";
    return mysqli_query($conn, $sql);
}
function getCTSP($conn, $id){
    $sql="select * from tbl_sanpham where id='$id'";
    return mysqli_query($conn, $sql);
}
function deleteSP($conn, $id){
    $sql="delete from tbl_sanpham where id='$id'";
    return mysqli_query($conn, $sql);
}

?>