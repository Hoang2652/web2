<link rel="stylesheet" href="css/hienthi_sp.css">
<script type="text/javascript" src="js/checkbox.js"></script>
<?php
	include ('../include/connect.php');
	
    $select = "select * from hoadon";
    $query = mysqli_query($link,$select);
    $dem = mysqli_num_rows($query);
?>
<div class="quanlysp">
	<h3>QUẢN LÝ HÓA ĐƠN</h3>
    <p style="text-align:right;">Có tổng cộng: <font color=red><b><?php echo $dem ?></b></font> hóa đơn</p>
	<form action="admin.php?admin=xulyhd" method="post" style="width:100%;">
    <div class="form-row">
        <div class="col-md-2 mb-3">
            <label><i class="fas fa-search"></i> Tìm kiếm hóa đơn</label>
            <input type="text" class="form-control" id="timkiem-hoadon" name="timkiem" placeholder="Nhập id hóa đơn" onkeyup="timkiemhoadon()">
        </div>
        <div class="col-md-8 form-row">
            <div class="col-md-3 mb-3">
                <label>Từ ngày: </label>
                <input type="date" id="date-from" class="form-control" name="ngaydathang" onchange="timkiemhoadon()" onkeyup="timkiemhoadon()"/>
            </div>
            <div class="col-md-3 mb-3">
                <label>Đến ngày: </label>
                <input type="date" id="date-to" class="form-control" name="ngaydathang" onchange="timkiemhoadon()" onkeyup="timkiemhoadon()"/>
            </div>
            <div id="check" class="sreach-trangthai col-md-3 mb-3">
                <label>Lọc trạng thái: </label>
                <select id="filter-donhang" class="form-control" onchange="timkiemhoadon()">
                    <option value="0" selected>---trạng thái---</option>
                    <option value="1">Chưa xử lý</option>
                    <option value="2">Đã giao hàng</option>
                    <option value="3">Đã hủy đơn hàng</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>Cập nhật trạng thái:</label>
                <div class="form-control" style="border: none;width: 280px;">
                    <button class="btn btn-outline-primary" type="submit" name="giaohang" value="Đã giao hàng" >Đã giao hàng</button>
                    <button class="btn btn-outline-primary" type="submit" name="huy" value="Hủy đơn hàng" >Hủy đơn hàng</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='content-table'>
<table>
    <thead>
    <tr class='tieude_hienthi_sp'>
        <th width="30"><input type="checkbox" name="check"  class="checkbox" onclick="checkall('item', this)"></th>
        <th>ID</th>
        <th style="width: 130px;">Họ Tên</th>
        <th style="width: 100px;">Ngày đặt hàng</th>
        <th style="width: 350px;">Địa chỉ giao hàng</th>
        <th>Điện Thoại</th>
        <th>Email</th>
        <th style="width: 90px;">Trạng thái</th>
        <th colspan=2 style="width: 90px;">Thao tác</th>
    </tr>
</thead>
<tbody id="row-sanpham">
    <?php
		$sql = mysqli_query($link,"SELECT * FROM hoadon ORDER by idhoadon DESC");
		if(mysqli_num_rows($sql)!=0)
        while ($bien = mysqli_fetch_array($sql))
        {
?>
            <tr class='noidung_hienthi_sp'>
                <td class="masp_hienthi_sp"><input type="checkbox" name="id[]" class="item" class="checkbox" value="<?=$bien['idhoadon']?>"/></td>
                <td class="masp_hienthi_sp"><?php  echo $bien['idhoadon'] ?></td>
                <td class="stt_hienthi_sp"><?php echo $bien['hoten'] ?></td>
                <td class="stt_hienthi_sp"><?php echo ngaythangnam($bien['ngaydathang']) ?></td>
				<td class="sl_hienthi_sp"><?php echo $bien['diachi'] ?></td>
				<td class="sl_hienthi_sp"><?php echo $bien['dienthoai'] ?></td>
				<td class="sl_hienthi_sp"><?php echo $bien['email'] ?></td>
				<td class="sl_hienthi_sp"><?php if($bien['trangthai']==1) echo "Chưa xử lý"; else if($bien['trangthai']==2) echo"<font color='blue'>Đã giao hàng</font>"; else echo"<font color='red'>Đã hủy đơn hàng</font>";?></td>
				<td class="active_hienthi_sp" style="width:70px;">
                    <a href="admin.php?admin=chitiethoadon&idhoadon=<?php echo $bien['idhoadon']; ?> "><i class="fas fa-info-circle" style='transform: scale(1.5); color: #007bff;'></i></a>
                    <div onclick="checkdelhoadon(<?php echo $bien['idhoadon']?>)"><i class="fas fa-trash-alt" style="transform: scale(1.5); color: red;" ></i></div>
				</td>
            </tr>
<?php 
    }
    else echo "<tr><td colspan='99'>Không có sản phẩm trong CSDL</td></tr>";
	
?>
</tbody>
</table>
</div>
</form>

