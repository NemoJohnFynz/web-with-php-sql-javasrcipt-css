<!DOCTYPE html>
<html>
<head>
    <title>Chi Tiết Sản Phẩm</title>
    <link rel="stylesheet" type="text/css" href="Style/chitiet.css">
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

<?php 

require_once"Function/function.php";
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Lấy thông tin chi tiết sản phẩm từ cơ sở dữ liệu
    $product = getProductDetail($productId);

    if ($product !== null) {
        echo "<div class = 'container'>";
        echo "<div class = 'th'>";
        echo "<h3>" . $product["ten"] . "</h3>";
        echo "<img src='img/".$product["hinh"] . "' alt='hình ảnh sản phẩm'>";
        echo "<p>Giá: " . $product["gia"] .'VND'. "</p>";
        echo "<button onclick='openCartModal()'>Thêm vào giỏ hàng</button>";
        echo "<button onclick='openModal()'>Mua sản phẩm</button>";
        echo "<div class = 'bmt'>";
        echo "<div class = 'mt'>";
        
        echo "<p>" .$product["mota"] ."</p>" ;
        echo "</div>";
        echo "</div>";

        echo "</div>";
        echo "</div>";
        
        
        
    } else {
        echo "Không tìm thấy sản phẩm.";
    }
} else {
    echo "Không có thông tin sản phẩm.";
}
?>
<!-- modal thim dỏ hàng -->

<div id="cartModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeCartModal()">&times;</span>
        <h2>Thông tin đặt hàng</h2>
        <form id="addToCartForm" onsubmit="submitCartForm(event)">
            <input type="hidden" name="userID" value="<?php if(isset($_SESSION["id"])){echo $_SESSION["id"];}else{} ?>"> 
            <!--  -->
            <input type="hidden" name="productId" value="<?php echo $productId; ?>">
            
            <label for="quantity">Số lượng:</label>
            <input type="number" id="quantityCart" name="quantityCart" min="1" required onchange="calculateTotal('cart')"> <br><br>


            <!-- <label for="total">Thành tiền:</label>
            <input type="text" id="totalCart" name="total" readonly><br><br> -->

            <input type="submit" value="Thêm vào giỏ hàng">
        </form>
    </div>
</div>


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
    var cartModal = document.getElementById("cartModal");
    var modal = document.getElementById("myModal");

        function openModal() {
            modal.style.display = "block";
        }

        function closeModal() {
            modal.style.display = "none";
        }

        function openCartModal() {
        cartModal.style.display = "block";

        }

        function closeCartModal() {
            cartModal.style.display = "none";
        }

    function calculateTotal(formType) {
        var price = <?php echo $product["gia"]; ?>;
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
    var productId = <?php echo $productId; ?>;
    var quantityBought = document.getElementById("quantityOrder").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Xử lý thành công
                closeModal();
                alert("Đặt hàng thành công!");
            } else if (xhr.status === 400) {
                // Xử lý khi số lượng không đủ
                alert("Số lượng sản phẩm không đủ để đặt hàng.");
            } else {
                // Xử lý lỗi khác
                alert("Đã xảy ra lỗi khi đặt hàng.");
            }
        }
    };

    xhr.open("POST", "handle_order.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("productId=" + productId + "&quantity=" + quantityBought);

}

function submitCartForm(event) {
    event.preventDefault(); // Ngăn chặn việc gửi form mặc định của trình duyệt

    var productId = document.querySelector('#addToCartForm [name="productId"]').value;
    var quantity = document.querySelector('#addToCartForm [name="quantityCart"]').value;
    var userID = document.querySelector('#addToCartForm [name="userID"]').value;

    fetch('handle_add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'productId=' + productId + '&quantity=' + quantity,
    })
    .then(response => {
        if (response.ok) {
            closeCartModal();
            alert("Sản phẩm đã được thêm vào giỏ hàng!");
        } else {
            alert("Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng.");
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

        // xhr.open("POST", "handle_order.php", true);
        // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // xhr.send("productId=" + productId + "&quantity=" + quantityBought);

</script>

</body>
</html>