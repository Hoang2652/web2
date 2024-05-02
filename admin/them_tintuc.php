<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thêm Tin Tức</title>
<link rel="stylesheet" href="css/them_sanpham.css" />
</head>

<body>
<?php
	include '../include/connect.php';

	if(isset($_POST['submit']))
	{
		$tieude=$_POST['tieude'];
		$noidungngan=$_POST['noidungngan'];
		$tacgia=$_POST['tacgia'];
		$noidungchitiet=$_POST['noidungchitiet'];
	//	$hinhanh=$_POST['hinhanh'];
		$upload_image="../img/tintuc/";
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
		move_uploaded_file($file_tmp,$upload_image.$file__name__);
		
		$insert="INSERT INTO tintuc VALUES('','$tieude', '$noidungngan', '$noidungchitiet', '$file__name__', '$ngay', '$tacgia','1')";
		$query=mysqli_query($link,$insert);
		if($query) {
			echo "Thêm tin tức hành công";		
			echo '<meta http-equiv="refresh" content="2;url=admin.php?admin=hienthitt">';
			}
			else { echo "Thêm tin tức thất bại";
			}
}


		
?>
<form action="" method="post" enctype="multipart/form-data" class="form-themtintuc">
	<div class="dangky">
      	<table>
			<div class="tabs">
				<div style="text-align: center; font-weight: bold;">THÊM TIN TỨC</div>
			</div>
			<div class="form-row mb-3">			
				<div class="col-md-8"> 
					<label for="tendangnhap">Tiêu đề  </label>
					<input type="text" name="tieude" class="form-control  col-sm-10"/>
				</div>
				<div class="col-md-4">
					<label for="tennguoidung">Tác giả</label>
					<input type="text" name="tacgia" class="form-control col-sm-12"/>
				</div>
			</div>
			<div class="form-row mb-3">			
				<div class="col-md-6"> 
					<label for="hinhanh">Hình ảnh  </label>
					<input type="file" name="hinhanh" class="form-control-file"/>
				</div>
			</div>
			<div class="form-row mb-3">			
				<div class="col-md-12"> 
					<label for="noidungngan">Nội dung ngắn </label>
					<textarea name="noidungngan" class="form-control nd-ngan"></textarea>
				</div>
			</div>	
			<div class="mb-3">
				<label for="chitiet">Nội dung chi tiết</label>
				<div>
					<textarea name="noidungchitiet" id="chitiet"></textarea>
				</div>
			</div>
			<div class="form-group row" style="margin-top: 2rem;"> 
				<input class="btn btn-primary" style="margin:auto;" type="submit" name="submit" value="Thêm tin tức" />
				<input class="btn btn-danger" style="margin:auto; margin-right: 10rem" type="reset" name="" value="Về mặc định" />
			</div>
        </table> 
	</div> 
</form>

<script type="text/javascript" language="javascript">
 
  CKEDITOR.replace( 'chitiet', {
	uiColor: '#d1d1d1'
});
</script>

</body>
</html>