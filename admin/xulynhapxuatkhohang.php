<script type="text/javascript" src="js/javafunction.js"></script>
<link rel="stylesheet" href="css/hienthi_sp.css" >
<?php 
// CHÀO MỪNG TỚI VỚI FILE 'XỬ LÝ NHẬP XUẤT KHO HÀNG' //
/****************************************/
// 1. PHẦN HÀM THÊM HÓA ĐƠN NHẬP XUẤT KHO
// 2. PHẦN HÀM XÓA HÓA ĐƠN NHẬP XUẤT KHO
// 3. PHẦN HÀM THAY ĐỔI TRẠNG THÁI HÓA ĐƠN NHẬP XUẤT KHO
// 4. PHẦN HÀM TẠO FORM THÊM HÓA ĐƠN NHẬP / XUẤT
/****************************************/


/****************************************/
// PHẦN HÀM THÊM HÓA ĐƠN NHẬP XUẤT KHO
/****************************************/
if(isset($_POST['submit-themhoadonnhapxuat'])){
    $isValidated = true;
    $tendoitac=$_POST['doitac'];
	$dienthoai=$_POST['dienthoai'];
	$email=$_POST['email'];
    $diachinhapkho=$_POST['diachinhapkho'];
    $diachixuatkho=$_POST['diachixuatkho'];
    $ngaynhapxuat=$_POST['ngaynhapxuat'];
    $loaihoadon=$_POST['loaihoadon'];
    $trangthai="Đang giao hàng";

    if($loaihoadon == 'xuất'){
        foreach($_POST['sanpham'] as [$tensanpham,$idsanpham,$gia,$soluong,$donvi]){
            $islinkedsql = "select * from sanpham where idsanpham=$idsanpham";
            $queryresult = mysqli_query($link,$islinkedsql);
            $result = mysqli_fetch_array($queryresult);
            if(mysqli_num_rows($queryresult) == 0){
                echo "<script>
                alert('Thêm hóa đơn xuất kho thất bại! Dữ liệu sản phẩm này bị lỗi.');
                </script>";
                $isValidated = false;
                break;
            }
            if($soluong > $result['soluong']){
                echo "<script>
                alert('Thêm hóa đơn xuất kho thất bại! Số lượng xuất kho \'".$soluong."\' của sản phẩm \'".$tensanpham."\' vượt qua số lượng có trong kho \'".$result['soluong']."\'.');
                </script>";
                $isValidated = false;
                break;
            }
        }
    } else if($loaihoadon == 'nhập'){
        foreach($_POST['sanpham'] as [$tensanpham,$idsanpham,$gia,$soluong,$donvi]){
            if($tensanpham != ""){
                if($idsanpham == '' || $tensanpham == '' || $gia == ''|| $soluong == ''|| $donvi == ''){
                    echo "<script>
                    alert('Thêm hóa đơn xuất kho thất bại! Sản phẩm \'".$tensanpham."\' không có đủ dữ liệu, vui lòng điền đầy đủ thông tin.');
                    window.history.back(-2);
                    </script>";
                    $isValidated = false;
                    break;
                }
            }
        }
    }

    if($isValidated){
	    $isAddedSuccess = mysqli_query($link,"INSERT INTO hoadonnhapxuatkho VALUES('', '$tendoitac', '$dienthoai','$email','$diachinhapkho','$diachixuatkho','$ngaynhapxuat','$loaihoadon','$trangthai') ");

        if($isAddedSuccess && $loaihoadon == "nhập"){
            $idhoadonnhapxuatkho=mysqli_insert_id($link);
            foreach($_POST['sanpham'] as [$tensanpham,$idsanpham,$gia,$soluong,$donvi]){
                if($tensanpham != ""){
                    if($idkhohang = mysqli_fetch_array(mysqli_query($link,"select idkhohang from khohang where diachikhohang LIKE '%$diachinhapkho%'")));
                    $ngay=date("Y").":".date("m").":".date("d").":".date("H").":".date("i").":".date("s");
                    $sql1 ="insert into chitiethoadonnhapxuatkho values('','$idhoadonnhapxuatkho','$idsanpham','$tensanpham','$soluong','$donvi','$gia')";
                    $isAddedSuccess = mysqli_query($link,$sql1);
                    $sql2 ="insert into sanpham values('','$tensanpham','','','','' ,'','','$soluong','0','$gia', '', '', '' , '' , '$ngay','0','$idhoadonnhapxuatkho','$idkhohang')";
                    $isAddedSuccess = mysqli_query($link,$sql2);
                }
            }   
        } else if($isAddedSuccess && $loaihoadon == 'xuất'){
            $idhoadonnhapxuatkho=mysqli_insert_id($link);
            if($isValidated){
                foreach($_POST['sanpham'] as [$tensanpham,$idsanpham,$gia,$soluong,$donvi]){
                    $ngay=date("Y").":".date("m").":".date("d").":".date("H").":".date("i").":".date("s");
                    $sql1 ="insert into chitiethoadonnhapxuatkho values('','$idhoadonnhapxuatkho','$idsanpham','$tensanpham','$soluong','$donvi','$gia')";
                    $isAddedSuccess = mysqli_query($link,$sql1);
                    $sql2 ="UPDATE `sanpham` SET `soluong` = '".($result['soluong'] - $soluong)."' WHERE `sanpham`.`idsanpham` = $idsanpham;";
                    $isAddedSuccess = mysqli_query($link,$sql2);
                }
            }
        } else {
            $isAddedSuccess = false;
        }

        if($isAddedSuccess) {
            echo "<script>
                    alert('Thêm hóa đơn ".$loaihoadon." kho thành công!');
                </script>";
        }
        else {
            echo "<script>
                    alert('".$alert."')
                    alert('Thêm hóa đơn thất bại! Vui lòng kiểm tra lại dữ liệu nhập.');
                </script>";
        }
    }
} 
/****************************************/
// PHẦN HÀM XÓA HÓA ĐƠN NHẬP XUẤT KHO
/****************************************/
else if (isset($_GET['submit-xoahoadonnhapxuatkho'])){
    $idhoadonnhapxuatkho = $_GET['submit-xoahoadonnhapxuatkho'];
    $delete1 = "delete from hoadonnhapxuatkho where idhoadonnhapxuatkho='".$idhoadonnhapxuatkho."'";
    $result = mysqli_query($link,$delete1);
    $delete2 = "delete from chitiethoadonnhapxuatkho where idhoadonnhapxuatkho='".$idhoadonnhapxuatkho."'";
    if ($result && mysqli_query($link,$delete2)){
        echo "<script>
        alert('Xóa hóa đơn nhập xuất id: \'".$idhoadonnhapxuatkho."\' thành công.');
        window.open('admin.php?admin=nhapxuatkhohang','_self', 1);
        </script>";
    }
} 
/****************************************/
// PHẦN HÀM THAY ĐỔI TRẠNG THÁI HÓA ĐƠN NHẬP XUẤT KHO
/****************************************/
else if (isset($_POST['dagiaohang']) || isset($_POST['dabihuy'])){
    if(isset($_POST['idhoadonhapxuat'])){
        foreach($_POST['idhoadonhapxuat'] as $idhoadonnhapxuatkho){
            $_SESSION['idhoadonhapxuat'][$idhoadonnhapxuatkho]=1;
        }

        if(isset($_POST['dagiaohang'])){
            foreach($_SESSION['idhoadonhapxuat'] as $idhoadonnhapxuatkho=>$value){
            if ($value==1)
            $sql="update hoadonnhapxuatkho set trangthai='Đơn hàng đã giao' where idhoadonnhapxuatkho='$idhoadonnhapxuatkho'";
                mysqli_query($link,$sql);
                unset($_SESSION['idhoadonhapxuat']);
                echo "
                    <script language='javascript'>
                        alert('Đã chuyển sang trạng thái giao hàng');
                        window.open('admin.php?admin=nhapxuatkhohang','_self', 1);
                    </script>";
            }
        } else if(isset($_POST['dabihuy'])){ 
            foreach($_SESSION['idhoadonhapxuat'] as $idhoadonnhapxuatkho=>$value){
                if ($value==1)
                $sql="update hoadonnhapxuatkho set trangthai='Đơn hàng bị hủy' where idhoadonnhapxuatkho='$idhoadonnhapxuatkho'";
                mysqli_query($link,$sql);
                unset($_SESSION['idhoadonhapxuat']);
                echo "
                    <script language='javascript'>
                        alert('Đã chuyển sang trạng thái huỷ đơn hàng');
                        window.open('admin.php?admin=nhapxuatkhohang','_self', 1);
                    </script>";
            }
        } 
    } else echo "
        <script language='javascript'>
            alert('Bạn chưa chọn hóa đơn cần xử lý');
            window.open('admin.php?admin=nhapxuatkhohang','_self', 1);
        </script>";
}
/****************************************/
// PHẦN HÀM TẠO FORM THÊM HÓA ĐƠN NHẬP / XUẤT
/****************************************/
?>

