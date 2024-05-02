<?php
echo "<script>document.getElementById('content').innerHTML=''</script>";
echo "<script>document.getElementById('left-content').innerHTML=''</script>";
?>
<script language="javascript">
function kiemtra()
{
	var error=0;
	if(a.hoten.value=="")
	{
		document.getElementById('canhbaotenkhachhang').innerHTML="Bạn chưa điền tên";
		error++;
	}

	if(a.dienthoai.value=="")
	{
		document.getElementById('canhbaodienthoai').innerHTML="Bạn chưa điền số điện thoại";
		error++;
	}
	if(a.diachi.value=="")
	{
		document.getElementById('canhbaodiachi').innerHTML="Bạn chưa điền địa chỉ";
		error++;
	}

	if(a.email.value=="")
	{
		document.getElementById('canhbaoemail').innerHTML="Bạn chưa điền email";
		error++;
	}
	if(a.phuongthuc.value=="")
	{
		document.getElementById('canhbaophuongthuc').innerHTML="Bạn chưa chọn phương thức thanh toán";
		error++;
	}

	if(error!=0)
	{
		return false;
	}
}

</script>
<div class="thongtinkhachhang-wrap">
<div class="thongtinkhachhang">
<form action="index.php?content=cart&action=insert" method="POST" id="a" onsubmit="return kiemtra();" class="form__thanhtoan">
	<?php 
	if(isset($_SESSION['idnguoidung'])){
		$sql=mysqli_query($link,"select * from nguoidung where idnguoidung='".$_SESSION['idnguoidung']."'");
		$row=mysqli_fetch_array($sql);
	}
	?>
	<div class="form-group" style="width:100%; ">
		<h4 style="text-align:center; font-weight: bold;">THÔNG TIN THANH TOÁN</h4>
	</div>
	<div class="form-group">
		<label for="tennd">Họ và tên</label>
		<input type="text" class="form-control" name="hoten" value="<?php echo $row['tennguoidung'] ?>" onclick="document.getElementById('canhbaotenkhachhang').innerHTML=''" required/>
		<div class='canhbao' id='canhbaotenkhachhang'></div>
	</div>
	<div class="form-group">
		<label for="tennd">Địa chỉ giao hàng</label>
		<input type="text" class="form-control" name="diachi" value="<?php echo $row['diachi'] ?>" onclick="document.getElementById('canhbaodiachi').innerHTML=''" required/>
		<div class='canhbao' id='canhbaodiachi'></div>
	</div>
	<div class="form-group">
		<label for="exampleInputEmail1">Điện thoại</label>
		<input type="text" class="form-control" name="dienthoai" value="0<?php echo $row['dienthoai'] ?>" onclick="document.getElementById('canhbaodienthoai').innerHTML=''" required/>
		<div class='canhbao' id='canhbaodienthoai'></div>
	</div>
	<div class="form-group">
		<label for="exampleInputEmail1">Email</label>
		<input type="text" class="form-control" name="email" value="<?php echo $row['email'] ?>" onclick="document.getElementById('canhbaoemail').innerHTML=''" required/>
		<div class='canhbao' id='canhbaoemail'></div>
	</div>
	<div class="form-group pb-4">
		<label for="exampleInputEmail1">Phương thức</label>
			<select class="custom-select" name="phuongthuc" onclick="document.getElementById('canhbaophuongthuc').innerHTML=''" style="height: 35px;" required>
				<option value="">Chọn phương thức thanh toán</option>
				<option value="2">Chuyển khoản</option>
				<option value="3">Tiền mặt</option>
			</select>
		<div class='canhbao' id='canhbaophuongthuc'></div>
	</div>
	<div style="width: fit-content; margin: 0 auto;"><button class="btn btn-primary" type="submit" value="Đặt hàng">Xác nhận đặt hàng</button></div>
</form>

<div class="cart__thanhtoan">
<h4>WEBSITE BÁN ĐỒNG HỒ TRỰC TUYẾN PHONG HẤP</h4>
<ul style='text-align: left;'>
	<li>Địa chỉ: Đăng Văn Ngữ - Phú Nhuận - Thành phố Hồ Chí Minh</li>
	<li>Di Động: 0938909944</li>
	<li>Email: phonghap@gmail.com</li>
</ul>
<div class='' style="border-bottom: black 1px solid;"></div>
<table class=''>
    <thead>
        <tr class="tieudecart">
        <th scope='col' style="width: 350px;">Tên sản phẩm</th>
        <th scope='col'>Giá</th>
        <th scope='col'>Số lượng</th>
		<th scope='col'>Giảm giá</th>
        <th scope='col'>Thành tiền</th>
        </tr>
   </thead>
<?php

   $sql ="select * from sanpham where idsanpham in(";
        foreach($_SESSION['cart'] as $stt => $soluong)
            {
              if($soluong>0)
                $sql .= $stt.",";
            }
            if (substr($sql,-1,1)==',')
            {
                $sql = substr($sql,0,-1);
            }
      $sql .=' )order by idsanpham DESC';
      $rows=mysqli_query($link,$sql);
	  $tongtien = 0;
while($row=mysqli_fetch_array($rows))
{
    $price = $row['gia'];
	$pricebasic = $price;
    if($row['giamgia'] != ""){
        $price = $row['gia']*(1-$row['giamgia']/100);
    }
    if($row['quatang'] != ""){
        $rowtensanpham = mysqli_fetch_array(mysqli_query($link,"select tensanpham from sanpham where idsanpham=".$row['quatang']));
        $giftText = "Quà tặng: <a href='index.php?content=chitietsp&idsanpham=".$row['quatang']."'>".$rowtensanpham['tensanpham']."</a>";
    }
?>
 
    <tbody>
        <tr class="sanphamcart">
            <td><p class="carta" style="text-align: left;"><a href="index.php?content=chitietsp&idsanpham=<?php echo $row['idsanpham'] ?>"><?php echo $row['tensanpham']?></a></p></td>
            <td><?php echo number_format($pricebasic,0,",",".");?></td>
            <td><?php echo $_SESSION['cart'][$row['idsanpham']] ?></td>
			<?php if($row['giamgia'] != null){ ?>
                <td><?php echo $row['giamgia'].'%' ?></td>
            <?php }
            else{ ?>
                <td><?php echo '0%' ?></td>
            <?php } ?>
            <td><?php echo number_format($price*$_SESSION['cart'][$row['idsanpham']],0,",",".") ?></td>
        </tr>
        <?php 
        if(isset($discountText) || isset($giftText)){ ?>
        <tr class="quatangcart">
            <td colspan='6'>
            <?php 
            if(isset($giftText)){ 
                echo $giftText;
                unset($giftText);
            }
        ?>
            </td>
        </tr>
        <?php } ?>
        <?php $tongtien+=$_SESSION['cart'][$row['idsanpham']]*$price; ?>
        <?php
        }
        ?>
		<tr>
		<td colspan=5 align="center" style="border-bottom: black 1px solid;"></td>
		</tr>	
        <tr>
            <td colspan=5 align="right" style=" border-bottom: none; padding:20px 20px 10px 0px; font-size:17px;">
                Tổng cộng: <b><font color="red"><?php  echo number_format($tongtien,0,",",".") ?></font> VNĐ </b>
            </td>
            <td>
            </td>
        </tr>
    </tbody>
</table>
</div>
</div>
</div>