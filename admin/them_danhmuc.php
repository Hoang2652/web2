<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thêm Danh Mục</title>
<link rel="stylesheet" href="css/them_sanpham.css" />
</head>

<body>
<?php
	include'../include/connect.php';
 

if(isset($_POST['btnthem']))
{
	$tendanhmuc=$_POST['tendanhmuc'];
	$loaidanhmuc=$_POST['loaidanhmuc'];
	$mota=$_POST['mota'];
	$insertdm = mysqli_query($link,"INSERT INTO danhmuc VALUES('', '$tendanhmuc', '$loaidanhmuc','$mota') ");
	if($insertdm) {
		
		echo "<p align = center>Thêm danh muc <font color='red'><b> $tendanhmuc </b></font> thành công!</p>";
		echo '<meta http-equiv="refresh" content="1;url=admin.php?admin=hienthidm">';
	}
	else {
		echo "Thêm thất bại";
	}
}
?>
<div class="contentdm">
	<form action="" method="post" class="needs-validation">
		<div class="tieude_themsp">
			Thêm Danh Mục
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Mã danh mục</label>
			<div class="col-sm-9">	
				<input class="form-control col-sm-3" type="text" disabled="disabled" name="iddanhmuc"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Tên danh mục</label>
			<div class="col-sm-9">	
				<input class="form-control" type="text" name="tendanhmuc" required />
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Mô tả danh mục</label>
			<div class="col-sm-9">
				<textarea class="form-control" name="mota" id="exampleFormControlTextarea1" rows="5" required ></textarea>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Loại danh mục</label>
			<div class="col-sm-3">
				<select class="form-control" name="loaidanhmuc">
					<option value="0">Danh mục chính</option>
					<option value="TH">Thương hiệu</option>
					<option value="LSP">Loại sản phẩm</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<input type="submit" class="btn btn-primary" style="margin-left: 11rem;" value="Thêm" name="btnthem"/>
			<input type="reset" class="btn btn-danger" style="margin-left: 50px;" value="Hủy" name="btnhuy"/>
		</div>
	</form>
</div>

</body>
</html>