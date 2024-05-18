<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thêm Sản Phẩm</title>
<link rel="stylesheet" href="css/them_sanpham.css" />
</head>

<body>
<?php
	include '../include/connect.php';

	if(isset($_POST['submit'])){
		$isValidated = true;
		$tensanpham=$_POST['tensanpham'];
		$gia=$_POST['gia'];
		$mota=$_POST['mota'];
		$baohanh=$_POST['baohanh'];
		$xuatxu=$_POST['xuatxu'];
		$loaisanpham=$_POST['loaisanpham'];
		$chitiet="";
		$chitiet=$_POST['chitiet'];
		$soluong=$_POST['soluong'];
		$soluongtonkho=0;

		$giamgia=$_POST['giamgia'];
		$quatang=$_POST['quatang'];
		$soluongkhuyenmai=$_POST['soluongkhuyenmai'];
		$idkhohang=$_POST['idkhohang'];

		$upload_image="../img/uploads/";
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

		if($soluong < $soluongkhuyenmai){
			echo "<script>
			alert('Thêm sản phẩm thất bại! Số lượng khuyến mãi ('".$soluongkhuyenmai.") của sản phẩm \'".$tensanpham."\' vượt qua số lượng đăng bán \'".$soluong."\'.');
			window.history.back(-2);
			</script>";
			$isValidated = false;
		}

		$idsanphammoithem = 0;
		if($isValidated){
			move_uploaded_file($file_tmp,$upload_image.$file__name__);
			$iddanhmuc=$_POST['iddanhmuc'];
			$insert="INSERT INTO sanpham VALUES('', '$tensanpham', '$loaisanpham' ,'$file__name__', '$mota' , '$xuatxu' , '$baohanh', '$chitiet', '$soluong','0', '$gia', '$iddanhmuc', '$giamgia', '$quatang' , '$soluongkhuyenmai' , '$ngay','0','','$idkhohang')";
			$query=mysqli_query($link,$insert);
			$idsanphammoithem=mysqli_insert_id($link);
		}
			if($query) {
				if (!empty($_POST['decudautrang'])){
					$sqlrecommendcheck = mysqli_query($link,"select * from sanphamdecu where idsanphamdecu='1'");
					if(mysqli_num_rows($sqlrecommendcheck) > 0){
						$update=mysqli_query($link,"UPDATE sanphamdecu SET idsanpham='$idsanphammoithem' WHERE idsanphamdecu='1'");
					} else {
						$update=mysqli_query($link,"INSERT INTO sanphamdecu VALUES(1,'Sản phẩm đầu trang','$idsanphammoithem')");
					}
				}
				if (!empty($_POST['decugiuatrang'])){
					$sqlrecommendcheck = mysqli_query($link,"select * from sanphamdecu where idsanphamdecu='2'");
					if(mysqli_num_rows($sqlrecommendcheck) > 0){
						$update=mysqli_query($link,"UPDATE sanphamdecu SET idsanpham='$idsanphammoithem' WHERE idsanphamdecu='2'");
					} else {
						$update=mysqli_query($link,"INSERT INTO sanphamdecu VALUES(2,'Sản phẩm giữa trang','$idsanphammoithem')");
					}
				}
				if (!empty($_POST['decusanpham'])){
					$update=mysqli_query($link,"INSERT INTO sanphamdecu VALUES(3,'Sản phẩm đề cử','$idsanphammoithem')");
				}
	
				// if($result2 = mysqli_fetch_array($queryresult2)){
				// 	echo "<script>
				// 	alert('Sản phẩm \'".$result2['tensanpham']."\' đã tồn tại trong csdl, bạn có thể tìm kiếm và chỉnh sửa sản phẩm');
				// 	window.history.back(-2);
				// 	</script>";
				// 	$isValidated = false;
				// }
				echo "<script>alert('Thêm sản phẩm thành công!');</script>";
			} else { 
					echo "<script>
					alert('Thêm sản phẩm thất bại'); 
					window.history.back(-2);
					</script>";
			}
		}


		
