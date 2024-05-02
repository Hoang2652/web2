<link rel="stylesheet" href="css/them_sanpham.css">
<?php
		$idnguoidung=$_GET['idnguoidung'];
        $sql="select * from nguoidung where idnguoidung='".$_GET['idnguoidung']."'";
         $rows=mysqli_query($link,$sql);
         $row=mysqli_fetch_array($rows);
?>
<form action="update_nguoidung.php?idnguoidung=<?php echo $idnguoidung;?>" method="post" name="frm" onsubmit="return kiemtra()" enctype="multipart/form-data" style="width: fit-content; margin: auto;">
	<div class="dangky">
		<div class="tabs">
			<div style="text-align: center; font-weight: bold;">SỬA NGƯỜI DÙNG</div>
		</div>
		
		<div class="form-group row">	
			<label class="col-sm-2 col-form-label">Tên đăng nhập  </label>
			<div class="col-sm-9"> 
				<input class="form-control" type="text" name="tendangnhap" size="40" value="<?php echo $row['tendangnhap'] ?>"/>
			</div>
			
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Tên người dùng</label>
			<div class="col-sm-9">
				<input class="form-control" type="text" name="tennguoidung" size="40" value="<?php echo $row['tennguoidung'] ?>" />
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Mật khẩu</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" name="matkhau" size="40" value="<?php echo $row['matkhau'] ?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Email </label>
			<div class="col-sm-9">
				<input class="form-control" type="text" name="email" size="40" value="<?php echo $row['email'] ?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Điện thoại </label>
			<div class="col-sm-9">
				<input class="form-control" type="text" name="dienthoai" size="40" value="<?php echo $row['dienthoai'] ?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Phân quyền  </label>
			<div class="col-sm-9">
            <select class="custom-select mr-sm-2" style="width: 190px;" name="phanquyen">
					<option value="">-Chọn phân quyền-</option>
				    <option value="2" <?php if($row['phanquyen']==2) echo 'selected="selected"';?>>Quản lý</option>
			    	<option value="1" <?php if($row['phanquyen']==1) echo 'selected="selected"';?>>Người dùng</option>
            </select>
            </div>
		</div>
		<div style="margin: auto; width: fit-content; margin-top: 2rem;">
			<button class="btn btn-primary" type="submit" name="submit">Cập nhật</button>
			<button type="reset" class="btn btn-danger" style="margin-left: 4rem;" name="btnhuy">Bỏ thay đổi</button>
		</div>
	</div>
</form>

<script language="javascript">
 	function  kiemtra()
	{
	    if(frm.tennguoidung.value=="")
		{
			alert("Bạn chưa nhập tên. Vui lòng kiểm tra lại");
			frm.tennguoidung.focus();
			return false;	
		}
		if(frm.tennguoidung.value.length<6)
		{
			alert("Tên quá ngắn. Vui lòng điền đầy đủ tên");
			frm.tennguoidung.focus();
			return false;	
		}
		if(frm.tendangnhap.value=="")
	 	{
			alert("Bạn chưa nhập tên đăng nhập . Vui lòng kiểm tra lại");
			frm.user.focus();
			return false;	
		}
		if(frm.tendangnhap.value.length<5)
	 	{
			alert("Tên đăng nhập phải lớn hơn 5 ký tự");
			frm.user.focus();
			return false;	
		}
		if(frm.matkhau.value=="")
		{
			alert("Bạn chưa nhập password");	
			frm.pass.focus();
			return false;
		}
		if(frm.matkhau.value.length<6)
		{
			alert("Mật khẩu phải lớn hơn 6 ký tự");	
			frm.pass.focus();
			return false;
		}
	   dt=/^[0-9]+$/;
	   dienthoai=frm.dienthoai.value;
	   if(!dt.test(dienthoai))
	   {
		    alert("Bạn chưa nhập điện thoại. Vui lòng kiểm tra lại.");
		    frm.dienthoai.focus();
		    return false;
	   }
	   	dd=frm.dienthoai.value;
		if(10>dd.length || dd.length>11)
		{
			alert("Số điện thoại không đủ độ dài. Vui lòng nhập lại");
			frm.dienthoai.focus();
			return false;	
		}
		if(frm.email.value=="")
		{
			alert("Bạn chưa nhập email");	
			frm.email.focus();
			return false;
		}
		mail=frm.email.value;
		m=/^([A-z0-9])+[@][a-z]+[.][a-z]+[.]*([a-z]+)*$/;
		if(!m.test(mail))
		{
			alert("Bạn nhập sai email");	
			frm.email.focus();
			return false;
		}
		
		if(frm.matkhau1.value=="")
		{
			alert("Bạn chưa nhập lại password");	
			frm.pass1.focus();
			return false;
		}
		mk=frm.matkhau.value;
		mk1=frm.matkhau1.value;
		if(pass!=pass1)
		{
			alert("Password chưa đúng");	
			frm.pass1.focus();
			return false;
		}
	}
 </script>