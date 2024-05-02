<?php 
include('../include/connect.php');
if(isset($_GET['q']))
{
    $q = $_GET["q"];
    $sql="select sanpham.*, danhmuc.tendanhmuc FROM sanpham,danhmuc WHERE tensanpham like '%".$q."%' AND sanpham.iddanhmuc=danhmuc.iddanhmuc OR idsanpham like '%".$q."%' AND sanpham.iddanhmuc=danhmuc.iddanhmuc ORDER by idsanpham DESC";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result)!=0){    
        while($row = mysqli_fetch_array($result)) {            
            echo "<tr class='noidung_hienthi_sp'>";
            echo "<td class='masp_hienthi_sp'><input type='checkbox' name='id[]' class='item' class='checkbox' value=" .$row['idsanpham']. "/></td>";
            echo "<td class='masp_hienthi_sp'>" .$row['idsanpham']. "</td>";
            echo "<td class='img_hienthi_sp'><img src='../img/uploads/" .$row['hinhanh']. "'  width='50px' height='50px'></td>";
            echo "<td class='img_hienthi_sp'>" .$row['tensanpham']. "</td>";
            echo "<td class='sl_hienthi_sp'>" .$row['soluong']. "</td>";
            echo "<td class='sl_hienthi_sp'>" .$row['daban']. "</td>";
            echo "<td class='gia_hienthi_sp'>" .$row['gia']. " VNÐ</td>";
            echo "<td  class='madm_hienthi_sp'>" .$row['tendanhmuc']. "</td>";
            echo "<td  class='madm_hienthi_sp'>";

            if($row['trangthai']==1)
                echo "<font color='blue'>Mở bán</font>";
            else
                echo "<font color='red'>Không mở bán</font>";

            echo "</td>";
            echo "<td class='active_hienthi_sp'>";
            echo "<a href='admin.php?admin=suasp&idsanpham=" .$row['idsanpham'] . "'><i class='fas fa-tools' style='transform: scale(1.5); color: #007bff;'></i></a>";
            echo "<div onclick='checkdelsanpham(".$row['idsanpham'].")'><i class='fas fa-trash-alt' style='transform: scale(1.5); color: red;' ></i></div>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='99'>Không có sản phẩm trong CSDL</td></tr>";
    }
} else if (isset($_GET['idsanphamtonkho'])){
    $q = $_GET["idsanphamtonkho"];
    $sql="select * FROM sanphamtonkho WHERE tensanpham like '%".$q."%' OR idsanpham like '%".$q."%' ORDER by idsanpham DESC LIMIT 0,15";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result)!=0){
        echo "
        <table class='tablelivesreach'>
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
                echo "<td>" .$row['dongia']. "</td>";
                echo "<td>" .$row['soluongtonkho']. "</td>";
                echo "<td>Chiếc</td>";
                echo "<td><a class='btn-primary' onclick='additionDataSanPham(" .$row['idsanpham']. ")'>Chọn</a></td>";
            echo "</tr>";
        }
    } else {
        echo "Không có sản phẩm cần tìm";
    }
}
?>