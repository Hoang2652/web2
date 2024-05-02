  <?php
 include('../include/connect.php');
 include('function/function.php');


		$tennguoidung=$_POST['tennguoidung'];
		$tendangnhap=$_POST['tendangnhap'];
		$matkhau=MD5($_POST['matkhau']);
		$email=$_POST['email'];
	    $dienthoai=$_POST['dienthoai'];
		$phanquyen=$_POST['phanquyen'];
		$id = $_GET['idnguoidung'];
    	$sql_update=("
		UPDATE nguoidung SET
							tennguoidung='$tennguoidung',
							tendangnhap='$tendangnhap',
							matkhau='$matkhau',
							email='$email',
							dienthoai='$dienthoai',
							phanquyen='$phanquyen'
							where idnguoidung=$id
	");
	$update=mysqli_query($link,$sql_update);
	if($update)
	{
		redirect("admin.php?admin=hienthind", "Bạn đã sửa thành công người dùng.", 2 );
	}
	else {
	redirect ("admin.php?admin=suand&idnguoidung=$id", "Sửa thất bại", 2);
	}
	
?>