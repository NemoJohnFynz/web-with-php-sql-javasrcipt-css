<?php
require_once 'Function/function.php';
require 'configuser.php';

$newProducts = getNewProducts();
$count = 0;
echo "<div class='spmoi'>";
echo "<div class='divtong'>";

foreach ($newProducts as $product) {
    echo "<div class='spnho'>";
    echo "<h4>" . $product["ten"] . "</h4>" .'<br>';
    echo "<div class='hinh'>";
    echo "<a href='?page=chitiet&id=" . $product["id"] . "'>";
    echo "<img src='img/".$product["hinh"] . "' alt='hình ảnh sản phẩm'>".'<br>';
    echo "</a>";
    echo "</div>";
    echo "<p>Giá: " . $product["gia"] . 'VND'.".</p>".'<br>';
    echo "<br>";
    echo "</div>";
    
    $count++;
    if ($count % 3 === 0) { // Nếu đã đủ 3 sản phẩm
        echo "</div><div class='divtong'>"; // Tạo hàng mới
    }
}

echo "</div>";
echo "</div>";
?>