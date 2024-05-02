<?php 
session_start(); 
unset($_SESSION['phanquyen']);
unset($_SESSION['tendangnhap']);
unset($_SESSION['idnguoidung']);

echo "
	<script language='javascript'>
	alert('Đăng xuất thành công');
	window.open('../index.php','_self', 1);
	</script>
	";
?>