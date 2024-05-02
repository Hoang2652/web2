<link rel="stylesheet" href="css/them_sanpham.css">
<?php
if(isset($_POST['submit_cauhoithuonggap'])) {
	$noidungcauhoi=$_POST['noidungcauhoi'];
	$cautraloi=$_POST['cautraloi'];

	//Lay ngay cua he thong
	$ngayhientai=date("Y").":".date("m").":".date("d");
	
	if(isset($_POST['idcauhoi'])){
		$idcauhoi = $_POST['idcauhoi'];
		$update=("
		         UPDATE traloicauhoi SET noidungcauhoi='$noidungcauhoi',
										 cautraloi='$cautraloi',
										 ngaytraloi='$ngayhientai'
									 WHERE idcauhoi='$idcauhoi'");						
		if(mysqli_query($link,$update)) {
			redirect("admin.php?admin=cauhoithuonggap", "Bạn đã sửa thành công.",2);
		} else { 	
			echo $update;
			redirect("admin.php?admin=cauhoithuonggap", "Bạn đã sửa thất bại.", 2 );
		}
	} else {
		$insert="INSERT INTO traloicauhoi VALUES('','$noidungcauhoi', '$cautraloi','$ngayhientai')";
		if(mysqli_query($link,$insert)) {
			redirect("admin.php?admin=cauhoithuonggap", "Bạn đã thêm thành công.",2 );
		} else { 	
			redirect("admin.php?admin=cauhoithuonggap", "Bạn đã thêm thất bại.", 2 );
		}
	}
} else if(isset($_POST['submit_xoacauhoithuonggap'])){
	$idcauhoi = $_POST['submit_xoacauhoithuonggap'];
	$delete="DELETE FROM traloicauhoi WHERE idcauhoi='$idcauhoi'";
	if(mysqli_query($link,$delete)) {
		redirect("admin.php?admin=cauhoithuonggap", "Bạn đã xóa thành công.", 2);
	} else { 	
		redirect("admin.php?admin=cauhoithuonggap", "Bạn đã xóa thất bại.", 2 );
	}
}

if(isset($_GET['submit-themdulieuhotro'])){
$idcauhoi = $_GET['submit-themdulieuhotro'];
$sqlcauhoi="select * FROM traloicauhoi WHERE idcauhoi = $idcauhoi ";
$result = mysqli_query($link,$sqlcauhoi);
if($row = mysqli_fetch_array($result)){
?>
<div class="wrapper__ds">
	<form action="?admin=cauhoithuonggap" method="post" name="frm" onsubmit="return checkcauhoithuonggap()" style="width: fit-content; margin: auto;">
		<div class="dangky" id="cauhoithuonggap">
			<div class="tabs">
				<div style="text-align: center; font-weight: bold;">SỬA CÂU HỎI THƯƠNG GẶP</div>
			</div>
			<div class="form-row">
					<label for="noidungcauhoi">Nội dung câu hỏi</label>
					<input class="form-control" type="text" name="noidungcauhoi" id="noidungcauhoi" size="40" value="<?php echo $row['noidungcauhoi']?>" required>
					<input class="form-control" type="hidden" name="idcauhoi" id="idcauhoi" size="40" value="<?php echo $row['idcauhoi']?>">
			</div>
			<div class="mb-3">
					<label for="cautraloi">Câu trả lời</label>
					<div>
						<textarea name="cautraloi" id="cautraloi" required>
							<?php echo $row['cautraloi']?>
						</textarea>
					</div>
					<div class='canhbao' id='canhbaocautraloi'></div>
			</div>
			<div style="margin: auto; width: fit-content; margin-top: 2rem;">
				<button class="btn btn-primary" type="submit" name="submit_cauhoithuonggap">Sửa câu hỏi</button>
			</div>
		</div>
	</form>
	<?php }} else { ?>
		<div class="wrapper__ds">
	<form action="?admin=cauhoithuonggap" method="post" name="frm" onsubmit="return checkcauhoithuonggap()" style="width: fit-content; margin: auto;">
		<div class="dangky" id="cauhoithuonggap">
			<div class="tabs">
				<div style="text-align: center; font-weight: bold;">THÊM CÂU HỎI THƯƠNG GẶP</div>
			</div>
			<div class="form-row">
					<label for="noidungcauhoi">Nội dung câu hỏi</label>
					<input class="form-control" type="text" name="noidungcauhoi" id="noidungcauhoi" size="40" required>
					<input class="form-control" type="hidden" name="idcauhoi" id="idcauhoi" size="40">
			</div>
			<div class="mb-3">
					<label for="cautraloi">Câu trả lời</label>
					<div>
						<textarea name="cautraloi" id="cautraloi" required></textarea>
					</div>
					<div class='canhbao' id='canhbaocautraloi'></div>
			</div>
			<div style="margin: auto; width: fit-content; margin-top: 2rem;">
				<button class="btn btn-primary" type="submit" name="submit_cauhoithuonggap">Xác nhận thêm</button>
			</div>
		</div>
	</form>
	<?php }?>

	<div id="danhsachcauhoi">
		<div class="dangky">
			<div class="tabs">
				<h6 style="text-align: center; font-weight: bold; font-size:24px;"> Danh sách câu hỏi</h6>
			</div>
			<?php
			$select = "select * from traloicauhoi order by idcauhoi DESC";
			$query = mysqli_query($link,$select);
			while($rows = mysqli_fetch_array($query)){
			?>
			<li class="list-group-item"><a onclick="checkdelcauhoithuonggap(<?php echo $rows['idcauhoi'];?>)"><i class="fas fa-trash-alt" style="transform: scale(1.5); color: red;" ></i></a><a href='?admin=cauhoithuonggap&submit-themdulieuhotro=<?php echo $rows['idcauhoi'];?>' style="padding-left: 15px;"><?php echo $rows['noidungcauhoi'];?></a></li>
			<?php } ?>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript">
    CKEDITOR.replace( 'cautraloi', {
	    uiColor: '#d1d1d1'
    });

    function  checkcauhoithuonggap(){
		if(frm.noidungcauhoi.value=="")
	 	{
			alert("Bạn chưa nhập nội dung câu hỏi");
			frm.noidungcauhoi.focus();
			return false;	
		}
        return true;
	}   
</script>