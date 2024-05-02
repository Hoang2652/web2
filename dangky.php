<?php

echo "<script>document.getElementById('content').innerHTML=''</script>";
echo "<script>document.getElementById('left-content').innerHTML=''</script>";
echo "<script>$(document).ready( function(){document.getElementById('doitac').innerHTML=' '})</script>";

?>

<div class="register">
	<div class="register__content">
		<div class="register__img">
			<img src="img/img-login.png" alt="">
		</div>
		<div class="register__form">
			<form action="update_dangky.php" class="form__register" method="post" name="frm" onsubmit="return checkdangky()">
				<h1 class="login__title">Đăng ký</h1>
				<div class="register__box">
					<input class="login__input" placeholder="Họ và tên" type="text" name="tennguoidung" onclick="document.getElementById('canhbaotennguoidung').innerHTML=''">
				</div>
				<div class='canhbao' id='canhbaotennguoidung'></div>
				<div class="register__box">
					<input class="login__input" placeholder="Tên đăng nhập" type="text" name="tendangnhap" onclick="document.getElementById('canhbaotendangnhap').innerHTML=''">
				</div>
				<div class='canhbao' id='canhbaotendangnhap'></div>
				<div class="register__box">
					<input class="login__input" placeholder="Mật khẩu" type="password" name="matkhau" onclick="document.getElementById('canhbaomatkhau').innerHTML=''">
				</div>
				<div class='canhbao' id='canhbaomatkhau'></div>
				<div class="register__box">
					<input class="login__input" placeholder="Nhập lại mật khẩu" type="password" name="matkhau1" onclick="document.getElementById('canhbaonhaplaimatkhau').innerHTML=''">
				</div>
				<div class='canhbao' id='canhbaonhaplaimatkhau'></div>
				<div class="register__box">
					<input class="login__input" placeholder="Điện thoại" type="text" name="dienthoai" onclick="document.getElementById('canhbaodienthoai').innerHTML=''">
				</div>
				<div class='canhbao' id='canhbaodienthoai'></div>
				<div class="register__box">
					<input class="login__input" placeholder="Email" type="text" name="email" onclick="document.getElementById('canhbaoemail').innerHTML=''">
				</div>
				<div class='canhbao' id='canhbaoemail'></div>
				<div class="register__box">
					<input class="login__input" placeholder="Địa chỉ" type="text" name="diachi">
				</div>
				<div class="register__row">
					<div class="col-md-7">
						<label for="exampleInputEmail1" class="register__label">Ngày sinh</label>
						<input class="form-control" type="date" name="ngaysinh" style="border-radius: 0.5rem">
					</div>
					<div class="col-md-5">
						<label for="exampleInputEmail1" class="register__label">Giới tính</label>
						<select class="custom-select mr-sm-2" style="width: 140px; border-radius: 0.5rem" name="gioitinh">
							<option value="">-Giới tính-</option>
							<option value="nam">Nam</option>
							<option value="nu">Nữ</option>
						</select>
					</div>	
				</div>
				<div style="margin: auto; width: fit-content; margin-top: 20px;">
					<button class="btn btn-primary" type="submit" name="submit">Đăng ký</button>
					<button class="btn btn-danger" type="reset" style="margin-left: 60px;">Hủy</button>
				</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script language="javascript">
 	function checkdangky()
	{
		var error=0;
	    if(frm.tennguoidung.value=="")
		{
			document.getElementById('canhbaotennguoidung').innerHTML="Bạn chưa nhập tên. Vui lòng kiểm tra lại";
			error++;	
		}

		if(frm.tendangnhap.value=="")
	 	{
			document.getElementById('canhbaotendangnhap').innerHTML="Bạn chưa nhập tên đăng nhập . Vui lòng kiểm tra lại";
			error++;
		}

		if(frm.tendangnhap.value.length<6)
	 	{
			document.getElementById('canhbaotendangnhap').innerHTML="Tên đăng nhập tối thiểu 6 ký tự";
			error++;
		}

		if(frm.matkhau.value=="")
		{
			document.getElementById('canhbaomatkhau').innerHTML="Bạn chưa nhập password";	
			error++;
		}
		if(frm.matkhau.value.length<6 || frm.matkhau.value.length>24)
		{
			document.getElementById('canhbaomatkhau').innerHTML="Mật khẩu phải có số kí tự trong khoảng 6-24";	
			error++;
		}
		
	   dt=/^[0-9]+$/;
	   dienthoai=frm.dienthoai.value;
	   dd=frm.dienthoai.value;
		if(10>dd.length || dd.length>11)
		{
			document.getElementById('canhbaodienthoai').innerHTML="Số điện thoại không đủ độ dài. Vui lòng nhập lại";
			error++;
		}
	   if(frm.dienthoai.value=="")
		{
			document.getElementById('canhbaodienthoai').innerHTML="Bạn chưa nhập số điện thoại";	
			error++;
		}
	   if(!dt.test(dienthoai))
	   {
			document.getElementById('canhbaodienthoai').innerHTML="Số điện thoại không hợp lệ. Vui lòng kiểm tra lại.";
		    error++;
	   }
		if(frm.email.value=="")
		{
			document.getElementById('canhbaoemail').innerHTML="Bạn chưa nhập email";	
			error++;
		}
		mail=frm.email.value;
		m=/^([A-z0-9])+[@][a-z]+[.][a-z]+[.]*([a-z]+)*$/;
		if(!m.test(mail))
		{
			document.getElementById('canhbaoemail').innerHTML="Email sai cú pháp";	
			error++;
		}
		
		if(frm.matkhau1.value=="")
		{
			document.getElementById('canhbaonhaplaimatkhau').innerHTML="Bạn chưa nhập lại password";	
			error++;
		}
		mk=frm.matkhau.value;
		mk1=frm.matkhau1.value;
		if(mk!=mk1)
		{
			document.getElementById('canhbaonhaplaimatkhau').innerHTML="Password nhập lại chưa đúng";	
			error++;
		}

		if(error>0) {
			alert('Đăng ký không thành công');
			return false;
		}

	}
 </script>