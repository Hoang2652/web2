<script type="text/javascript" src="js/javafunction.js"></script>
<link rel="stylesheet" href="css/hienthi_sp.css" >
<?php
require_once('../include/connect.php');
require_once('function/function.php');
if(isset($_GET['formthemvitri'])){    
?>
<form action="?admin=xulyhangtonkho" method="post" name="frm" onsubmit="return checkvitrikhohang()" style="width: fit-content; margin: auto;">
        <div class="container__addvitrikhohang">
            <div class="title__hdkh">
                <div>THÊM VỊ TRÍ KHO HÀNG</div>
            </div>
            <div class="form-row mb-3">
                    <label for="tenvitrikhohang">Tên vị trí:</label>
                    <input class="form-control" type="text" name="tenvitrikhohang" size="40" onclick="document.getElementById('canhbaotenvitrikhohang').innerHTML=''" required>
                    <div class='canhbao' id='canhbaotenvitrikhohang'></div>
            </div>
            <div class="form-row mb-3">
            <div class="col-md-6">
                <label for="diachixuatkho">Vị trí cho kho hàng: </label>
                    <select class="custom-select mr-sm-2" style="width: 190px;" name="idkhohang" required>
                        <option value="">-Chọn địa chỉ kho hàng-</option>
                        <?php
                            $show = mysqli_query($link,"SELECT * FROM khohang");
                            while($show1 = mysqli_fetch_array($show))
                            {
                                $idkhohang = $show1['idkhohang'];
                                $tenkhohang = $show1['tenkhohang'];
                                $diachikhohang = $show1['diachikhohang'];
                                if(isset($_GET['idkhohang']) && $_GET['idkhohang'] == $idkhohang){
                                    echo "<option value='".$idkhohang."' selected> - (".$tenkhohang.") Địa chỉ: ".$diachikhohang."</option>";  
                                    continue;
                                } 
                                echo "<option value='".$idkhohang."'> - (".$tenkhohang.") Địa chỉ: ".$diachikhohang."</option>";
                            }
                        ?>
				    </select>
            </div>
            
        </div>
            <div style="margin: auto; width: fit-content; margin-top: 2rem;">
                <button class="btn btn-primary mb-3" type="submit" name="submit-themvitrikhohang">Xác nhận thêm</button>
            </div>
    </form>

    <div id="danhsachvitrikhohang">
        <h6 style="text-align: center; font-weight: bold;"><i class="fas fa-user"></i> Danh sách vị trí kho hàng</h6>
        <table>
            <thead>
                <tr class='tieude_hienthi_sp'>
                    <th>Vị trí</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select = "select * from vitrikhohang WHERE idkhohang=".$_GET['idkhohang']." order by idvitrikhohang ASC";
                $query = mysqli_query($link,$select);
                while($rows = mysqli_fetch_array($query)){
                ?>
                    <tr class='noidung_hienthi_sp'>
                        <td><?php echo $rows['tenvitrikhohang'];?></td>
                        <td>
                            <div onclick="checkdelvitrikhohang(<?php echo $rows['idvitrikhohang'];?>)">
                                <i class="fas fa-trash-alt" style="transform: scale(1.5); color: red;" ></i>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<?php } else if(isset($_POST['submit-themvitrikhohang'])){
	$tenvitrikhohang=$_POST['tenvitrikhohang'];
    $idkhohang=$_POST['idkhohang'];
	$insert="INSERT INTO vitrikhohang VALUES('','$tenvitrikhohang', '$idkhohang')";
	if(mysqli_query($link,$insert)) {
		echo "<script>
                alert('Thêm vị trí \"".$tenvitrikhohang."\" vào kho hàng \"".$idkhohang."\" thành công!');
                window.history.go(-1);
              </script>";
	} else { 	
        echo "<script>
                alert('Thêm vị trí kho hàng thất bại ! Vui lòng kiểm tra lại dữ liệu');
                window.history.go(-1);
              </script>";
	}
} else if (isset($_GET['submit-xoavitrikhohang'])){
    $idvitrikhohang = $_GET['submit-xoavitrikhohang'];
    $islinkedsql = "select * from vitrisanpham where idvitrikhohang = $idvitrikhohang LIMIT 0,1";
    if(!mysqli_query($link,$islinkedsql)){
        $delete1 = "delete from vitrikhohang where idvitrikhohang='".$idvitrikhohang."'";
        if (mysqli_query($link,$delete1)){
            echo "<script>
                alert(' Đã xóa vị trí: \'".$idvitrikhohang."\' thành công.');
                window.history.go(-1);
            </script>";
        } else {
            echo "<script>
                alert('Xóa vị trí kho hàng thất bại: lỗi truy vấn dữ liệu');
                window.history.go(-1);
            </script>";
        }
    } else {
        echo "<script>
            alert('Xóa vị trí kho hàng thất bại: Có sản phẩm mang vị trí này, Hãy đảm đảo rằng không còn sản phẩm ở vị trí này');
            window.history.go(-1);
        </script>";
    }
} 
/*******************************/
// XUẤT FORM THAO TÁC VỊ TRÍ CỦA SẢN PHẨM THEO ID
/*******************************/

else if (isset($_GET['submit-formchinhsuasanphamtonkho']) && isset($_GET['idkhohang'])){ 
    $idsanpham=$_GET['submit-formchinhsuasanphamtonkho'];
    $idkhohang=$_GET['idkhohang'];
    $sql="select * from sanphamtonkho where idsanpham=$idsanpham";
    $rows=mysqli_query($link,$sql);
    $row=mysqli_fetch_array($rows);
?>
    <form class="formthemsanpham" action="xulyhangtonkho.php?submit-chinhsuasanphamtonkho=<?php echo $idsanpham;?>" method="post" name="frm" onsubmit="" enctype="multipart/form-data">
	<div class="add__sp">
		<div class="title__hdkh">
			<div colspan=2>Cập nhật thông tin vị trí sản phẩm trong kho</div>
		</div>
        <div class="container__sptonkho">
            <div class="form-row mb-3">
                <div class="col-md-6">
                    <label for="tensanpham">ID sản phẩm</label>
                    <input class="form-control" type="text" name="tensanpham" value="<?php echo $row['idsanpham'] ?>" disabled/>
                </div>
                <div class="col-md-6">
                    <label for="tensanpham">Tên sản phẩm</label>
                    <input class="form-control" type="text" name="tensanpham" value="<?php echo $row['tensanpham'] ?>" disabled/>
                </div>
            </div>
            <div class="form-row mb-3">
                <label for="idvitrikhohang">Danh sách vị trí trong kho</label>
                <select class="custom-select mr-sm-2" name="idvitrikhohang" id="idvitrikhohang" onchange="addvitrisanpham(<?php echo $idsanpham;?>)">
                    <option value="">Chọn để gán vị trí vào sản phẩm:</option>
                    <?php
                    $select1 = "select * from vitrikhohang,khohang where vitrikhohang.idkhohang = khohang.idkhohang AND khohang.idkhohang = $idkhohang order by vitrikhohang.idvitrikhohang ASC";
                    $query1 = mysqli_query($link,$select1);
                    while($rows1 = mysqli_fetch_array($query1)){
                        $idvitrikhohang = $rows1['idvitrikhohang'];
                    ?>
                        <option value="<?php echo $idvitrikhohang; ?>"> Vị trí <?php echo $rows1['tenvitrikhohang']; ?></option>
                    <?php } ?>
                </select>
            </div>
            VỊ TRÍ SẢN PHẨM NÀY ĐƯỢC ĐẶT
            <table>
                    <thead>
                        <tr class='tieude_hienthi_sp'>
                            <th>Vị trí</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $select1 = "select * from vitrisanpham,vitrikhohang,khohang where vitrikhohang.idvitrikhohang = vitrisanpham.idvitrikhohang AND vitrikhohang.idkhohang = khohang.idkhohang AND vitrisanpham.idsanpham = $idsanpham order by vitrisanpham.idvitrikhohang ASC";
                            $query1 = mysqli_query($link,$select1);
                            while($rows1 = mysqli_fetch_array($query1)){
                        ?>
                            <tr class='noidung_hienthi_sp'>
                                <td><?php echo $rows1['tenvitrikhohang'];?></td>
                                <td>
                                    <div onclick="checkdelvitrisanpham(<?php echo $rows1['idvitrikhohang'];?>,<?php echo $rows1['idsanpham'];?>)">
                                        <i class="fas fa-trash-alt" style="transform: scale(1.5); color: red;" ></i>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>
	</div>
</form>
<?php 
/*******************************/
// GỠ VỊ TRÍ RA KHỎI SẢN PHẨM
/*******************************/

} else if (isset($_GET['submit_xoavitrisanpham']) && isset($_GET['idsanpham'])){ 
    $idsanpham = $_GET['idsanpham'];
    $idvitrikhohang = $_GET['submit_xoavitrisanpham'];
    $delete1 = "delete from vitrisanpham where idvitrikhohang='".$idvitrikhohang."' AND idsanpham='".$idsanpham."'";
    if (mysqli_query($link,$delete1)){
        echo "<script>
            alert(' Đã gỡ sản phẩm ra khỏi vị trí id: \'".$idsanpham."\' thành công.');
            window.history.go(-1);
        </script>";
    } else {
        echo "<script>
        alert('Gỡ vị trí thất bại: lỗi truy vấn dữ liệu');
        window.history.go(-1);
        </script>";
    }
} 
/*******************************/
// GÁN VỊ TRÍ VÀO SẢN PHẨM
/*******************************/

else if (isset($_GET['submit-themvitrisanpham']) && isset($_GET['idsanpham'])){ 
    $idsanpham = $_GET['idsanpham'];
    $idvitrikhohang = $_GET['submit-themvitrisanpham'];
	$sql_insert="INSERT INTO vitrisanpham VALUES('$idvitrikhohang', '$idsanpham')";
    $update=mysqli_query($link,$sql_insert);
    if($update){
    echo "<script>
        alert('Đã gán vị trí id: \'".$idsanpham."\' trong kho cho sản phẩm.');
        window.history.go(-1);
    </script>";
    } else {
    echo "<script>
        alert('Gán vị trí thất bại: lỗi truy vấn dữ liệu');
        window.history.go(-1);
    </script>";
    }
} else {?>
<form action="?admin=xulyhangtonkho" method="post" name="frm" onsubmit="return checkvitrikhohang()" style="width: fit-content; margin: auto;">
        <div class="dangky">
            <div class="title__hdkh">
                <div>THÊM VỊ TRÍ KHO HÀNG</div>
            </div>
            <div class="form-row">
                    <label for="tenvitrikhohang">Tên vị trí:</label>
                    <input class="form-control" type="text" name="tenvitrikhohang" size="40" onclick="document.getElementById('canhbaotenvitrikhohang').innerHTML=''" required>
                    <div class='canhbao' id='canhbaotenvitrikhohang'></div>
            </div>
            <div class="form-row mb-3">
            <div class="col-md-6">
                <label for="diachixuatkho">Vị trí cho kho hàng: </label>
                    <select class="custom-select mr-sm-2" style="width: 190px;" name="idkhohang" required>
                        <option value="">-Chọn địa chỉ kho hàng-</option>
                        <?php
                            $show = mysqli_query($link,"SELECT * FROM khohang");
                            while($show1 = mysqli_fetch_array($show))
                            {
                                $idkhohang = $show1['idkhohang'];
                                $tenkhohang = $show1['tenkhohang'];
                                $diachikhohang = $show1['diachikhohang'];
                                if(isset($_GET['idkhohang']) && $_GET['idkhohang'] == $idkhohang){
                                    echo "<option value='".$idkhohang."' selected> - (".$tenkhohang.") Địa chỉ: ".$diachikhohang."</option>";  
                                    continue;
                                } 
                                echo "<option value='".$idkhohang."'> - (".$tenkhohang.") Địa chỉ: ".$diachikhohang."</option>";
                            }
                        ?>
				    </select>
                    <div class='canhbao' id='canhbaoidkhohang'></div>
            </div>
            <div style="margin: auto; width: fit-content; margin-top: 2rem;">
                <button class="btn btn-primary" type="submit" name="submit-themvitrikhohang">Xác nhận thêm</button>
            </div>
        </div>
    </form>

    <div id="danhsachvitrikhohang">
        <h6 style="text-align: center; font-weight: bold;"><i class="fas fa-user"></i> Danh sách vị trí kho hàng</h6>
        <table>
            <thead>
                <tr class='tieude_hienthi_sp'>
                    <th>Vị trí</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select = "select * from vitrikhohang  WHERE idkhohang=".$_GET['idkhohang']." order by idvitrikhohang ASC";
                $query = mysqli_query($link,$select);
                while($rows = mysqli_fetch_array($query)){
                ?>
                    <tr class='noidung_hienthi_sp'>
                        <td><?php echo $rows['tenvitrikhohang'];?></td>
                        <td>
                            <div onclick="checkdelvitrikhohang(<?php echo $rows['idvitrikhohang'];?>)">
                                <i class="fas fa-trash-alt" style="transform: scale(1.5); color: red;" ></i>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>

<script>
function checkvitrikhohang(){
    if(frm.idkhohang.value=="")
	{
		document.getElementById('canhbaoidkhohang').innerHTML="Bạn chưa chọn kho hàng. Vui lòng kiểm tra lại";
		return false;
	}
    return true
}
</script>