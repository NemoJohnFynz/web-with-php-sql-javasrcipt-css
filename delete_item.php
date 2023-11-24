<?php
require_once 'Function/function.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemId = $_POST['itemId'];

    $result = deleteCartItem($itemId);

    if ($result) {
        http_response_code(200);
    } else {
        http_response_code(400);
        echo "Lỗi khi xóa sản phẩm khỏi giỏ hàng.";
    }
} else {
    http_response_code(400);
    echo "Đã xảy ra lỗi khi xử lý yêu cầu.";
}
?>