<?php 
include('../include/connect.php');
if(isset($_GET['q']))
{
    $q = $_GET["q"];
    $sql="select * FROM nguoidung WHERE (idnguoidung like '%".$q."%' OR tendangnhap like '%".$q."%') AND (phanquyen='1' OR phanquyen='2') order by idnguoidung DESC";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result)!=0){    
        while($row = mysqli_fetch_array($result)) {            
            echo "<tr class='noidung_hienthi_sp'>";
            echo "<td class='masp_hienthi_sp'>" .$row['idnguoidung']. "</td>";
            echo "<td class='stt_hienthi_sp'>" .$row['tennguoidung']. "</td>";
            echo "<td class='img_hienthi_sp'> " .$row['tendangnhap']. "  </td>";
			echo "<td class='sl_hienthi_sp'>" .$row['email']. "</td>";
			echo "<td class='sl_hienthi_sp'>" .$row['dienthoai']. "</td>";
			echo "<td class='sl_hienthi_sp'>";
			
            if($row['phanquyen']==2)
                echo "Nhân viên";
            else 
                echo "Người dùng";

			echo "</td>";
            echo "<td class='active_hienthi_sp'>";

                    if($row['trangthai']==1)
                        echo "<div id='trangthai'><font color='blue'>Mở</font></div>";
                    else 
                        echo "<div id='trangthai'><font color='red'>Khóa</font></div>";
                        
            echo "</td>";
            echo "<td class='active_hienthi_sp'>";
            echo "<a href='?admin=suand&idnguoidung=" .$row['idnguoidung']. "'><i class='fas fa-tools' style='transform: scale(1.5);'></i></a>";
			echo "<div onclick = 'checklock(" .$row['idnguoidung']. ", " .$row['trangthai']. ")' ><i class='fas fa-lock' style='transform: scale(1.5); color: #79d100;'></i></div>";
            echo "<div onclick='checkdelsanpham(".$row['idnguoidung'].")'><i class='fas fa-trash-alt' style='transform: scale(1.5); color: red;' ></i></div>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Không có danh mục nào </td></tr>";
    }
}
?>