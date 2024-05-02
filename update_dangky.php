
<?php 
include 'include/connect.php';
include 'admin/function/function.php';

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
	
	//Lay gio cua he thong
		$dmyhis= date("Y").date("m").date("d").date("H").date("i").date("s");
		//Lay ngay cua he thong
		$ngay=date("Y").":".date("m").":".date("d").":".date("H").":".date("i").":".date("s");
	
		$insert="INSERT INTO nguoidung VALUES('','$tennguoidung', '$tendangnhap', '$matkhau','$ngaysinh','$gioitinh', '$email','$dienthoai', '$diachi','$ngay', '1','1')";
		$query=mysqli_query($link,$insert);
		if($query) {
			echo "<script>
			alert('Đăng ký thành công, thông tin của bạn đã được ghi nhận !');
			window.open('index.php','_self', 1);
		  </script>";

		}
			else {
				echo "<script>
                alert('Đăng ký không thành công. Vui lòng kiểm tra lại dữ liệu');
                window.history.go(-1);
              </script>";
			}
}
?>