<form class="formxulynhapxuat" action="" method="post" enctype="multipart/form-data" name="frm" onsubmit="return kiemtrahoadonnhapxuat()">
    <div class="add__sp">
		<div class="title__hdkh">
			<div colspan=2>Thêm hóa đơn <?php $loaihoadon = 'nhập'; if(isset($_GET['nhapxuat']))  if($_GET['nhapxuat']=='nhap') echo $loaihoadon = 'nhập'; else echo $loaihoadon = 'xuất';?> kho</div>
		</div>
        <div class="form-row mb-3">
            <div class="col-md-6">
                <label for="doitac">Đối tác: </label>
                <input class="form-control col-sm-4" type="text" name="doitac" required/>
            </div>
            <div class="col-md-6">
                <label for="dienthoai" style="display: grid"> điện thoại liên lạc: </label>
                <input class="form-control col-sm-4" type="text" name="dienthoai" required/>
            </div>
        </div>
        <div class="form-row mb-3">
            <div class="col-md-6">
                <label for="email" style="display: grid"> email: </label>
                <input class="form-control col-sm-4" type="text" name="email" required/>
            </div>
            <div class="col-md-6">
                <label for="ngaynhapxuat">Ngày nhập / xuất: </label>			
                <input class="form-control col-sm-4" type="date" name="ngaynhapxuat" required/>
            </div>
            
        </div>
        <div class="form-row mb-3">
            <div class="col-md-6">
				<label for="diachinhapkho">Địa chỉ nhập kho: </label>
                <br />	
                <?php if($_GET['nhapxuat']=='nhap') {?>
                    <select class="custom-select " style="width: 190px;" name="diachinhapkho" required>
                        <option value="">Chọn địa chỉ kho hàng</option>
                        <?php
                            $show = mysqli_query($link,"SELECT * FROM khohang");
                            while($show1 = mysqli_fetch_array($show))
                            {
                                $tenkhohang = $show1['tenkhohang'];
                                $diachikhohang = $show1['diachikhohang'];
                                echo "<option value='".$diachikhohang."'> - (".$tenkhohang.") Địa chỉ: ".$diachikhohang."</option>";
                            }
                        ?>
				    </select>
                <?php } else {?>		
                <input class="form-control col-sm-4" type="text" name="diachinhapkho" required/>
                <?php } ?>
			</div>
            <div class="col-md-6">
                <label for="diachixuatkho">Địa chỉ xuất kho: </label>
                <br />
                <?php if($_GET['nhapxuat']=='xuat') {?>
                    <select class="custom-select mr-sm-2" style="width: 190px;" name="diachixuatkho" required>
                        <option value="">Chọn địa chỉ kho hàng</option>
                        <?php
                            $show = mysqli_query($link,"SELECT * FROM khohang");
                            while($show1 = mysqli_fetch_array($show))
                            {
                                $tenkhohang = $show1['tenkhohang'];
                                $diachikhohang = $show1['diachikhohang'];
                                echo "<option value='".$diachikhohang."'> - (".$tenkhohang.") Địa chỉ: ".$diachikhohang."</option>";
                            }
                        ?>
				    </select>
                <?php } else {?>
                <input class="form-control col-sm-4" type="text" name="diachixuatkho" required/>
                <?php } ?>
            </div>
        </div>

        <table>
            <thead>
                <tr class='tieude_hienthi_sp'>
                    <th>stt</th>
                    <th style="width: 130px;">Tên sản phẩm</th>
                    <th style="width: 100px;">Mã sản phẩm</th>
                    <th style="width: 90px;">Đơn giá</th>
                    <th style="width: 140px;">Số lượng</th>
                    <th style="width: 90px;">Đơn vị</th>
                </tr>
            </thead>
            <?php if(isset($_GET['nhapxuat']) && $_GET['nhapxuat']=='nhap'){ ?>
            <tbody id="inputfield">
                <?php
                $count = 0;
                while($count < 10){
                echo "<tr class='noidung_hienthi_sp'>";
                    echo "<td class='masp_hienthi_sp'>".($count+1)."</td>";
                    echo "<td class='stt_hienthi_sp'><input type='text' name='sanpham[$count][]'></td>";
                    echo "<td class='masp_hienthi_sp'><input type='text' name='sanpham[$count][]'></td>";
                    echo "<td class='sl_hienthi_sp'><input type='text' name='sanpham[$count][]'></td>";
                    echo "<td class='sl_hienthi_sp'><input type='text' name='sanpham[$count][]'></td>";
                    echo "<td class='sl_hienthi_sp'><input type='text' name='sanpham[$count][]'></td>";
                echo "</tr>";
                $count++;
                }
                ?>
            </tbody>
        </table>
        <div id='replaceButton' style="color: #fff;">
            <a class='btn btn-primary' onclick='additionData("<?php echo $count++; ?>")'>Thêm dòng dữ liệu</a>
        </div>
		</div>
        <?php } else { ?>
            <tbody id="inputfield">
            </tbody>
        </table>
        <div id='replaceButton'><input type="text" class="form-control" id="timkiem-sanphamtonkho" name="timkiem" placeholder="Nhập id hóa đơn" onkeyup="livesreachxuatkho(this.value,0)"></div>
        <div id='livesreach-sanphamtonkho'></div>
		</div>   
        <?php }?>
		<div class="form-group row" style="margin-top: 2rem;"> 
            <input class="btn btn-primary" style="margin:auto;" type="hidden" name="loaihoadon" value="<?php echo $loaihoadon;?>" />
			<input class="btn btn-primary" style="margin:auto;" type="submit" name="submit-themhoadonnhapxuat" value="Thêm phiếu <?php echo $loaihoadon;?>" />
			<input class="btn btn-danger" style="margin:auto; margin-right: 10rem" type="reset" name="" value="Về mặc định" />
		</div>
	</div>
</form>