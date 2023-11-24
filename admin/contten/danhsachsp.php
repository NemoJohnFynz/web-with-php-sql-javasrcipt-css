<head>
    <link rel="stylesheet" type="text/css" href="./css/dssp.css">
</head>
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
<table class="tables" id="tables">
    <?php
    $dssp = getSP($conn);
    $rows = array();
    while ($row = mysqli_fetch_array($dssp, MYSQLI_ASSOC)) {
        $rows[] = $row;
    }
    
    if (isset($_POST["loc"])) {
        if (($_POST["sapxep"]) == "loai" or ($_POST["loc"]) == "soluong" & ($_POST["loc"]) == "gia") {
            usort($rows, function ($a, $b) {
                return $a[$_POST["sapxep"]] - $b[$_POST["sapxep"]];
            });
        } else if (($_POST["sapxep"]) == "ten") {
            usort($rows, function ($a, $b) {
                return strcmp($a[$_POST["sapxep"]], $b[$_POST["sapxep"]]);
            });
        } 
        else if (substr($_POST["sapxep"], -1) == "_" and ($_POST["sapxep"]) != "ten_") {
            usort($rows, function ($a, $b) {
                return $b[str_replace('_', '', $_POST["sapxep"])] - $a[str_replace('_', '', $_POST["sapxep"])];
            });
            
        } else if (($_POST["sapxep"]) == "ten_") {
            usort($rows, function ($a, $b) {
                return strcmp($b[str_replace('_', '', $_POST["sapxep"])], $a[str_replace('_', '', $_POST["sapxep"])]);
            });
        } else {
            usort($rows, function ($a, $b) {
                return $a["id"] - $b["id"];
            });
        }
    }
    $i = 1;
    if (isset($_POST["tim"])) {
    ?>
        <?php
        $timkiem = $_POST["tutimkiem"];
        if($_POST["loai"]=="null"){
            
                foreach ($rows as $r) {
                    $tensanpham = $r["ten"];
                    if(strpos($tensanpham, "$timkiem") !== false) {
                        $id = $r["id"];
                ?>
                        <tr class="sanpham">
                           
                            <td class="stt"><?php echo $i; ?></td>
                            <td class="anhsp"><img class="imgspds" src="../img/<?php echo $r["hinh"]; ?>" /></td>
                            <td class="luachonsp">
                                <a href="?page=xemchitietsp&spid=<?php echo $id ?>" style="text-decoration:none"><input type="submit" class="bt_slsp" value="xem chi tiết" name="xct"></a>
                                <a href="?page=suasanpham&spid=<?php echo $id ?>"><input type="submit" class="bt_slsua" value="" name="sua"></a><span class="text_bt_slsua">sửa</span>
                                <form method="post" class="luachon_post">
                                    <input type="hidden" value="<?php echo $id; ?>" name="uid">
                                    <input type="submit" class="bt_slxoa" value="" name="xoasp">
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td class="namesp">sản phẩm: <?php echo $r["ten"]; ?></td>
                        </tr>

                    <?php
                    }
                    $i++;
                
                }
        }
        else if($_POST["loai"]!="null"){
            foreach ($rows as $r) {
                if($_POST["loai"]==$r["loai"]){
                    $tensanpham = $r["ten"];
                    if (strpos($tensanpham, "$timkiem") !== false) {
                            $id = $r["id"];
                    ?>
                            <tr class="sanpham"> 
                                <td class="stt"><?php echo $i; ?></td>
                                <td class="anhsp"><img class="imgspds" src="../img/<?php echo $r["hinh"]; ?>" /></td>
                                <td class="luachonsp">
                                    <a href="?page=xemchitietsp&spid=<?php echo $id ?>" style="text-decoration:none"><input type="submit" class="bt_slsp" value="xem chi tiết" name="xct"></a>
                                    <a href="?page=suasanpham&spid=<?php echo $id ?>"><input type="submit" class="bt_slsua" value="" name="sua"></a><span class="text_bt_slsua">sửa</span>
                                    <form method="post" class="luachon_post">
                                        <input type="hidden" value="<?php echo $id; ?>" name="uid">
                                        <input type="submit" class="bt_slxoa" value="" name="xoasp">
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td class="namesp">sản phẩm: <?php echo $r["ten"]; ?></td>
                            </tr>
                        
                    <?php
                    }
                    $i++;
                } 
            }
        }
        
    } 
    
    else {
            $dsLoai = getTbl_Loai($conn);
            $lsp = mysqli_fetch_array($dsLoai);
            $dssp = array_values($rows);
            foreach ($dssp as $r){
                $id = $r["id"];
                ?>
                <tr class="sanpham">
                <div class="none"></div>
                    <td class="stt"><?php echo $i; ?></td>
                    <td class="anhsp"><img class="imgspds" src="../img/<?php echo $r["hinh"]; ?>" /></td>
                    <td class="luachonsp">
                        <a href="?page=xemchitietsp&spid=<?php echo $id ?>" style="text-decoration:none"><input type="submit" class="bt_slsp" value="xem chi tiết" name="xct"></a>
                        <a href="?page=suasanpham&spid=<?php echo $id ?>"><input type="submit" class="bt_slsua" value="" name="sua"></a><span class="text_bt_slsua">sửa</span>
                        <form method="post" class="luachon_post">
                            <input type="hidden" value="<?php echo $id; ?>" name="uid">
                            <input type="submit" class="bt_slxoa" value="" name="xoasp">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td class="namesp">sản phẩm: <?php echo $r["ten"]; ?></td>
                </tr>

            <?php
                $i++;
            }
        }
        ?>
</table>
<?php
    
    if (isset($_POST["xoasp"])) {
        $id = $_POST["uid"];
        deleteSP($conn, $id);
        echo '<script>window.location.href = window.location.href;</script>';
    }
?>