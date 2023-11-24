<div class="container_timkiem">
    <form method="post" class="luachon_post">
        <span class="text_sapxep">xắp xếp</span>
        <select name="sapxep" class="select_sapxep">
            <option value="ten">theo tên a-z</option>
            <option value="ten_">theo tên z-a</option>
            <option value="id">theo thứ tự id tăng dần</option>
            <option value="id_">theo thứ tự id giảm dần</option>
            <option value="loai">theo loại</option>
            <option value="soluong">theo số lượng tăng dần</option>
            <option value="soluong_">theo số lượng giảm dần</option>
            <option value="gia">theo giá tăng dần</option>
            <option value="gia_">theo giá giảm dần</option>
        </select>
        <div class="left_loc">
            <input type="submit" class="bt_loc" value="" name="loc">
            
        </div>
        <div class="right_loc">
            <div class="box_select">
                <div class="tittle_lsp">loại sản phẩm :</div>
                <span class="box_right_textandnummber_select">
                    <select class="sl_input" name="loai">
                        <option value="null">không</option>
                        <?php 
                        $dsLoai = getTbl_Loai($conn);
                        while ($row = mysqli_fetch_array($dsLoai)) {
                        ?>
                            <option value="<?php echo $row["id"]; ?>"><?php echo $row["ten"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </span>
            </div>
            <input type="text" name="tutimkiem" placeholder="từ tìm kiếm" class="input_timkiem">
            <div class="bt_click_tim">
            <input type="submit" class="bt_timkiem"  value="tìm kiếm" name="tim">
            </div>
        </div>
        
    </form>
</div>