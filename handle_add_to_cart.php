<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];
    $userId = $_SESSION["id"]; // Lấy ID của người dùng từ session

    // Thực hiện xử lý thêm vào giỏ hàng
    // Ví dụ: Lưu vào cơ sở dữ liệu
    require_once 'configuser.php'; // Kết nối đến cơ sở dữ liệu

    $sql = "INSERT INTO tbl_cart (user_id, product_id, quantity) VALUES ('$userId', '$productId', '$quantity')";


    if ($conn->query($sql) === TRUE) {
        http_response_code(200);
        echo "Sản phẩm đã được thêm vào giỏ hàng!";
    } else {
        http_response_code(400);
        echo "Lỗi: " . $conn->error;
    }

    $conn->close(); // Đóng kết nối cơ sở dữ liệu
} else {
    http_response_code(400);
    echo "Đã xảy ra lỗi khi xử lý dữ liệu!";
}
?>