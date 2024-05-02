
 <div class="cart">
    <div class="tabs">
        <div class="cart__title"> Giỏ hàng của bạn</div>
    </div>
 <?php
  
    if(isset($_SESSION['cart']))
    $count=count($_SESSION['cart']);
    else $count=0;
    $tongtien=0;
    if($count==0)
    echo "<div id='thongbaokhongco'>Chưa có sản phẩm nào được thêm vào giỏ hàng !</div>";
    else
   {
    ?>
   
<table class='table table__cart'>
    <thead>
        <tr class="tieudecart">
        <th scope='col' style="width: 350px;">Tên sản phẩm</th>
        <th scope='col'>Giá</th>
        <th scope='col'>Số lượng</th>
        <th scope='col'>Giảm giá</th>
        <th scope='col'>Thành tiền</th>
        <th scope='col'>Tùy chọn</th>
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
while($row=mysqli_fetch_array($rows))
{
    $price = $row['gia'];
    $pricebasic = $price;
    if($row['giamgia'] != ""){
        $price = $row['gia']*(1-$row['giamgia']/100);
    }
    if($row['quatang'] != ""){
        $rowtensanpham = mysqli_fetch_array(mysqli_query($link,"select tensanpham from sanpham where idsanpham=".$row['quatang']));
        $giftText = "Quà tặng: ".$rowtensanpham['tensanpham'];
    }
?>
 
    <tbody>
        <tr class="sanphamcart">
            <td><p class="carta"><a href="index.php?content=chitietsp&idsanpham=<?php echo $row['idsanpham'] ?>"><?php echo $row['tensanpham']?></a></p></td>
            <td><?php echo number_format($pricebasic,0,",",".");?></td>
            <td><?php echo $_SESSION['cart'][$row['idsanpham']] ?></td>
            <?php if($row['giamgia'] != null){ ?>
                <td><?php echo $row['giamgia'].'%' ?></td>
            <?php }
            else{ ?>
                <td><?php echo '0%' ?></td>
            <?php } ?>
            <td><?php echo number_format($price*$_SESSION['cart'][$row['idsanpham']],0,",",".") ?></td>
            <form action="index.php?content=cart&action=update&idsanpham=<?php echo $row['idsanpham']?>" method="POST" name="update">
                <td><p class="xoa"><input type="submit" name="huy" value="Xóa" class="btn btn-danger"/></p></td>
            </form>
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
            <td colspan=5 align="right" style=" border-bottom: none; padding:20px 20px 10px 0px; font-size:17px;">
                Tổng cộng: <b><font color="red"><?php  echo number_format($tongtien,0,",",".") ?></font> VNĐ </b>
            </td>
            <td>
            <a href="index.php?content=cart&action=xoa"><button class="btn btn-danger">Xóa toàn bộ</button></a>
            </td>
        </tr>
    </tbody>
</table>
<div class="tieptucmuahang">
	<a href="index.php">
        <button class="btn btn-primary" style="margin: auto">
        <i class="fas fa-cart-arrow-down"></i> Mua hàng tiếp
        </button>
    </a>
    <a href="index.php?content=cart&action=check">
        <button class="btn btn-success" style="margin: auto; margin-left: 3rem">
            <i class="fas fa-dollar-sign"></i> Thanh toán
        </button>
    </a>
</div>
<?php
}
?>
</div>
<script language='javascript'>
if()
</script>