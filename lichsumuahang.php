<?php 
echo "<script>document.getElementById('content').innerHTML=''</script>";
echo "<script>document.getElementById('left-content').innerHTML=''</script>";
echo "<script>document.getElementById('doitac').innerHTML=''</script>";
?>
<div id="lichsumuahang">
	<div class="tabs">
			<div style="text-align: center;">Lịch sử mua hàng </div>
	</div>
    <div id="sub-lichsumuahang">
        <?php

        if(!isset($_SESSION['idnguoidung']))
            echo "<div id='thongbaokhongco'>Bạn cần phải đăng nhập để xem lịch sử mua hàng</div>";
        else {
            $select = "select * from hoadon where idnguoidung=".$_SESSION['idnguoidung']." order by idhoadon DESC";
            $query = mysqli_query($link,$select);
            $dem = mysqli_num_rows($query);
            while ($row = mysqli_fetch_array($query))
            {
                echo "<div class='hoadon'>
                        <div class='tieudehoadon'>
                            <div style='float:left;margin-left: 20px;'>Mã hóa đơn: ".$row['idhoadon']."</div>
                            <div style='float:right;margin-right: 20px;'>Ngày đặt hàng: ".ngaythangnam($row['ngaydathang'])."</div>
                        </div>
                    <div class='hoadon-content' style='display:block'>";

                    $select1 = "select chitiethoadon.idchitiethoadon,chitiethoadon.idhoadon,chitiethoadon.idsanpham,sanpham.tensanpham,chitiethoadon.soluong,sanpham.gia from chitiethoadon inner join sanpham where chitiethoadon.idsanpham=sanpham.idsanpham and idhoadon='".$row['idhoadon']."'";
                    $query1 = mysqli_query($link,$select1);
                    $dem1 = mysqli_num_rows($query1);
                    if($dem1==0)
                        echo "<div style='margin:auto;width: fit-content;padding: 10px;color:red;'>Không có dữ liệu về hóa đơn này</div>";
                    else {
                        echo "<table class='table'>
                                <thead class='tieude-hienthi-hoadon'>
                                <tr>
                                    <th scope='col'>Tên sản phẩm</th>
                                    <th scope='col' style='width: 82px;'>Số lượng</th>
                                    <th scope='col'>Giá</th>
                                    <th scope='col'>Giảm giá</th>
                                    <th scope='col'>Thành tiền</th>
                                </tr>
                                </thead>
                                <tbody>";
                                $tong = 0;

                                while ($row1 = mysqli_fetch_array($query1)) 
                                {
                                    $select2 = "select * from chitiethoadon where idchitiethoadon='".$row1['idchitiethoadon']."'";
                                    $query2 = mysqli_query($link,$select2);
                                    $row2 = mysqli_fetch_array($query2);
                                    if($row2['giamgia'] != null && $row2['giamgia'] > 0){
                                        $giamgia = $row2['giamgia'];
                                        $thanhtien=$row1['gia']*$row1['soluong'] - $row1['gia']*$row1['soluong']*$giamgia / 100;
                                    }
                                    else{
                                        $giamgia = 0;
                                        $thanhtien=$row1['gia']*$row1['soluong'];
                                    }
                                    if($row2['quatang'] != null){
                                        $select3 = "select * from sanpham where idsanpham='".$row2['quatang']."'";
                                        $query3 = mysqli_query($link,$select3);
                                        $row3 = mysqli_fetch_array($query3);
                                        $tenquatang = 'Tặng kèm: '.$row3['tensanpham'];
                                    }
                                    else{
                                        $tenquatang = null;
                                    }
                                    $tong+=$thanhtien;

                                    echo "<tr class='noidung_hienthi_sp' style='color: #666666; font-size: 14px;'>
                                            <td class='stt_hienthi_sp'>" .$row1['tensanpham']. "</td>
                                            <td class='sl_hienthi_sp'>" .$row1['soluong']. "</td>
                                            <td class='sl_hienthi_sp'>" .number_format($row1['gia'],0,",","."). "</td>
                                            <td class='sl_hienthi_sp'>" .$giamgia.'%'. "</td>
                                            <td class='sl_hienthi_sp'>" .number_format($thanhtien,0,",","."). "</td>
                                        </tr>";
                                    if(isset($tenquatang)){
                                        echo "<tr class='quatangcart'>
                                                <td colspan='".'5'."'> " .$tenquatang ."</td>
                                             </tr>";
                                    }
                                }
                                echo "<tr>
                                    <td colspan=5 style='padding:10px; font-size:16px;' class='tongtienhoadon'>
                                        <div style='float:left;font-size: 14px;font-weight: bold;padding: 5px;'>Trạng thái đơn hàng: ";
                                        if($row['trangthai']==1)
                                            echo "Chưa xử lý"; 
                                        else if($row['trangthai']==2) 
                                            echo"<font color='blue'>Đã giao hàng</font>"; 
                                        else 
                                            echo"<font color='red'>Đã hủy đơn hàng</font>";
                                echo    "</div> 
                                        <div style='float:right;'>Tổng tiền: <b><font color='red'>" .number_format($tong,0,',','.'). "</font></b> VND</div></td>
                                    </tr>
                                    </tbody>
                                </table>";
                }
                echo "</div></div>";
            }
        }
        ?>
   </div> <!--- end lichsumuahang --->
</div><!--- ho tro --->