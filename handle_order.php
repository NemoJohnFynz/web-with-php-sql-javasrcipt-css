<?php 
require_once "configuser.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['productId']) && isset($_POST['quantity'])) {
        $productId = $_POST['productId'];
        $quantityBought = $_POST['quantity'];
        

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $sql_get_product = "SELECT soluong FROM tbl_sanpham WHERE id = $productId";
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
                    // Lưu thông tin đơn hàng vào bảng tbl_donhang
                    $sql_insert_order = "INSERT INTO tbl_donhang (userId, productId, quantity) VALUES ($userId, $productId, $quantityBought)";
                    if ($conn->query($sql_insert_order) === TRUE) {
                        http_response_code(200); // Trả về mã 200 OK
                        // Xử lý thông tin đặt hàng thành công
                        // Ví dụ: có thể gửi email xác nhận, thông báo đơn hàng, lưu thông tin đơn hàng vào cơ sở dữ liệu, vv.
                        echo "Đặt hàng thành công!";
                    } else {
                        // Xử lý khi gặp lỗi khi lưu thông tin đơn hàng
                        echo "Lỗi khi lưu thông tin đơn hàng: " . $conn->error;
                    }
                }else {
                    echo "Lỗi cập nhật số lượng sản phẩm: " . $conn->error;
                }
            } else {
                // Gửi mã lỗi khi số lượng không đủ
                http_response_code(400); // Mã lỗi 400: Yêu cầu không hợp lệ
                echo "Số lượng sản phẩm không đủ để bán.";
            }
        } else {
            echo "Không tìm thấy sản phẩm.";
        }
    } else {
        echo "Thiếu thông tin sản phẩm hoặc số lượng hoặc userId.";
    }
}

// Đóng kết nối sau khi hoàn thành công việc với cơ sở dữ liệu
$conn->close();
?>