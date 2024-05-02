<?php
require_once("../include/connect.php");
if (isset($_GET['submit-themcotdulieu'])){
    $count = $_GET['submit-themcotdulieu'];
    echo "<tr class='noidung_hienthi_sp' id='cotdulieunhapxuat".$count."'>";
        echo "<td class='masp_hienthi_sp'>$count</td>";
        echo "<td class='stt_hienthi_sp'><input type='text' name='sanpham[$count][]'></td>";
        echo "<td class='masp_hienthi_sp'><input type='text' name='sanpham[$count][]'></td>";
        echo "<td class='sl_hienthi_sp'><input type='text' name='sanpham[$count][]'></td>";
        echo "<td class='sl_hienthi_sp'><input type='text' name='sanpham[$count][]'></td>";
        echo "<td class='sl_hienthi_sp'><input type='text' name='sanpham[$count][]'></td>";
    echo "</tr>";
} else if (isset($_GET['submit-livesreachxuatkho']) && isset($_GET['idCol'])) {
    $q = $_GET["submit-livesreachxuatkho"];
    $count1 = $_GET["idCol"];
    $sql="select * FROM sanpham WHERE tensanpham like '%".$q."%' OR idsanpham like '%".$q."%' ORDER by idsanpham DESC LIMIT 0,15";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result)!=0){
        echo "
        <table class='tablelivesreach-sanphamtonkho'>
            <thead>
                <th class='tensanpham-xuatkho'>Tên sản phẩm</th>
                <th class='idsanpham-xuatkho'>Mã sản phẩm</th>
                <th class='dongia-xuatkho'>Đơn giá</th>
                <th class='soluongtonkho-xuatkho'>Số lượng</th>
                <th class='donvi-xuatkho'>Đơn vị</th>
                <th class='thaotac-xuatkho'>Thao tác</th>
            </thead>    
            <tbody>";    
        while($row = mysqli_fetch_array($result)) {            
            echo "<tr class='noidung_hienthi_sp'>";
                echo "<td>" .$row['tensanpham']. "</td>";
                echo "<td>" .$row['idsanpham']. "</td>";
                echo "<td>" .$row['gia']. "</td>";
                echo "<td>" .$row['soluong']. "</td>";
                echo "<td>Chiếc</td>";
                echo "<td><a class='btn-primary' onclick='additionDataXuat(" .$row['idsanpham']. "," .$count1. ")'>Thêm sản phẩm</a></td>";
            echo "</tr>";
        }
    } else {
        echo "Không có sản phẩm cần tìm";
    }
}else if (isset($_GET['submit-themcotdulieuxuat']) && isset($_GET['idCol'])) {
    $idsanpham = $_GET['submit-themcotdulieuxuat'];
    $count2 = $_GET['idCol'];
    $sql="select * FROM sanpham WHERE idsanpham = $idsanpham ";
    $result = mysqli_query($link,$sql);
    if($row = mysqli_fetch_array($result)){
        echo "<tr class='noidung_hienthi_sp' id='cotdulieunhapxuat".$count2."'>";
            echo "<td class='masp_hienthi_sp'>".($count2+1)."</td>";
            echo "<td class='stt_hienthi_sp'><input type='text' name='sanpham[$count2][]' value='".$row['tensanpham']."' readonly></td>";
            echo "<td class='masp_hienthi_sp'><input type='text' name='sanpham[$count2][]' value='".$row['idsanpham']."' readonly></td>";
            echo "<td class='sl_hienthi_sp'><input type='text' name='sanpham[$count2][]' value='".$row['gia']."' required></td>";
            echo "<td class='sl_hienthi_sp'><input type='text' name='sanpham[$count2][]' required></td>";
            echo "<td class='sl_hienthi_sp'><input type='text' name='sanpham[$count2][]' value='Chiếc' readonly></td>";
        echo "</tr>";
    }
} else if (isset($_GET['submit-themdulieusanpham'])) {
    $idsanpham = $_GET['submit-themdulieusanpham'];
    $sql="select * FROM sanpham WHERE idsanpham = $idsanpham ";
    $result = mysqli_query($link,$sql);
    if($row = mysqli_fetch_array($result)){
        echo"
        <div class='form-row mb-3'>
            <div class='col-md-6'>
                <label for='tensanpham'>Tên SP</label>
                <input class='form-control' type='text' name='tensanpham' value='".$row['tensanpham']."'/>
                <input class='form-control' type='hidden' name='idsanpham' value='".$row['idsanpham']."' required/>
            </div>
            <div class='col-md-6'>
                <label for='iddanhmuc' style='display: grid'> Mã DM</label>
                <select class='custom-select mr-sm-2' style='width: 190px;' name='iddanhmuc' required>
                    <option value=''>Chọn danh muc</option>";
                        $show = mysqli_query($link,"SELECT * FROM danhmuc WHERE loaidanhmuc='TH'");
                        while($show1 = mysqli_fetch_array($show))
                        {
                            $iddanhmuc = $show1['iddanhmuc'];	
                            $tendanhmuc = $show1['tendanhmuc'];
                            echo "<option value='".$iddanhmuc."'> - ".$tendanhmuc."</option>";
                        }
        echo "  </select>
            </div>
        </div>
        <div class='form-row mb-3'>
            <div class='col-md-6'>
                <label for='soluong'>Số lượng bán (Tồn kho: ".$row['soluong'].")</label>
                <input class='form-control col-sm-5' type='text' name='soluong' required/>
            </div>
            <div class='col-md-6'>
                <label for='gia' >Giá bán (Giá vốn: ".$row['gia'].")</label>
                <input class='form-control col-sm-5' type='text' name='gia' required/>
            </div>
        </div>
        <div class='form-row mb-3'>
            <div class='col-md-6'>
                <label for='hinhanh'>Hình ảnh</label>			
                <input class='form-control-file' type='file' name='hinhanh' required/>
            </div>
        </div>
        <div class='form-row mb-3'>
            <div class='col-md-6'>
                <label for='loaisanpham'>Loại sản phẩm</label>			
                <select class='custom-select mr-sm-2' style='width: 190px;' name='loaisanpham' required>
                    <option value=''>Chọn danh muc</option>";
                $show = mysqli_query($link,"SELECT * FROM danhmuc WHERE loaidanhmuc='LSP'");
                while($show1 = mysqli_fetch_array($show))
                {
                    $iddanhmuc = $show1['iddanhmuc'];	
                    $tendanhmuc = $show1['tendanhmuc'];
                    echo "<option value='".$iddanhmuc."'> - ".$tendanhmuc."</option>";
                }
        echo "  </select>
            </div>
            <div class='col-md-6'>
                <label for='xuatxu'>Xuất xứ</label>			
                <input class='form-control' type='text' name='xuatxu' required/>
            </div>
        </div>
        <div class='form-row mb-3'>
            <div class='col-md-6'>
                <label for='mota'>Mô tả</label>			
                <textarea class='form-control' type='text' name='mota' required></textarea>
            </div>
            <div class='col-md-6'>
                <label for='baohanh'>Bảo hành (tháng)</label>			
                <input class='form-control' type='text' name='baohanh' required/>
            </div>
        </div>";
    }
}
?>