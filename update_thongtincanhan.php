<?php
echo "<script>document.getElementById('content').innerHTML=''</script>";
echo "<script>document.getElementById('left-content').innerHTML=''</script>";

if(isset($_POST['submitupdate']) && isset($_SESSION['idnguoidung'])){
	$tennguoidung=$_POST['tennguoidung'];
	$email=$_POST['email'];
	$ngaysinh=$_POST['ngaysinh'];
	$gioitinh=$_POST['gioitinh'];
	$dienthoai=$_POST['dienthoai'];
	$diachi=$_POST['diachi'];
	
    $sql_update=("UPDATE nguoidung SET
                         tennguoidung='$tennguoidung',
                         email='$email',
                         ngaysinh='$ngaysinh',
                         gioitinh='$gioitinh',
                         dienthoai='$dienthoai',
                         diachi='$diachi'
                         where idnguoidung='".$_SESSION['idnguoidung']."'");

    $update=mysqli_query($link,$sql_update);
    if($update){
		echo "
			<script language='javascript'>
			alert('Cập nhật thông tin cá nhân thành công');
			window.open('index.php?content=ttcn','_self', 1);
			</script>
			";
    } else {
        echo "
            <script language='javascript'>
            alert('Cập nhật thông tin thất bại');
            window.open('index.php?content=doithongtincanhan','_self', 1);
            </script>
        ";
    }
}

if(isset($_SESSION['idnguoidung'])){
    $sql=mysqli_query($link,"select * from nguoidung where idnguoidung='".$_SESSION['idnguoidung']."'");
    $row=mysqli_fetch_array($sql);
}
?>

<form action="index.php?content=doithongtincanhan" method="post" name="frm" style="width: fit-content; margin: auto; margin-top: 4rem">
	<div class="dangky">
		<h3 style="text-align: center; padding-bottom: 15px;">Cập nhật thông tin tài khoản</h3>
		<div class="center-align">
			<div class="form-row">
                <div class="col-md-6 mb-3">
					<label for="tennguoidung">Họ và tên</label>
					<input class="form-control" type="text" name="tennguoidung" size="40" value="<?php if($row){echo $row['tennguoidung'];} ?>" onclick="document.getElementById('canhbaotennguoidung').innerHTML=''"><div class='canhbao' id='canhbaotennguoidung'></div>
				</div>
                <div class="col-md-6 mb-3">
					<label for="exampleInputEmail1">Điện thoại</label>
					<input class="form-control" type="text" name="dienthoai" size="40" value="<?php if($row){echo $row['dienthoai'];} ?>" onclick="document.getElementById('canhbaodienthoai').innerHTML=''"><div class='canhbao' id='canhbaodienthoai'></div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-2">
					<label for="exampleInputEmail1">Email</label>
					<input class="form-control" type="text" name="email" size="40" value="<?php if($row){echo $row['email'];} ?>" onclick="document.getElementById('canhbaoemail').innerHTML=''"><div class='canhbao' id='canhbaoemail'></div>
				</div>
				<div class="col-md-6 mb-2">
					<label for="exampleInputEmail1">Địa chỉ</label>
					<input class="form-control" value="<?php if($row){echo $row['diachi'];} ?>" type="text" name="diachi" size="40">
				</div>
			</div>
            <div class="form-row">
				<div class="col-md-6 mb-3">
					<label for="ngaysinh">Ngày sinh</label>
					<input class="form-control" value="<?php if($row){echo $row['ngaysinh'];} ?>" type="date" name="ngaysinh">
				</div>
				<div class="col-md-6 mb-3" style="display: grid">
					<label for="gioitinh">Giới tính</label>
							<select value="<?php if($row){echo $row['gioitinh'];} ?>" class="custom-select mr-sm-2" style="width: 190px;" name="gioitinh">
								<option value="">-Chọn giới tính-</option>
								<option value="nam">Nam</option>
								<option value="nu">Nữ</option>
							</select>
				</div>
			</div>
			<div style="margin: auto; width: fit-content; margin-top: 20px;">
				<button class="btn btn-primary" type="submit" name="submitupdate">Cập nhật</button>
				<button class="btn btn-danger" type="reset" style="margin-left: 60px;">Xóa hết</button>
			</div>
		</div>
	</div>
</form>