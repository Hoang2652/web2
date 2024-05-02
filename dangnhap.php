<?php
echo "<script>document.getElementById('content').innerHTML=''</script>";
echo "<script>document.getElementById('left-content').innerHTML=''</script>";
echo "<script>document.getElementById('abc').innerHTML=''</script>";
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div id="dangnhap-in">
	<div class="login">
		<div class="login__content">
			<div class="login__img">
				<img src="img/img-login.png" alt="">
			</div>
			<div class="login__form">
				<form action="checkdangnhap.php" class="form__login" id="login-in" method="post" name="frm" onsubmit="return checkdangnhap()">
					<h1 class="login__title">Đăng nhập</h1>
					<div class="login__box">
						<i class='bx bx-user login__icon'></i>
						<input class="login__input" type="text" name="tendangnhap" maxlength="20" placeholder="Tên đăng nhập" onclick="document.getElementById('warning-CustomerID').innerHTML=''">
					</div>
					<div class="warning" id="warning-username"></div>
					<div class="login__box">
						<i class='bx bx-lock login__icon'></i>
						<input class="login__input" type="password" name="matkhau" size="20" placeholder="Mật Khẩu" onclick="document.getElementById('warning-Password').innerHTML=''">
					</div>
					<div class="warning" id="warning-password"></div>
					<p class="login__save"><input type="checkbox" name="saveinfo" id="checkluudangnhap">  Lưu đăng nhập</p>
					<a><button name="login" class="btn btn-primary">Đăng nhập</button></a>
					<div class="login__dash"></div>
					<p id="dangkycss">Bạn chưa có tài khoản? => <a href="index.php?content=dangky">Đăng ký</a></p>
                </div>
				</form>
			</div>
		</div>
	</div>
	
	<?php
	if(isset($_COOKIE['tendangnhap']) && isset($_COOKIE['matkhau']))
	{
	echo "<script language='javascript'>document.getElementById('tendangnhap').value='" .$_COOKIE['tendangnhap']. "';</script>";
	echo "<script language='javascript'>document.getElementById('matkhau').value='" .$_COOKIE['matkhau']. "';</script>";
	}
	?>
</div><!-- End .dangnhap-in-->

<script language="javascript">
 	function checkdangnhap(){
		var error=0;
	    if(frm.tendangnhap.value=="")
		{
			document.getElementById('warning-username').innerHTML="Bạn chưa nhập tên tài khoản";
			error++;	
		}

		if(frm.matkhau.value=="")
	 	{
			document.getElementById('warning-password').innerHTML="Bạn chưa nhập mật khẩu";
			error++;
		}

		if(error>0) {
			alert('Đăng nhập thất bại');
			return false;
		} else {
			return true;
		}
	}
	</script>

