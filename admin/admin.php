<?php 
	error_reporting(E_ALL ^ E_NOTICE); 
   function mysqli_result($res, $row, $field=0) {
		$res->data_seek($row);
	  $datarow = $res->fetch_array();
	  return $datarow[$field];
   }

   include 'function/function.php';
   
   session_start();
   if(!isset($_SESSION['tendangnhap']) || $_SESSION['phanquyen']==1)
   {
		header('location:login.php');
		exit();
   }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="js/javafunction.js"></script>
<script type="text/javascript" src="js/code.js"></script>
<title> Bán đồng hồ </title>
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script src="https://kit.fontawesome.com/2c8a18bbf3.js" crossorigin="anonymous"></script>
</head>
<?php 
   include("../include/connect.php");
?>
<body>
<div id="wapper">
	<div id="content">
		<div id="top-content">
			<div class="lg-header">
				<h1><a href="admin.php"><img src="img/logo-header.png" alt="logo" class="lg-header-img"></a></h1>
			</div>	
			<p>Chào bạn <a href="../index.php?content=ttcn"><font color="white"><b><i class="fas fa-user"></i> <u><?= $_SESSION['tendangnhap']?></u></b></font></a><a href="logout.php" class="bt-logout">  Đăng xuất</a></p>
		</div>
		<div id="main-content">
			<div id="left-content">
				<div class="danhmucsp">
					<div class="center" id="change-Class">
						<ul>
							<li><a href="admin.php" class="changec ">Trang chủ</a></li>
							<?php
							if ($_SESSION['phanquyen']==0)
							echo "
							<li><a href='?admin=hienthidm' > Quản lý danh mục</a></li>
							<li><a href='?admin=hienthind' > Quản lý người dùng</a></li>";
							?>
							<li><a href="?admin=hienthisp" class="changec"> Quản lý sản phẩm</a></li>
							<li><a href="?admin=hienthiqlkh" class="changec"> Quản lý kho hàng</a></li>
							<li><a href="?admin=hienthihd" class="changec"> Quản lý hóa đơn</a></li>
							<li><a href="?admin=hienthitt" class="changec"> Quản lý tin tức</a></li>
							<li><a href="?admin=hienthiht" class="changec"> Hỗ trợ khách hàng</a></li>
							<li><a href="?admin=hienthithongkedanhthu" class="changec"> Thống kê doanh thu</a></li>
						</ul>
					</div><!-- End .center -->
				</div>	<!-- End .menu-left -->
			</div><!-- End .left-content -->
			<!---------------- Hiển trị content-admin------------------->
			
			
			<div id="center-content">
                <?php
                    include("content_admin.php");
                ?>
			</div>
		</div><!-- End .main-content -->
	</div><!-- End .content -->
	
</div><!-- End .wapper -->
</body>
</html>
