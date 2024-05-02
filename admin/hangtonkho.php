<link rel="stylesheet" href="css/hienthi_sp.css">
<script type="text/javascript" src="js/checkbox.js"></script>
<?php
	include ('../include/connect.php');
	
    $idkhohang = $_GET['idkhohang'];
    $select = "select * from khohang where idkhohang = $idkhohang";
    $query = mysqli_query($link,$select);
    $result = mysqli_fetch_array($query);
?>

<div class="quanlysp">
	<h3>QUẢN LÝ KHO HÀNG (<?php if(isset($idkhohang)) echo $result['tenkhohang']?>)</h3>
    <div class="live-search form-row">
		<div class="col-md-3 mb-3 sreachsanpham">
			<label><i class="fas fa-search"></i> Tìm kiếm sản phẩm trong kho...</label>
            <input type="text" class="form-control" name="timkiem" placeholder="Nhập id, tên sản phẩm" onkeyup="timkiemhangtonkho(this.value,<?php echo $_GET['idkhohang'] ?>)">
        </div>
        <div class="col-md-5 mb-3 pl-4 form-row thaotac" style="margin-top: 30px;">
            <div >
                <a href='?admin=xulyhangtonkho&formthemvitri&idkhohang=<?php echo $_GET['idkhohang'] ?>' class="btn btn-primary">Các vị trí trong kho</a>
            </div>
        </div>
    </div>
    <div class='content-table scb'>
        <table>
            <thead>
                <tr class='tieude_hienthi_sp'>
                    <th style="width: 120px;">Vị trí kho hàng</th>
                    <th style="width: 350px;">Tên sản phẩm</th>
                    <th>Mã sản phẩm</th>
                    <th style="width: 100px;">Số lượng trong kho</th>                    
                    <th style="width: 150px;">Đơn giá</th>
                    <th style="width: 90px;">Trạng thái</th>
                    <th colspan=2 style="width: 90px;">Thao tác</th>
                </tr>
            </thead>
            <tbody id="row-sanpham">
            <?php
                $sql = mysqli_query($link,"SELECT * FROM sanpham,vitrikhohang,vitrisanpham WHERE vitrisanpham.idsanpham=sanpham.idsanpham AND vitrikhohang.idvitrikhohang = vitrisanpham.idvitrikhohang AND sanpham.idkhohang=".$_GET['idkhohang']);
                    if(($sql && mysqli_num_rows($sql)!=0)){
                        while ($bien = mysqli_fetch_array($sql)) {?>
                            <tr class='noidung_hienthi_sp' style="<?php if( $bien['trangthai'] > "1") echo "opacity: 0.4;";?>">
                                <td class='masp_hienthi_sp' rowspan=$displayRowSpan><?php echo $bien['tenvitrikhohang']; ?></td> 
                                <td class="masp_hienthi_sp"><?php  echo $bien['tensanpham'] ?></td>
                                <td class="masp_hienthi_sp"><?php  echo $bien['idsanpham'] ?></td>
                                <td class="stt_hienthi_sp"><?php echo $bien['soluong'] ?></td>
                                <td class="sl_hienthi_sp"><?php echo $bien['gia'] ?></td>
                                <td class="sl_hienthi_sp"><?php if( $bien['trangthai'] > "1") echo "Chưa thể bán"; else echo "sãn sàng bán"?></td>
                                <td class="active_hienthi_sp" style="width:70px;">
                                    <a href="admin.php?admin=xulyhangtonkho&submit-formchinhsuasanphamtonkho=<?php echo $bien['idsanpham']; ?>&idkhohang=<?php echo $_GET['idkhohang']; ?>"><i class="fas fa-info-circle" style='transform: scale(1.5); color: #007bff;'></i></a>                    
                                </td>
                            </tr>
                    <?php 
                        }
                    }

                    $sql2 = mysqli_query($link,"SELECT * FROM sanpham WHERE sanpham.idkhohang=".$_GET['idkhohang']);
                    if($sql2 && mysqli_num_rows($sql2)!=0){
                        while ($bien2 = mysqli_fetch_array($sql2))
                            if(mysqli_num_rows(mysqli_query($link,"select idsanpham from vitrisanpham where idsanpham = ".$bien2['idsanpham']." LIMIT 0,1")) == 0){
                ?>
                            <tr class='noidung_hienthi_sp' style="<?php if( $bien2['trangthai'] > "1") echo "opacity: 0.4;";?>">
                                <td class="masp_hienthi_sp"><?php echo "<font color='red'>Chưa có vị trí</font>";?></td>
                                <td class="masp_hienthi_sp"><?php  echo $bien2['tensanpham'] ?></td>
                                <td class="masp_hienthi_sp"><?php  echo $bien2['idsanpham'] ?></td>                        
                                <td class="stt_hienthi_sp"><?php echo $bien2['soluong'] ?></td>
                                <td class="sl_hienthi_sp"><?php echo $bien2['gia'] ?></td>
                                <td class="sl_hienthi_sp"><?php if( $bien2['trangthai'] > "1") echo "Chưa thể bán"; else echo "sãn sàng bán"?></td>
                                <td class="active_hienthi_sp" style="width:70px;">
                                    <a href="admin.php?admin=xulyhangtonkho&submit-formchinhsuasanphamtonkho=<?php echo $bien2['idsanpham']; ?>&idkhohang=<?php echo $_GET['idkhohang']; ?>"><i class="fas fa-info-circle" style='transform: scale(1.5); color: #007bff;'></i></a>
                                </td>
                            </tr>
                        <?php 
                        }
                    }
            else echo "<tr height='120px'><td colspan='99'>Hiện tại kho hàng này chưa có sản phẩm</td></tr>";
            ?>
            </tbody>
        </table>
        </div>
</div>