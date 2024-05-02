<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="css/them_sanpham.css" />
</head>

<body>
<?php
	include'../include/connect.php';
	


if(isset($_POST['btnthem']))
{
	$iddanhmuc = $_GET['iddanhmuc']; // Cho lên đầu nhé
   $m="";
   if($_POST['tendanhmuc'] == NULL){
      echo "Xin vui lòng nhập tên danh mục<br />";
   }else{
      $m=$_POST['tendanhmuc'];
   }




   if($m)
   {
	  $tendanhmuc = $_POST['tendanhmuc']; //Không đk dùng $_GET[] 
	  $loaidanhmuc = $_POST['loaidanhmuc'];
	  $mota=$_POST['mota'];
      $sql="UPDATE danhmuc SET tendanhmuc='".$tendanhmuc."', 
	  						   loaidanhmuc='".$loaidanhmuc."',
							   mota='".$mota."'
							   WHERE iddanhmuc='".$iddanhmuc."'";
	  echo "<script type='text/javascript'>alert('Sửa đổi danh mục thành công');</script>";
	  if(mysqli_query($link,$sql)) {
		echo "<p align = center>Sửa danh muc <font color='red'><b> $tendanhmuc </b></font> thành công!</p>";
		echo '<meta http-equiv="refresh" content="1;url=admin.php?admin=hienthidm">';
	}
      //exit();
   }
}

$query=mysqli_query($link,"SELECT * FROM danhmuc WHERE iddanhmuc= '{$_GET['iddanhmuc']}' ");  // OK nhé
// Cho vòng lặp vào
$row=mysqli_fetch_array($query); // chưa có mysqli_query nhé. ở trên có kia. 

?>
<div class="contentdm">
	<form action="?admin=suadm&iddanhmuc=<?php echo $row['iddanhmuc']; ?>" method="post" name="frm" onsubmit="return kiemtra()"> 
		<div class="tieude_themsp">
			Sửa Danh Mục
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Mã danh mục</label>
			<div class="col-sm-9">	
				<input class="form-control col-sm-3" type="text" disabled="disabled" name="iddanhmuc" value="<?php echo $row['iddanhmuc']; ?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Tên danh mục</label>
			<div class="col-sm-9">	
				<input class="form-control" value="<?php echo $row['tendanhmuc']; ?>" type="text" name="tendanhmuc" required />
			</div>
		</div>
		<div class="form-group row">
		<label class="col-sm-2 col-form-label">Mô tả danh mục</label>
		<div class="col-sm-9">
			<textarea class="form-control" name="mota" id="exampleFormControlTextarea1" required ></textarea>
		</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">Loại danh mục</label>
			<div class="col-sm-3">
				<select class="form-control" name="loaidanhmuc" value="">
					<option value="<?php echo $row['loaidanhmuc']; ?>"><?php echo $row['loaidanhmuc']; ?></option>
					<option value="TH">Thương Hiệu</option>
					<option value="LSP">Loại sản phẩm</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<input type="submit" class="btn btn-primary" style="margin-left: 11rem;" value="Sửa" name="btnthem"/>
			<input type="reset" class="btn btn-danger" style="margin-left: 4rem;" value="Hủy" name="btnhuy"/>
		</div>
		</table>
	</form>
</div>
</body>
</html>

<script language="javascript">
 	function  kiemtra()
	{
	    if(frm.tendanhmuc.value=="")
		{
			alert("Bạn chưa nhập tên danh mục. Vui lòng kiểm tra lại");
			frm.tendanhmuc.focus();
			return false;	
		}
	}
 </script>