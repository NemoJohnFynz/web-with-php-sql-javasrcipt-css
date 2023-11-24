<?php
    function getloai($conn){
        require 'configuser.php';
        $sql = "SELECT * FROM tbl_loai";
        $result = mysqli_query($conn, $sql);
        return $result;
    }


    
function getNewProducts() {
    require"configuser.php";

    // Truy vấn lấy 10 sản phẩm mới nhất
    $query = "SELECT * FROM tbl_sanpham ORDER BY id DESC";
    $result = $conn->query($query);

    // Lưu trữ sản phẩm vào mảng
    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    // Đóng kết nối
    $conn->close();
    return $products;
}
function getProductDetail($product_id) {
    require "configuser.php";
    $query = "SELECT * FROM tbl_sanpham WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        mysqli_close($conn);
        return $row;
    }
}
    // function checkuser($user,$pass){
    // require_once 'configuser.php';
    // $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE user '".$user."' AND pass='".$pass."'");
    // $stmt->execute();
    // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // $kq=$stmt->fetchAll();
    // if(count($kq)>0) return $kq[0]['role'];
    // else return 0;
    // }


    

    function getCartItems($userId) {
        require_once 'configuser.php'; // Kết nối đến CSDL
    
        $sql = "SELECT c.id, s.id AS product_id, s.ten, s.gia, s.hinh, c.quantity
            FROM tbl_cart c
            INNER JOIN tbl_sanpham s ON c.product_id = s.id
            WHERE c.user_id = $userId";
    
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $cartItems = array();
            while ($row = $result->fetch_assoc()) {
                $cartItems[] = $row;
            }
            return $cartItems;
        } else {
            return array(); // Trả về một mảng rỗng nếu giỏ hàng trống
        }
    }

    


    function deleteCartItem($itemId) {
        require_once"configuser.php";
        // Sử dụng kết nối CSDL đã được thiết lập từ file configuser.php
    
        $sql = "DELETE FROM tbl_cart WHERE id = '$itemId'"; // Xóa sản phẩm từ giỏ hàng dựa trên ID
    
        if ($conn->query($sql) === TRUE) {
            return true; // Trả về true nếu xóa thành công
        } else {
            return false; // Trả về false nếu có lỗi xảy ra
        }
    }
    ?>


