<link rel="stylesheet" href="css/them_sanpham.css">

<form action="add_nguoidung.php" method="post" name="frm" onsubmit="return checkthemnguoidung()" style="width: fit-content; margin: auto;">
	<div class="dangky">
		<div class="tabs">
			<div style="text-align: center; font-weight: bold;">THÊM NGƯỜI DÙNG</div>
		</div>
		
		<div class="form-row">			
			<div class="col-md-6"> 
				<label for="tendangnhap">Tên đăng nhập  </label>
				<input class="form-control" type="text" name="tendangnhap" size="40" onclick="document.getElementById('canhbaotendangnhap').innerHTML=''">
				<div class='canhbao' id='canhbaotendangnhap'></div>
			</div>
			<div class="col-md-6">
				<label for="tennguoidung">Tên người dùng</label>
				<input class="form-control" type="text" name="tennguoidung" size="40" onclick="document.getElementById('canhbaotennguoidung').innerHTML=''">
				<div class='canhbao' id='canhbaotennguoidung'></div>
			</div>
		</div>
	
		<div class="form-row">
			<div class="col-md-6">
				<label for="matkhau">Mật khẩu</label>
				<input type="password" class="form-control" name="matkhau" size="40" onclick="document.getElementById('canhbaomatkhau').innerHTML=''">
				<div class='canhbao' id='canhbaomatkhau'></div>
			</div>
			
			<div class="col-md-6">
				<label for="matkhau1">Nhập lại mật khẩu </label>
				<input type="password" class="form-control" name="matkhau1" size="40" onclick="document.getElementById('canhbaonhaplaimatkhau').innerHTML=''">
				<div class='canhbao' id='canhbaonhaplaimatkhau'></div>
			</div>
			
		</div>
		<div class="form-row">
			<div class="col-md-6">
				<label for="ngaysinh">Ngày sinh </label>
				<input class="form-control" type="date" name="ngaysinh">
				<div class='canhbao' id='canhbaongaysinh'></div>
			</div>
			<div class="col-md-6">
				<label for="diachi">Địa chỉ  </label>
				<input class="form-control" type="text" name="diachi">
				<div class='canhbao' id='canhbaodiachi'></div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-md-6">
			<label for="email">Email </label>
				<input class="form-control" type="text" name="email" size="40" onclick="document.getElementById('canhbaoemail').innerHTML=''">
				<div class='canhbao' id='canhbaoemail'></div>
			</div>
			<div class="col-md-6">
				<label for="dienthoai">Điện thoại </label>
				<input class="form-control" type="text" name="dienthoai" size="40" onclick="document.getElementById('canhbaodienthoai').innerHTML=''">
				<div class='canhbao' id='canhbaodienthoai'></div>
			</div>
		</div>
		<div class="form-row">
			<div class="col-md-6">
				<label for="gioitinh" style="display: grid">Giới tính </label>
				<select class="custom-select mr-sm-2" style="width: 190px;" name="gioitinh">
					<option value="">-Chọn giới tính-</option>
					<option value="nam">Nam</option>
					<option value="nu">Nữ</option>
				</select>
				<div class='canhbao' id='canhbaogioitinh'></div>
			</div>
			<div class="col-md-6">
				<label for="phanquyen" style="display: grid">Phân quyền  </label>
                <select class="custom-select mr-sm-2" style="width: 190px;" name="phanquyen">
						<option value="">-Chọn phân quyền-</option>
					    <option value="2">Quản lý</option>
				    	<option value="1">Người dùng</option>
                </select>
				<div class='canhbao' id='canhbaophanquyen'></div>
            </div>
		</div>
		<div style="margin: auto; width: fit-content; margin-top: 2rem;">
			<button class="btn btn-primary" type="submit" name="submit">Thêm người dùng</button>
		</div>
	</div>
</form>

<script language="javascript">
 	function checkthemnguoidung()
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
			document.getElementById('canhbaomatkhau').innerHTML="Bạn chưa nhập mật khẩu";	
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
			document.getElementById('canhbaonhaplaimatkhau').innerHTML="Bạn chưa nhập lại mật khẩu";	
			error++;
		}
		mk=frm.matkhau.value;
		mk1=frm.matkhau1.value;
		if(mk!=mk1)
		{
			document.getElementById('canhbaonhaplaimatkhau').innerHTML="mật khẩu nhập lại chưa đúng";	
			error++;
		}

		if(error>0) {
			alert('Thêm người dùng không thành công');
			return false;
		}

	}
 </script>