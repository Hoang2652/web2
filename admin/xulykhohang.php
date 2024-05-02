<link rel="stylesheet" href="css/them_sanpham.css">
<?php
if(isset($_GET['formthemkhohang'])){
?>
    <form action="?admin=xulykhohang" method="post" name="frm" onsubmit="return checkcauhoithuonggap()" style="width: fit-content; margin: auto;">
        <div class="dangky">
            <div class="tabs">
                <div style="text-align: center; font-weight: bold;">THÊM KHO HÀNG</div>
            </div>
            <div class="form-row">
                    <label for="tenkhohang">Tên kho hàng</label>
                    <input class="form-control" type="text" name="tenkhohang" size="40" onclick="document.getElementById('canhbaotenkhohang').innerHTML=''" required>
                    <div class='canhbao' id='canhbaotenkhohang'></div>
            </div>
            <div class="form-row">
                    <label for="diachikhohang">Địa chỉ kho hàng</label>
                    <input class="form-control" type="text" name="diachikhohang" size="40" onclick="document.getElementById('canhbaodiachikhohang').innerHTML=''" required>
                    <div class='canhbao' id='canhbaodiachikhohang'></div>
            </div>
            <div class="form-row">
                    <label for="ghichu">Ghi chú (có thể bỏ trống)</label>
                    <input class="form-control" type="text" name="ghichu" size="40" onclick="document.getElementById('canhbaoghichu').innerHTML=''">
                    <div class='canhbao' id='canhbaoghichu'></div>
            </div>
            <div style="margin: auto; width: fit-content; margin-top: 2rem;">
                <button class="btn btn-primary" type="submit" name="submit-themkhohang">Xác nhận thêm</button>
            </div>
        </div>
    </form>

<?php 
} else if(isset($_POST['submit-themkhohang'])) {
	$tenkhohang=$_POST['tenkhohang'];
	$diachikhohang=$_POST['diachikhohang'];
    $ghichu=$_POST['ghichu'];

	//Lay ngay cua he thong
	$ngayhientai=date("Y").":".date("m").":".date("d");
	
	$insert="INSERT INTO khohang VALUES('','$tenkhohang', '$diachikhohang','$ngayhientai','$ghichu')";
	if(mysqli_query($link,$insert)) {
		echo "<script>
                alert('Thêm kho hàng \"".$tenkhohang."\" thành công!');
                window.open('admin.php?admin=hienthiqlkh','_self', 1);
              </script>";
	} else { 	
        echo "<script>
                alert('Thêm kho hàng thất bại ! Vui lòng kiểm tra lại dữ liệu');
                window.history.go(-1);
              </script>";
	}
} else if (isset($_GET['submit-formchinhsuakhohang'])){ 
    $idkhohang=$_GET['submit-formchinhsuakhohang'];
    $sql="select * from khohang where idkhohang=$idkhohang";
    $rows=mysqli_query($link,$sql);
    $row=mysqli_fetch_array($rows);
?>
    <form class="formsuakhohang" action="?admin=xulykhohang&idkhohang=<?php echo $idkhohang;?>" method="post" name="frm" onsubmit="" enctype="multipart/form-data">
	<div class="add__sp">
		<div class="tieude_themsp">
			<div colspan=2>Cập nhật thông tin kho hàng (<?php if(isset($row['tenkhohang'])) echo $row['tenkhohang']; ?>)</div>
		</div>
        <div class="form-row">
                    <label for="tenkhohang">Tên kho hàng</label>
                    <input class="form-control" type="text" name="tenkhohang" size="40"  value="<?php if(isset($row['tenkhohang'])) echo $row['tenkhohang']; ?>" onclick="document.getElementById('canhbaotenkhohang').innerHTML=''" required>
                    <div class='canhbao' id='canhbaotenkhohang'></div>
            </div>
            <div class="form-row">
                    <label for="diachikhohang">Địa chỉ kho hàng</label>
                    <input class="form-control" type="text" name="diachikhohang" size="40"  value="<?php if(isset($row['diachikhohang'])) echo $row['diachikhohang']; ?>"onclick="document.getElementById('canhbaodiachikhohang').innerHTML=''" required>
                    <div class='canhbao' id='canhbaodiachikhohang'></div>
            </div>
            <div class="form-row">
                    <label for="ghichu">Ghi chú (có thể bỏ trống)</label>
                    <input class="form-control" type="text" name="ghichu" size="40"  value="<?php if(isset($row['ghichu'])) echo $row['ghichu']; ?>" onclick="document.getElementById('canhbaoghichu').innerHTML=''">
                    <div class='canhbao' id='canhbaoghichu'></div>
            </div>
		<div class="form-group row" style="margin-top: 2rem;"> 
			<input class="btn btn-primary" style="margin:auto;" type="submit" name="submit-chinhsuakhohang" value="Cập nhật kho hàng" />
			<input class="btn btn-danger" style="margin:auto; margin-right: 10rem" type="reset" name="" value="Xóa form nhập lại" />
		</div>
	</div>
</form>
<?php } else if(isset($_POST['submit-chinhsuakhohang'])) {
    $idkhohang = $_GET['idkhohang'];
	$tenkhohang=$_POST['tenkhohang'];
	$diachikhohang=$_POST['diachikhohang'];
    $ghichu=$_POST['ghichu'];	
	$update="UPDATE khohang SET 
                                    tenkhohang='$tenkhohang',
                                    diachikhohang='$diachikhohang',
                                    ghichu='$ghichu'
                                    WHERE idkhohang=$idkhohang";
	if(mysqli_query($link,$update)) {
		echo "<script>
                alert('chỉnh sửa kho hàng \"".$tenkhohang."\" thành công!');
                window.open('admin.php?admin=hienthiqlkh','_self', 1);
              </script>";
	} else { 	
        echo "<script>
                alert('Chỉnh sửa kho hàng thất bại ! Vui lòng kiểm tra lại dữ liệu');
                window.history.go(-1);
              </script>";
	}
} else if (isset($_GET['submit-xoakhohang'])){
    $idkhohang = $_GET['submit-xoakhohang'];
    $islinkedsql1 = "select * from sanpham WHERE sanpham.idkhohang = $idkhohang LIMIT 0,1";
    $result = mysqli_num_rows(mysqli_query($link,$islinkedsql1));
    if($result == 0){
        $delete1 = "delete from khohang where idkhohang='".$idkhohang."'";
        if (mysqli_query($link,$delete1)){
            echo "<script>
                alert(' Đã xóa kho hàng: \'".$idkhohang."\' thành công.');
                window.open('admin.php?admin=hienthiqlkh','_self', 1);
            </script>";
        } else {
            echo "<script>
                alert('Xóa kho hàng thất bại: lỗi truy vấn dữ liệu');
                window.history.go(-1);
            </script>";
        }
    } else {
        echo "<script>
            alert('Xóa vị trí kho hàng thất bại: Vẫn còn sản phẩm trong kho này, Hãy đảm đảo rằng không còn sản phẩm ở trong kho để xóa kho !!');
            window.history.go(-1);
        </script>";
    }
} else {
?>

<form action="?admin=xulykhohang" method="post" name="frm" onsubmit="return checkcauhoithuonggap()" style="width: fit-content; margin: auto;">
        <div class="dangky">
            <div class="tabs">
                <div style="text-align: center; font-weight: bold;">THÊM KHO HÀNG</div>
            </div>
            <div class="form-row">
                    <label for="tenkhohang">Tên kho hàng</label>
                    <input class="form-control" type="text" name="tenkhohang" size="40" onclick="document.getElementById('canhbaotenkhohang').innerHTML=''" required>
                    <div class='canhbao' id='canhbaotenkhohang'></div>
            </div>
            <div class="form-row">
                    <label for="diachikhohang">Địa chỉ kho hàng</label>
                    <input class="form-control" type="text" name="diachikhohang" size="40" onclick="document.getElementById('canhbaodiachikhohang').innerHTML=''" required>
                    <div class='canhbao' id='canhbaodiachikhohang'></div>
            </div>
            <div class="form-row">
                    <label for="ghichu">Ghi chú (có thể bỏ trống)</label>
                    <input class="form-control" type="text" name="ghichu" size="40" onclick="document.getElementById('canhbaoghichu').innerHTML=''">
                    <div class='canhbao' id='canhbaoghichu'></div>
            </div>
            <div style="margin: auto; width: fit-content; margin-top: 2rem;">
                <button class="btn btn-primary" type="submit" name="submit-themkhohang">Xác nhận thêm</button>
            </div>
        </div>
    </form>
<?php } ?>