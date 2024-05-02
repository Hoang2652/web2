<?php 

if(!isset($_SESSION['idnguoidung'])){
    echo "<script language='javascript'>
    alert('Bạn phải đăng nhập mới đánh giá được');
	history.back(-1);
    </script>";
} else if (isset($_POST['submit-danhgia'])){
	$idnguoidung=$_SESSION['idnguoidung'];
	$idsanpham=$_POST['idsanpham'];
	$sodiem=$_POST['sodiem'];
	$binhluan=$_POST['binhluan'];
	
	//Lay gio cua he thong
		$dmyhis= date("Y").date("m").date("d").date("H").date("i").date("s");
		//Lay ngay cua he thong
		$ngay=date("Y").":".date("m").":".date("d").":".date("H").":".date("i").":".date("s");
	if(mysqli_num_rows(mysqli_query($link,"select * from danhgia where idnguoidung = ".$_SESSION['idnguoidung']." AND idsanpham = ".$idsanpham)) == 0){
	$insert="INSERT INTO danhgia VALUES('','$idsanpham', '$idnguoidung', '$sodiem','$binhluan','$ngay')";
		$query=mysqli_query($link,$insert);
		if($query) {
			echo "<script>
			alert('Đăng đánh giá thành công.');
			window.history.back(-1);
			</script>";
		}
		else {
			echo "<script>
			alert('Cập nhật đánh giá thất bại.');
			window.history.back(-1);
			</script>";
			}
	} else {
		$update="UPDATE danhgia SET sodiem = '$sodiem',
									binhluan = '$binhluan',
									ngaybinhluan = '$ngay'
								WHERE idnguoidung = ".$_SESSION['idnguoidung']." AND idsanpham = ".$idsanpham;
		$query=mysqli_query($link,$update);
		if($query) {
			echo "<script>
			alert('Cập nhật đánh giá thành công.');
			window.history.back(-1);
			</script>";
		} else { 
			echo "<script>
			alert('Cập nhật đánh giá thất bại, vui lòng thử lại lần sau.');
			window.history.back(-1);
			</script>";
			}
	}
}
?>