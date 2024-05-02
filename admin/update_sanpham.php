<?php
include('../include/connect.php');
include('function/function.php');

if(isset($_GET['submit_xoadanhgia'])){
	$iddanhgia = $_GET['submit_xoadanhgia'];
	$query_delete = mysqli_query($link,"DELETE FROM danhgia WHERE iddanhgia=$iddanhgia");
	if($query_delete){
		echo "<script>
		alert('Xóa đánh giá thành công');
		window.history.go(-1);
		</script>";
	} else {
		echo "<script>
		alert('Xóa đánh giá thất bại');
		window.history.go(-1);
		</script>";
	}
} else {
$isValidated = true;
$tensanpham=$_POST['tensanpham'];
$gia=$_POST['gia'];
$chitiet=$_POST['chitiet'];
$upload_image="../img/uploads/";
$file_tmp= isset($_FILES['hinhanh']['tmp_name']) ?$_FILES['hinhanh']['tmp_name'] :"";
$file_name=isset($_FILES['hinhanh']['name']) ?$_FILES['hinhanh']['name'] :"";
$file_type=isset($_FILES['hinhanh']['type']) ?$_FILES['hinhanh']['type'] :"";
$file_size=isset($_FILES['hinhanh']['size']) ?$_FILES['hinhanh']['size'] :"";
$file_error=isset($_FILES['hinhanh']['error']) ?$_FILES['hinhanh']['error'] :"";
//Lay gio cua he thong
$dmyhis= date("Y").date("m").date("d").date("H").date("i").date("s");
//Lay ngay cua he thong
$ngay=date("Y").":".date("m").":".date("d").":".date("H").":".date("i").":".date("s");

$file__name__=$dmyhis.$file_name;

$soluong=$_POST['soluong'];
$daban=$_POST['daban'];
$iddanhmuc=$_POST['iddanhmuc'];
$idsanpham=$_GET['idsanpham'];
$mota=$_POST['mota'];
$baohanh=$_POST['baohanh'];
$xuatxu=$_POST['xuatxu'];
$loaisanpham=$_POST['loaisanpham'];

if($_POST['giamgia'] <= 0 || $_POST['giamgia'] == "")
	$giamgia="giamgia=NULL";
else
	$giamgia="giamgia=".$_POST['giamgia'];

if($_POST['quatang'] <= 0 || $_POST['quatang'] == "")
	$quatang="quatang=NULL";
else
	$quatang="quatang=".$_POST['quatang'];

$soluongkhuyenmai=$_POST['soluongkhuyenmai'];

$resultdatasoluong = mysqli_fetch_array(mysqli_query($link,"select * from sanpham where idsanpham=$idsanpham"));
$soluongcu = $resultdatasoluong['soluong'];
$soluongtonkho = 0;
$idsanphamtonkho = 0;
if(isset($_POST['idsanphamtonkho'])){
	$idsanphamtonkho = $_POST['idsanphamtonkho'];
	$islinkedsql = "select * from sanphamtonkho where idsanpham=$idsanphamtonkho";
	$queryresult = mysqli_query($link,$islinkedsql);
	$result = mysqli_fetch_array($queryresult);
	if(mysqli_num_rows($queryresult) == 0){
		echo "<script>
		alert('Cập nhật sản phẩm thất bại! Dữ liệu sản phẩm này bị lỗi.');
		</script>";
		$isValidated = false;
	}
	$soluongtonkho = $result['soluongtonkho'];
	if($soluong > $result['soluongtonkho']){
		echo "<script>
		alert('Cập nhật sản phẩm thất bại! Số lượng cần bán \'".$soluong."\' của sản phẩm \'".$tensanpham."\' vượt qua số lượng có trong kho \'".$result['soluongtonkho']."\'.');
		</script>";
		$isValidated = false;
	}
}

if($soluong < $soluongkhuyenmai){
	echo "<script>
	alert('Cập nhật sản phẩm thất bại! Số lượng khuyến mãi ('".$soluongkhuyenmai.") của sản phẩm \'".$tensanpham."\' vượt qua số lượng đăng bán \'".$soluong."\'.');
	</script>";
	$isValidated = false;
}

