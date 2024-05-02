<link rel="stylesheet" href="css/hienthi_sp.css" >
<?php
	include ('../include/connect.php');
    $select = "select * from hoadonnhapxuatkho where idhoadonnhapxuatkho='".$_GET['idhoadonnhapxuatkho']."'";
    $query = mysqli_query($link,$select);
    $dem = mysqli_num_rows($query);
?>
<div class="content-table">
	<h3 class="content-tieude">CHI TIẾT HÓA ĐƠN NHẬP XUẤT KHO</h3>
    <div colspan=3 align="left" style=" margin-left: 2rem; padding:0px 20px 10px 0px; font-size:20px;">Mã hóa đơn: <b><font color="red"><?php echo $_GET['idhoadonnhapxuatkho'] ?></font></b></div>
    <table>
        <thead>
            <tr class='tieude_hienthi_sp'>
                <th>Id sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Đon giá</th>
                <th>Số lượng</th>
                <th>Đơn vị</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $tong=0;					
                if($dem > 0){
                    $select2 = "select * from chitiethoadonnhapxuatkho where idhoadonnhapxuatkho='".$_GET['idhoadonnhapxuatkho']."'";
                    $query2 = mysqli_query($link,$select2);
                while ($bien = mysqli_fetch_array($query2))
                {
                    $thanhtien=$bien['dongia']*$bien['soluong'];
                    $tong+=$thanhtien;
            ?>
                <tr class='noidung_hienthi_sp'>
                    <td class="masp_hienthi_sp"><?php  echo $bien['idsanpham'] ?></td>
                    <td class="stt_hienthi_sp"><?php echo $bien['tensanpham'] ?></td>
                    <td class="sl_hienthi_sp"><?php echo number_format($bien['dongia'],0,",",".") ?></td>
                    <td class="sl_hienthi_sp"><?php echo $bien['soluong'] ?></td>
                    <td class="sl_hienthi_sp"><?php echo $bien['donvi'] ?></td>
                    <td class="sl_hienthi_sp"><?php echo number_format($thanhtien,0,",",".") ?></td>    
                </tr>
            <?php 
                }		
            ?>
                <tr>
                    <td colspan=5 align="right" style=" border-bottom: none; padding:20px 20px 10px 0px; font-size:20px;">Tổng: <b><font color="red"><?php echo number_format($tong,0,",",".")." VNĐ"?></font></b></td>
                </tr>
            <?php 
            }
            else echo "<tr><td colspan='6'>Không có dữ liệu về đơn hàng này</td></tr>";
            ?>
        </tbody>
    </table>
    <div id="inhoadon">
        <p style="float:right; margin: 1rem 2rem ; padding-right:30px;"><a class="btn btn-primary" href="inhoadonnhapxuat.php?idhoadonnhapxuatkho=<?=$_GET['idhoadonnhapxuatkho']?>" target="_blank">In hoá đơn</a></p>
    </div>
</div>