?>
<form class="formthemsanpham" action="" method="post" enctype="multipart/form-data" name="frm" onsubmit="return kiemtra()">
	<div class="add__sp">
		<div class="tieude_themsp">
			<div colspan=2>Thêm Sản Phẩm </div>
		</div>
		<div id='inputfield'>
			<div class="form-row mb-3">
				<div class="col-md-6">
					<label for="tensanpham">Tên sản phẩm: </label>
					<input class="form-control" type="text" name="tensanpham" required/>
				</div>
				<div class="col-md-6">
					<label for="iddanhmuc" style="display: grid">Thương hiệu</label>
					<select class="custom-select mr-sm-2" style="width: 190px;" name="iddanhmuc" required>
						<option value="">Chọn danh mục</option>
						<?php
							$show = mysqli_query($link,"SELECT * FROM danhmuc");
							while($show1 = mysqli_fetch_array($show))
							{
								$iddanhmuc = $show1['iddanhmuc'];	
								$tendanhmuc = $show1['tendanhmuc'];
								echo "<option value='".$iddanhmuc."'> - ".$tendanhmuc."</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-row mb-3">
				<div class="col-md-6">
					<label for="soluong">Số lượng</label>
					<input class="form-control col-sm-5" type="text" name="soluong" required/>
				</div>
				<div class="col-md-6">
					<label for="gia" >Giá bán</label>
					<input class="form-control col-sm-5" type="text" name="gia" required/>
				</div>
			</div>
			<div class="form-row mb-3">
				<div class="col-md-6">
					<label for="hinhanh">Hình ảnh</label>			
					<input class="form-control-file" type="file" name="hinhanh" id="hinhanh"/>
					<img class="mt-3 w-100" id="preview" src="#" alt="Hình ảnh" style="display: none;"/>
				</div>
				<div class="col-md-6">
					<label for="idkhohang" >Ở kho hàng: </label>
					<br />
					<select class="custom-select mr-sm-2" style="width: 190px;" name="idkhohang" required>
						<option value="">Chọn kho hàng</option>
						<?php
							$show = mysqli_query($link,"SELECT * FROM khohang");
							while($show1 = mysqli_fetch_array($show))
							{
								$idkhohang = $show1['idkhohang'];	
								$tenkhohang = $show1['tenkhohang'];
								echo "<option value='".$idkhohang."'> - ".$tenkhohang."</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class='form-row mb-3'>
				<div class='col-md-6'>
                	<label for='xuatxu'>Xuất xứ</label>			
	                <input class='form-control' type='text' name='xuatxu' required/>
            	</div>
				<div class='col-md-3'>
					<label for='baohanh'>Bảo hành (tháng)</label>			
					<input class='form-control' type='text' name='baohanh' required/>
				</div>
       		</div>
			<div class='form-row mb-3'>
			   <div class='col-md-6'>
					<label for='loaisanpham'>Loại Sản Phẩm</label>			
					<select class="custom-select mr-sm-2" style="width: 190px;" name="loaisanpham" required>
						<option value="">Chọn loại sản phâm</option>
						<option value="8">Đồng hồ</option>
						<option value="4">Bông tai</option>
						<option value="6">Vòng lắc</option>
					</select>
				</div>
			</div>
			<div class='form-row mb-3'>
			   <div class='col-md-6'>
					<label for='mota'>Mô tả</label>			
					<textarea class='form-control' type='text' name='mota' required></textarea>
				</div>
			</div>
		</div>
		<div class="mb-3">
			<label for="chitiet">Chi tiết</label>
			<div>
				<textarea name="chitiet" id="chitiet"></textarea>
			</div>
		</div>
		Đề cử <font>(có thể bỏ qua)</font>
			<div class="mb-3 mt-2">
				<div class="form-check mb-2">
					<input class="form-check-input" type="checkbox" name="decudautrang" />
					<label class="form-check-label" for="decudautrang">Xuất hiện đầu trang chủ</label>
				</div>
				<div class="form-check mb-2">
					<input class="form-check-input" class="form-control col-sm-5" type="checkbox" name="decugiuatrang" />
					<label class="form-check-label" for="decugiuatrang" >Xuất hiện giữa trang chủ</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" class="form-control col-sm-5" type="checkbox" name="decusanpham" />
					<label class="form-check-label" for="decusanpham" >Sản phẩm đề cử</label>
				</div>
			</div>
		Cài đặt khuyến mãi <font>(có thể bỏ qua)</font>
		<div class="form-row mb-3 mt-2">
			<div class="col-md-6">
				<label for="giamgia">Giảm giá: </label>
				<input class="form-control col-sm-5" maxlength="3" type="text" name="giamgia" value=""/>
			</div>
			<div class="col-md-6">
				<label for="quatang" >Quà tặng kèm: </label>
				<input class="form-control col-sm-5" type="text" name="quatang" value=""/>
			</div>
		</div>
		<div class="form-row">
			<div class="col-md-6">
				<label for="soluongkhuyenmai" >số lượng khuyến mãi (không thể vượt qua số lượng sản phẩm):</label>
				<input class="form-control col-sm-5" maxlength="5" type="text" name="soluongkhuyenmai" value=""/>
			</div>
		</div>
		<div class="form-group row" style="margin-top: 2rem;"> 
			<input class="btn btn-primary" style="margin:auto;" type="submit" name="submit" value="Thêm sản phẩm" />
			<input class="btn btn-danger" style="margin:auto; margin-right: 10rem" type="reset" name="" value="Về mặc định" />
		</div>
	</div>
</form>

<script type="text/javascript" language="javascript">
 
  CKEDITOR.replace( 'chitiet', {
	uiColor: '#d1d1d1'
});
</script>

</body>
</html>

<script language="javascript">
 	function  kiemtra()
	{
	    
		if(frm.tensanpham.value=="")
	 	{
			alert("Bạn chưa nhập tên SP. Vui lòng kiểm tra lại");
			frm.tensanpham.focus();
			return false;	
		}
		if(frm.hinhanh.value=="")
		{
			alert("Bạn chưa chọn hình ảnh");	
			frm.hinhanh.focus();
			return false;
		}
		if(frm.soluong.value=="")
		{
			alert("Bạn chưa nhập số lượng");	
			frm.soluong.focus();
			return false;
		}
		if(frm.iddanhmuc.value=="")
		{
			alert("Bạn chưa chọn danh mục");	
			frm.iddanhmuc.focus();
			return false;
		}
	}

    document.getElementById('hinhanh').addEventListener('change', function(event) {
        var input = event.target;

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                var preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    });

 </script>