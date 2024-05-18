<?php 
include('../include/connect.php');
include('function/function.php');
if(isset($_GET['q']))
{
    $q="";
    $date1="";
    $date2="";
    $sqlExtra="";

    if(isset($_GET['q']))
    $q = $_GET["q"];

    if($_GET['date1']!="" && $_GET['date2']!="") {
        $date1 = $_GET['date1'];
        $date2 = $_GET['date2'];
        $sqlExtra = "AND ngaydathang between '".$date1."' AND '".$date2."'";
    } else if ($_GET['date1']!="" && $_GET['date2']==""){
        $date1 = $_GET['date1'];
        $sqlExtra = "AND ngaydathang like '%".$date1."'";
    } else if($_GET['date1']=="" && $_GET['date2']!=""){
        $date2 = $_GET['date2'];
        $sqlExtra = "AND ngaydathang like '%".$date2."'";
    }

    if($_GET['trangthai']!=0)
        $sql="select * FROM hoadon WHERE idhoadon like '%".$q."%' ".$sqlExtra." AND trangthai = '".$_GET['trangthai']."' order by idhoadon DESC";
    else
        $sql="select * FROM hoadon WHERE idhoadon like '%".$q."%'  OR  diachi like '%".$q."%' ".$sqlExtra." order by idhoadon DESC";
        
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result)!=0){   
        while($row = mysqli_fetch_array($result)) {            
            echo "<tr class='noidung_hienthi_sp'>";
                echo "<td class='masp_hienthi_sp'><input type='checkbox' name='id[]' class='item' class='checkbox' value=" .$row['idhoadon']. "></td>";
                echo "<td class='masp_hienthi_sp'>" .$row['idhoadon']. "</td>";
                echo "<td class='stt_hienthi_sp'>" .$row['hoten']. "</td>";
                echo "<td class='stt_hienthi_sp'>" .ngaythangnam($row['ngaydathang']). "</td>";
                echo "<td class='sl_hienthi_sp'>" .$row['diachi']. "</td>";
                echo "<td class='sl_hienthi_sp'>" .$row['dienthoai']. "</td>";
                echo "<td class='sl_hienthi_sp'>" .$row['email']. "</td>";
                echo "<td class='sl_hienthi_sp'>"; if($row['trangthai']==1) echo "Chưa xử lý"; else if($row['trangthai']==2) echo "<font color='blue'>Đã giao hàng</font>"; else echo"<font color='red'>Đã hủy đơn hàng</font>"; echo "</td>";
                echo "<td class='active_hienthi_sp' style='width:70px;'>";
                    echo "<a href='admin.php?admin=chitiethoadon&idhoadon=" .$row['idhoadon']. " '><i class='fas fa-info-circle' style='transform: scale(1.5); color: #0056b3;'></i></a>";
                    echo "<div onclick='checkdelsanpham(".$row['idhoadon'].")'><i class='fas fa-trash-alt' style='transform: scale(1.5); color: red;' ></i></div>";
                echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='99'>Không có danh mục nào </td></tr>";
    }
}
?>