if($isValidated){

	if (!empty($_POST['decudautrang'])){
		$sqlrecommendcheck = mysqli_query($link,"select * from sanphamdecu where idsanpham='$idsanpham' AND idsanphamdecu='1'");
		if(mysqli_num_rows($sqlrecommendcheck) > 0){
			$update=mysqli_query($link,"UPDATE sanphamdecu SET idsanpham='$idsanpham' WHERE idsanphamdecu='1'");
		} else {
			$update=mysqli_query($link,"INSERT INTO sanphamdecu VALUES(1,'Sản phẩm đầu trang','$idsanpham')");
		}
	} else {
		$update=mysqli_query($link,"UPDATE sanphamdecu SET idsanpham='0' WHERE idsanpham='$idsanpham' AND idsanphamdecu='1'");
	}
	if (!empty($_POST['decugiuatrang'])){
		$sqlrecommendcheck = mysqli_query($link,"select * from sanphamdecu where idsanpham='$idsanpham' AND idsanphamdecu='2'");
		if(mysqli_num_rows($sqlrecommendcheck) > 0){
			$update=mysqli_query($link,"UPDATE sanphamdecu SET idsanpham='$idsanpham' WHERE idsanphamdecu='2'");
		} else {
			$update=mysqli_query($link,"INSERT INTO sanphamdecu VALUES(2,'Sản phẩm giữa trang','$idsanpham')");
		}
	} else {
		$update=mysqli_query($link,"UPDATE sanphamdecu SET idsanpham='0' WHERE idsanpham='$idsanpham' AND idsanphamdecu='2'");
	}
	
	if (!empty($_POST['decusanpham'])){
		$sqlrecommendcheck = mysqli_query($link,"select * from sanphamdecu where idsanpham='$idsanpham' AND idsanphamdecu='3'");
		if(mysqli_num_rows($sqlrecommendcheck) > 0){
			$update=mysqli_query($link,"UPDATE sanphamdecu SET idsanpham='$idsanpham' WHERE idsanphamdecu='3'");
		} else {
			$update=mysqli_query($link,"INSERT INTO sanphamdecu VALUES(3,'Sản phẩm đề cử','$idsanpham')");
		}
	} else {
		$update=mysqli_query($link,"DELETE FROM sanphamdecu WHERE idsanpham='$idsanpham' AND idsanphamdecu='3'");
	}

	if($_FILES['hinhanh']['name'] != "") {
	move_uploaded_file($file_tmp,$upload_image.$file__name__);
		
		$sql_update=("UPDATE sanpham SET 
										tensanpham='$tensanpham',
										soluong='$soluong',
										loaisanpham='$loaisanpham',
										mota='$mota',
										xuatxu='$xuatxu',
										baohanh='$baohanh',
										daban='$daban',
										hinhanh='$file__name__',
										chitiet='$chitiet',
										gia='$gia',
										iddanhmuc='$iddanhmuc',
										$giamgia,
										$quatang,
										soluongkhuyenmai='$soluongkhuyenmai',
										ngaycapnhat='$ngay'
						WHERE idsanpham='$idsanpham'");
	} else {
			$sql_update=("UPDATE sanpham SET 
										tensanpham='$tensanpham',
										soluong='$soluong',
										loaisanpham='$loaisanpham',
										mota='$mota',
										xuatxu='$xuatxu',
										baohanh='$baohanh',
										daban='$daban',
										chitiet='$chitiet',
										gia='$gia',
										iddanhmuc='$iddanhmuc',
										$giamgia,
										$quatang,
										soluongkhuyenmai='$soluongkhuyenmai',
										ngaycapnhat='$ngay'
						WHERE idsanpham='$idsanpham'");
	}
	// var_dump($sql_update);
	$update=mysqli_query($link,$sql_update);
	if(isset($_POST['idsanphamtonkho'])){
		$updatesanphamtonkho="UPDATE `sanphamtonkho` SET `soluongtonkho` = ".($soluongtonkho + $soluongcu - $soluong)." WHERE `sanphamtonkho`.`idsanpham` = $idsanphamtonkho";
		$query=mysqli_query($link,$updatesanphamtonkho);
	}
	if($update) {
		echo "";
		
		redirect("admin.php?admin=hienthisp", "Bạn đã sửa thành công sản phẩm.", 2);
	} else {
		redirect ("admin.php?admin=suasp&idsanpham=$idsanpham'", "Sửa thất bại", 2);
	}
	}
}
?>
