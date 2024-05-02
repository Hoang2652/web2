<?php 
include ('../include/connect.php');
?>
<link rel="stylesheet" href="css/hienthi_sp.css">
<script type="text/javascript" src="js/checkbox.js"></script>
<div class="quanlykhohang">
    <div class="tacvu-qlkh">
	<h3>QUẢN LÝ KHO HÀNG</h3>
        <div class="col-md-8 form-row">
            <a href='?admin=xulykhohang&formthemkhohang' class="btn btn-primary add-khohang">Thêm kho hàng</a>
            <a href='?admin=nhapxuatkhohang' class="btn btn-primary qlnx">Quản lý nhập xuất</a>
        </div>
    </div>
	<div class='content-table scb'>
        <table>
            <thead>
                <tr class='tieude_hienthi_sp tieude-khohang'>
                    <th width="30"><input type="checkbox" name="check"  class="checkbox" onclick="checkall('item', this)"></th>
                    <th>ID hóa đơn</th>
                    <th style="width: 130px;">Tên kho hàng</th>
                    <th style="width: 200px;">Địa chỉ</th>
					<th style="width: 100px;">Ngày giao hàng</th>
                    <th style="width: 150px;">Ghi chú</th>
					<th style="width: 90px;">Thao tác</th>
                </tr>
            </thead>
            <tbody id="row-sanpham">
            <?php
				$select = "select * from khohang";
				$query = mysqli_query($link,$select);
				if($query) {
                while ($bien = mysqli_fetch_array($query))
                {
            ?>
                	<tr class='noidung_hienthi_sp'>

							<td class="masp_hienthi_sp"><input type="checkbox" name="idkhohang[]" class="item" class="checkbox" value="<?=$bien['idkhohang']?>"></td>
							<td class="masp_hienthi_sp"><?php  echo $bien['idkhohang'] ?></td>
							<td class="stt_hienthi_sp"><?php echo $bien['tenkhohang'] ?></td>
							<td class="sl_hienthi_sp"><?php echo $bien['diachikhohang'] ?></td>
							<td class="sl_hienthi_sp"><?php echo ngaythangnam($bien['ngaycapnhat']) ?></td>
							<td class="stt_hienthi_sp"><?php echo $bien['ghichu'] ?></td>
							<td class="masp_hienthi_sp">
                                <a href="?admin=hangtonkho&idkhohang=<?php echo $bien['idkhohang'] ?>"><i class="fa-solid fa-arrow-right-to-bracket" style='transform: scale(1.5); color: grey;'></i></a>
                                <a href="?admin=xulykhohang&submit-formchinhsuakhohang=<?php echo $bien['idkhohang']; ?> "><i class="fas fa-tools" style='transform: scale(1.5); color: #007bff;'></i></a>
                                <a href="#" onclick="checkdelkhohang(<?php echo $bien['idkhohang']?>)"><i class="fas fa-trash-alt" style="transform: scale(1.5); color: red;" ></i></a>
                            </td>						
                    </tr>
            <?php 
				}} else echo "<tr><td colspan='99'>Hiện tại chưa có hóa đơn nhập xuất</td></tr>";
            ?>
            </tbody>
        </table>
    </div>
</div>