<?php 
include('../include/connect.php');
if(isset($_GET['q']))
{
    $q = $_GET["q"];
    $sql="select * FROM hotro WHERE idhotro like '%".$q."%' OR hoten like '%".$q."%' order by idhotro DESC";
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result)!=0){    
        while($row = mysqli_fetch_array($result)) {            
            echo "<tr class='noidung_hienthi_sp'>";
            echo "<td class='masp_hienthi_sp'><input type='checkbox' name='id[]' class='item' class='checkbox' value='".$row['idhotro']."'/></td>";
            echo "<td class='masp_hienthi_sp'>".$row['idhotro']."</td>";
            echo "<td class='sl_hienthi_sp'>".$row['hoten']."</td>";
            echo "<td class='stt_hienthi_sp'><div class='noidungchude'>".$row['chude']."</div></td>";
            echo "<td class='img_hienthi_sp' style='text-align:left;'><div class='noidungchitiet'>".$row['noidung']."</div></td>";
            echo "<td class='sl_hienthi_sp'>".$row['email']."</td>";
			echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='99'>Hiện không có thư hỗ trợ trong CSDL</td></tr>";
    }
}
?>