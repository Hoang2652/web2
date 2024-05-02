<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
   if($_SESSION['phanquyen']!=0)
   {
    echo "
    <script language='javascript'>
    alert('Bạn không được ủy quyền để vào đây');
    window.open('admin.php','_self', 1);
    </script>";
    exit();
		exit();
   }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Danh Mục</title>
<link rel="stylesheet" href="css/hienthi_sp.css" />
</head>

<?php
	include ('../include/connect.php');
    $select = "select * from nguoidung order by idnguoidung DESC";
    $query = mysqli_query($link,$select);
    $dem = mysqli_num_rows($query);
?>
<div class="quanlysp">
	<h3>QUẢN LÝ NGƯỜI DÙNG</h3>
    <div class="live-search form-row">
		<div class="col-md-2 mb-3">
			<label><i class="fas fa-search"></i> Tìm kiếm người dùng</label>
            <input type="text" class="form-control" name="timkiem" placeholder="Nhập id, username..." onkeyup="timkiemtructiep(this.value,'nguoidung')">
        </div>
        <div class="col-md-2 mb-3">
            <button type="button" name="button" value="thêm người dùng" style="margin-top: 32px; border: none"><a href='?admin=themnd'  class="btn btn-primary">Thêm người dùng</a></button>
        </div>
	<p style="float:right; margin-top: 40px;">Có tổng cộng: <font color=red><b><?php echo $dem ?></b></font> người dùng</p>
</div>
<div class='content-table scb'>
<table>
    <thead>
    <tr class='tieude_hienthi_sp'>
        <th>ID</th>
        <th>Tên ND</th>
        <th>Username</th>
        <th>Email</th>
        <th>Điện thoại</th>
        <th style="width:75px;">Quyền</th>
        <th>Trạng thái tài khoản</th>
        <th style="width:80px;">Sửa / Khóa / Xóa</th>
    </tr>
</thead>
<tbody id="row-sanpham" class="row-nguoidung">
    <?php					
	$sql = mysqli_query($link,"SELECT * FROM nguoidung WHERE phanquyen='1' OR phanquyen='2'"); 			
    if($dem > 0)
        while ($bien = mysqli_fetch_array($sql))
        {
?>
            <tr class='noidung_hienthi_sp'>
                <td class="masp_hienthi_sp"><?php  echo $bien['idnguoidung'] ?></td>
                <td class="stt_hienthi_sp"><?php echo $bien['tennguoidung'] ?></td>
                <td class="img_hienthi_sp"> <?php echo $bien['tendangnhap'] ?>  </td>
				<td class="sl_hienthi_sp"><?php echo $bien['email'] ?></td>
				<td class="sl_hienthi_sp"><?php echo $bien['dienthoai'] ?></td>
				<td class="sl_hienthi_sp">
                <?php 
					if($bien['phanquyen']==2)
						echo "Nhân viên";
					else 
						echo "Người dùng";
				?>
                </td>
                <td class="active_hienthi_sp"><?php
                		if($bien['trangthai']==1)
                        echo "<div id='trangthai'><font color='blue'>Mở</font></div>";
                        else 
                        echo "<div id='trangthai'><font color='red'>Khóa</font></div>";
                    ?></td>
                <td class="active_hienthi_sp">
                    <a href='?admin=suand&idnguoidung=<?php echo $bien['idnguoidung'] ?>'><i class='fas fa-tools' style='transform: scale(1.5); color: #007bff;'></i></a>
					<?php echo "<div onclick='checklock(".$bien['idnguoidung'].",".$bien['trangthai'].")' ><i class='fas fa-lock' style='transform: scale(1.5); color: #79d100;'></i></div>" ?>
                    <div onclick="checkdelnguoidung(<?php echo $bien['idnguoidung']?>)"><i class="fas fa-trash-alt" style="transform: scale(1.5); color: red;" ></i></div>
                </td>
            </tr>
<?php 
    }
	
    else echo "<tr><td colspan='8'>Không có khách hàng</td></tr>";
	
?>
</tbody>
</table>
</div>
<script language="JavaScript">
    function checklock(idnguoidung,tt)
    {
        var	idnguoidung=idnguoidung;
        var link="khoa_nguoidung.php?idnguoidung="+idnguoidung;
        if(tt==1)
        {
            if(confirm("Bạn có chắc chắn muốn khóa người dùng này?") == true)
                window.open(link,"_self",1);
        }
        else if(confirm("Bạn có chắc chắn muốn mở khóa người dùng này?") == true){
            window.open(link,"_self",1);
        }
    }
</script>