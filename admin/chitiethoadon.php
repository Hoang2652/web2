<link rel="stylesheet" href="css/hienthi_sp.css" >
<?php
	include ('../include/connect.php');
	
    $select = "select chitiethoadon.idchitiethoadon,chitiethoadon.idhoadon,chitiethoadon.idsanpham,sanpham.tensanpham,chitiethoadon.soluong,sanpham.gia from chitiethoadon inner join sanpham where chitiethoadon.idsanpham=sanpham.idsanpham and idhoadon={$_GET['idhoadon']}";
    $query = mysqli_query($link,$select);
    $dem = mysqli_num_rows($query);
?>
<div class="content-table">
	<h3 class="content-tieude">CHI TIẾT HÓA ĐƠN</h3>
    <div colspan=3 align="left" style=" margin-left: 2rem; padding:0px 20px 10px 0px; font-size:20px;">Mã hóa đơn: <b><font color="red"><?php echo $_GET['idhoadon'] ?></font></b></div>
    <table>
        <thead>
            <tr class='tieude_hienthi_sp'>
                <th>Id sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Giảm giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $tong=0;					
                if($dem > 0){
                while ($bien = mysqli_fetch_array($query))
                {
                    $select2 = "select * from chitiethoadon where idchitiethoadon='".$bien['idchitiethoadon']."'";
                    $query2 = mysqli_query($link,$select2);
                    $row2 = mysqli_fetch_array($query2);
                    if($row2['giamgia'] != null && $row2['giamgia'] > 0){
                        $giamgia = $row2['giamgia'];
                        $thanhtien=$bien['gia']*$bien['soluong'] - $bien['gia']*$bien['soluong']*$giamgia / 100;
                    }
                    else{
                        $giamgia = 0;
                        $thanhtien=$bien['gia']*$bien['soluong'];
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
            ?>
                <tr class='noidung_hienthi_sp'>
                    <td class="masp_hienthi_sp"><?php  echo $bien['idsanpham'] ?></td>
                    <td class="stt_hienthi_sp"><?php echo $bien['tensanpham'] ?></td>
                    <td class="sl_hienthi_sp"><?php echo $bien['soluong'] ?></td>
                    <td class="sl_hienthi_sp"><?php echo number_format($bien['gia'],0,",",".") ?></td>
                    <td class="sl_hienthi_sp"><?php echo $giamgia.'%' ?></td>
                    <td class="sl_hienthi_sp"><?php echo number_format($thanhtien,0,",",".") ?></td>    
                </tr>
                <?php if(isset($tenquatang)){ ?>
                    <tr class='quatangcart'>
                        <td colspan='6'><?php echo $tenquatang ?></td>
                    </tr>
                <?php } ?>
            <?php 
                }		
            ?>
                <tr>
                    <td colspan=6 align="right" style=" border-bottom: none; padding:20px 20px 10px 0px; font-size:20px;">Tổng: <b><font color="red"><?php echo number_format($tong,0,",",".")." VNĐ"?></font></b></td>
                </tr>
            <?php 
            }
            else echo "<tr><td colspan='6'>Không có sản phẩm trong CSDL</td></tr>";
            ?>
        </tbody>
    </table>
    <div id="inhoadon">
        <p style="float:right; margin: 1rem 2rem ; padding-right:30px;"><a class="btn btn-primary" href="inhd.php?idhoadon=<?=$_GET['idhoadon']?>" target="_blank">In hoá đơn</a></p>
    </div>
</div>
