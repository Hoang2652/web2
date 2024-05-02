 <?php
include '../include/connect.php';
include 'function/function.php';
$check = mysqli_query($link,"select trangthai from nguoidung where idnguoidung='{$_GET['idnguoidung']}'");
$bien = mysqli_fetch_array($check);

if($bien['trangthai'] == 1)
{
	$lock = "update nguoidung set trangthai='0' where idnguoidung='{$_GET['idnguoidung']}'";
	$del = mysqli_query($link,$lock);
	if ($del)
		redirect ("admin.php?admin=hienthind", "Khóa người dùng thành công. ", 2);
	else
		echo "Khóa người dùng thất bại";
} else if($bien['trangthai'] == 0) 
{
	$lock = "update nguoidung set trangthai='1' where idnguoidung='{$_GET['idnguoidung']}'";
	$del = mysqli_query($link,$lock);
	if ($del)
		redirect ("admin.php?admin=hienthind", "Mở khóa người dùng thành công. ", 2);
	else
		echo "Mở khóa người dùng thất bại";
}





?>