<?php
include('../include/connect.php');
if(isset($_GET['q']))
{
    $q = $_GET['q'];
    $sql="select * FROM danhmuc WHERE tendanhmuc like '%".$q."%' OR iddanhmuc like '%".$q."%' order by iddanhmuc DESC";
    $result = mysqli_query($link,$sql);  
    if(mysqli_num_rows($result)!=0){    
        while($row = mysqli_fetch_array($result))
            {
                echo "<tr>";
                echo "<td class='masp_hienthi_sp'>" .$row['iddanhmuc']. "</td>";
                echo "<td class='tensp_hienthi_sp'>" .$row['tendanhmuc']. "</td>";
                echo "<td class='masp_hienthi_sp'>";
                if($row['loaidanhmuc'] == "Đồng hồ") {
                     echo "Đồng hồ";
                 }
                 else if($row['loaidanhmuc'] == "Phụ kiện") {
                     echo "Phụ kiện";
                 } else {
                     echo "*Chưa rõ*";
                  }
              echo "</td>";
                echo "<td class='tensp_hienthi_sp'>" .$row['mota']. "</td>";
                echo "<td class='active_hienthi_sp'><a href='?admin=suadm&iddanhmuc=" .$row['iddanhmuc']. "'><i class='fas fa-tools' style='transform: scale(1.5); color: #007bff;'></i></a>";
                echo "<a><button type='submit' onclick='checkdeldanhmuc(".$row['iddanhmuc'].")'><i class='fas fa-trash-alt' style='transform: scale(1.5); color: red;'></i></button></a>"; 
                echo "</td>";
        
            }
        }
        else
            {
                echo "<tr><td colspan='5'>Không có danh mục nào </td></tr>";
            }
}
?>
