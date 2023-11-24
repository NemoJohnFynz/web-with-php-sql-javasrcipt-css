<?php
require_once "configuser.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['productId']) && isset($_POST['quantityBought'])) {
        $productId = $_POST['productId'];
        $quantityBought = $_POST['quantityBought'];

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $sql_get_product = "SELECT * FROM tbl_sanpham WHERE id = $productId";
        $result = $conn->query($sql_get_product);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentQuantity = $row['soluong'];

            // Kiểm tra xem có đủ sản phẩm để bán không
            if ($currentQuantity >= $quantityBought) {
                // Trừ đi số lượng đã bán từ số lượng hiện tại trong cơ sở dữ liệu
                $newQuantity = $currentQuantity - $quantityBought;

                // Cập nhật số lượng mới vào cơ sở dữ liệu
                $sql_update_quantity = "UPDATE tbl_sanpham SET soluong = $newQuantity WHERE id = $productId";

                if ($conn->query($sql_update_quantity) === TRUE) {
                    // Nếu cập nhật thành công, trả về thành công
                    http_response_code(200);
                    echo "Cập nhật số lượng sản phẩm thành công.";
                } else {
                    http_response_code(500);
                    echo "Lỗi cập nhật số lượng sản phẩm: " . $conn->error;
                }
            } else {
                http_response_code(400);
                echo "Số lượng sản phẩm không đủ để bán.";
            }
        } else {
            http_response_code(404);
            echo "Không tìm thấy sản phẩm.";
        }
    } else {
        http_response_code(400);
        echo "Thiếu thông tin sản phẩm hoặc số lượng.";
    }
} else {
    http_response_code(405);
    echo "Phương thức không được hỗ trợ.";
}

// Đóng kết nối sau khi hoàn thành công việc với cơ sở dữ liệu
$conn->close();
?>