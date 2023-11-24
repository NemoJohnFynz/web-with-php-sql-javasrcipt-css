<?php
require_once 'Function/function.php'; // Đưa hàm vào phạm vi sử dụng

session_start();
$userId = $_SESSION['id'];

// Lấy thông tin giỏ hàng từ hàm đã tạo
$cartItems = getCartItems($userId);

// Hiển thị thông tin giỏ hàng
?>

<!DOCTYPE html>
<html>
<head>
    <title>Giỏ hàng</title>
    <link rel="stylesheet" type="text/css" href="style/cart.css">
    <style>
        /* CSS cho modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>


</head>
<body>


<header>
    <div class="header">
        <button><a href="index.php">quay lại trang chủ</a></button>
    </div>
</header>

<?php 
// print_r($cartItems);

 ?>

<h1>Giỏ hàng của bạn</h1>

<?php if (!empty($cartItems)) : ?>
    <table border="1">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Hình ảnh</th>
                <th>thanh toán</th>
                <th>xóa khỏi giỏ hàng</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item) : ?>
                <tr>
                    <?php $productId = $item['product_id'] ?>
                    <?php $itemId=$item['id'] ?>
                 
                    <td><?php echo $item['ten']; ?></td>
                    <td><?php echo $item['gia']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><img src="img/<?php echo $item['hinh']; ?>" alt="<?php echo $item['ten']; ?>" width="40"></td>

                    <td><button onclick="openModal(<?php echo $item['id']; ?>)">thanh toán</button></td>
                    <td><button onclick="deleteCartItem(<?php echo $item['id']; ?>)">Xóa khỏi giỏ hàng</button></td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>Giỏ hàng của bạn đang trống</p>
<?php endif; ?>


<!-- Modal mua hàng -->
<div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Thông tin đặt hàng</h2>
                <form id="orderForm" onsubmit="submitForm(); return false;">
                    
                    
                    <label for="fullName">Họ tên:</label>
                    <input type="text" id="fullName" name="fullName" required><br><br>

                    <label for="address">Địa chỉ nhận hàng:</label>
                    <input type="text" id="address" name="address" required><br><br>

                    <label for="address">Số điện thoại:</label>
                    <input type="tel" id="sdt" name="sdt" pattern="[0-9]+" required title="Vui lòng chỉ nhập số"><br><br>

                    <label for="quantity">Số lượng:</label>
                    <input type="number" id="quantityOrder" name="quantity" min="1" required onchange="calculateTotal('order')"><br><br>

                    <label for="total">Thành tiền:</label>
                    <input type="text" id="totalOrder" name="total" readonly><br><br>

                    <input type="submit" value="Đặt hàng">
                </form>
            </div>
        </div>


<script>
    // your script goes here

    var modal = document.getElementById("myModal");
    function openModal() {
            modal.style.display = "block";
        }

        function closeModal() {
            modal.style.display = "none";
        }


        function calculateTotal(formType) {
        var price = <?php echo $item["gia"]; ?>;
        var quantity = 0;
        var totalField = '';

        if (formType === 'order') {
            quantity = document.getElementById("quantityOrder").value;
            totalField = document.getElementById("totalOrder");
        }

        var total = price * quantity;
        totalField.value = total;
}


    function submitForm() {
        
        var productId = <?php echo $productId ?>;
        var quantityBought = document.getElementById("quantityOrder").value;
    var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            // Xử lý thành công khi request hoàn tất và trả về status code 200 (OK)
            // Ví dụ: 
            closeModal();
                alert("Đặt hàng thành công!");
                var itemId = <?php echo $itemId; ?>;
                // Gọi hàm xóa sản phẩm khỏi giỏ hàng
                deleteCartItem(itemId);
            } else if (xhr.status === 400) {
            // Xử lý khi số lượng không đủ (hoặc các trường hợp lỗi khác)
            alert("Số lượng sản phẩm không đủ để đặt hàng.");
        } else {
            // Xử lý lỗi khi không nhận được status code 200 hoặc 400 từ server
            alert("Đã xảy ra lỗi khi đặt hàng.");
        }
    }
};

    xhr.open("POST", "muacart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("productId=" + productId + "&quantity=" + quantityBought);
}

//     function updateQuantity(productId, quantityBought) {
//         // Gửi yêu cầu cập nhật số lượng sản phẩm
//         fetch('update_quantity.php', {
//     method: 'POST',
//     headers: {
//         'Content-Type': 'application/x-www-form-urlencoded',
//     },
//     body: 'productId=' + productId + '&quantityBought=' + quantityBought,
// })
//         .then(response => {
//             if (!response.ok) {
//                 alert('Lỗi khi cập nhật số lượng sản phẩm.');
//             }
//         })
//         .catch(error => {
//             console.error('Lỗi:', error);
//         });
//     }
/*


*/

function deleteCartItem(itemId) {
    fetch('delete_item.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'itemId=' + itemId,
    })
    .then(response => {
        if (response.ok) {
            // Xóa sản phẩm trên giao diện sau khi xóa thành công từ phía server
            const deletedItem = document.querySelector('tr[data-id="' + itemId + '"]');
            if (deletedItem) {
                deletedItem.parentNode.removeChild(deletedItem);

                // Gọi lại hàm để cập nhật thông tin giỏ hàng sau khi xóa
                updateCartItems();
            } else {
                alert('xóa thành công.');
                location.reload();
            }
        } else {
            alert('Lỗi khi xóa sản phẩm khỏi giỏ hàng.');
        }
    })
    .catch(error => {
        console.error('Lỗi:', error);
    });
}
    
        // xhr.open("POST", "handle_order.php", true);
        // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // xhr.send("productId=" + productId + "&quantity=" + quantityBought);

</script>



</body>
</html>

