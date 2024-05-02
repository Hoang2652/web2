
<?php 
 include('../include/connect.php');
 include('function/function.php');

if(isset($_POST['submit']))
{
	$tennguoidung=$_POST['tennguoidung'];
	$tendangnhap=$_POST['tendangnhap'];
	$matkhau=MD5($_POST['matkhau']);
	$email=$_POST['email'];
	$ngaysinh=$_POST['ngaysinh'];
	$gioitinh=$_POST['gioitinh'];
	$dienthoai=$_POST['dienthoai'];
	$diachi=$_POST['diachi'];
	$phanquyen=$_POST['phanquyen'];

	//Lay ngay cua he thong
	$dmyhis= date("Y").date("m").date("d").date("H").date("i").date("s");
	$ngay=date("Y").":".date("m").":".date("d").":".date("H").":".date("i").":".date("s");
	
	$insert="INSERT INTO nguoidung VALUES('','$tennguoidung', '$tendangnhap', '$matkhau','$ngaysinh','$gioitinh', '$email','$dienthoai', '$diachi','$ngay', '$phanquyen', '1')";
	if(mysqli_query($link,$insert)) {
	redirect("admin.php?admin=hienthind", "Bạn đã thêm người dùng thành công.", 2 );
	} else { 	redirect("admin.php?admin=hienthind", "Bạn đã thêm người dùng 7 bại.", 2 );
	}
}
?>