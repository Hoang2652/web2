<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thêm Sản Phẩm</title>
<link rel="stylesheet" href="css/them_sanpham.css" />
</head>
<link rel="stylesheet" href="css/hienthi_sp.css">
<script type="text/javascript" src="js/checkbox.js"></script>
<?php
	include ('../include/connect.php');
	
    $select = "select * from hotro ";
    $query = mysqli_query($link,$select);
    $dem = mysqli_num_rows($query);
?>
<form action="admin.php?admin=xulyht" method="post">
<div class="quanlysp">
	<h3>QUẢN LÝ HỖ TRỢ KHÁCH HÀNG</h3>
	<p style="float:right; margin-top: 40px;">Có tổng cộng: <font color=red><b><?php echo $dem ?></b></font> thư hỗ trợ</p>
        <div class="live-search form-row">
            <div class="col-md-4 mb-3 sreachsanpham">
                <label><i class="fas fa-search"></i> Tìm kiếm thư hỗ trợ</label>
                <input type="text" class="form-control" name="timkiem" style="margin-top: 7px;" placeholder="Nhập id, họ tên khách hàng" onkeyup="timkiemtructiep(this.value,'hotro')">
            </div>
            <div class="col-md-6 mb-3 ml-5">
                <label>Thao tác:</label>
                <div style="border: none; margin-top: 7px;">
                    <a href='?admin=cauhoithuonggap'><div class="btn btn-primary"> Câu hỏi thường gặp</div></a>
                    <button class="btn btn-danger" type="submit" name="xoa" value="Xóa góp ý"> Xóa thư hỗ trợ</button>
                </div>
            </div>
		</div>
</div>
<div class='content-table'>
<table>
    <thead>
    <tr class='tieude_hienthi_sp'>
		<th width="30"><input type="checkbox" name="check"  class="checkbox" onclick="checkall('item', this)"></th>
        <th style="width: 35px;">ID</th>
		<th style="width: 130px;">Họ và tên</th>
        <th style="width: 130px;">Chủ đề</th>
        <th style="width: 600px;">Nội dung</th>
        <th style="width: 100px;">Email</th>
    </tr>
</thead>
<tbody id="row-sanpham">
    <?php
	$sql = mysqli_query($link,"SELECT * FROM hotro"); 								
    if($dem > 0)
        while ($bien = mysqli_fetch_array($sql))
        {
?>
            <tr class='noidung_hienthi_sp'>
				<td class="masp_hienthi_sp"><input type="checkbox" name="id[]" class="item" class="checkbox" value="<?=$bien['idhotro']?>"/></td>
                <td class="masp_hienthi_sp"><?php  echo $bien['idhotro'] ?></td>
				<td class="sl_hienthi_sp"><?php echo $bien['hoten'] ?></td>
                <td class="stt_hienthi_sp"><div class="noidungchude"><?php echo $bien['chude'] ?></div></td>
                <td class="img_hienthi_sp" style='text-align:left;'><div class="noidungchitiet"> <?php echo $bien['noidung'] ?> </div></td>
				<td class="sl_hienthi_sp"><?php echo $bien['email'] ?></td>
			</tr>
<?php 
    }
	
    else echo "<tr><td colspan='6'>Không có tin nào</td></tr>";
	
?>
</tbody>
</table>
</div>
</form>
<script language="JavaScript">
    function checkdel(idhotro)
    {
        var	idhotro=idhotro;
        if(confirm("Bạn có chắc chắn muốn xóa tin này?")==true)
            window.open(link,"_self",1);
    }
</script>