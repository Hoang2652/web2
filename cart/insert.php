
<?php
if($action="insert")
{
$hoten=$_POST['hoten'];
$dienthoai=$_POST['dienthoai'];
$diachi=$_POST['diachi'];
$email=$_POST['email'];
$phuongthuc=$_POST['phuongthuc'];
$ngay=date('Y-m-d');
		if(isset($_SESSION['idnguoidung'])){
		
		
			$sql=mysqli_query($link,"select * from nguoidung where idnguoidung='".$_SESSION['idnguoidung']."'");
			$row=mysqli_fetch_array($sql);
			
			$idnguoidung=$row['idnguoidung'];
	
$sql="INSERT INTO hoadon(idnguoidung,hoten,diachi,dienthoai,email,ngaydathang,phuongthucthanhtoan,trangthai) VALUES ('$idnguoidung','$hoten', '$diachi', '$dienthoai', '$email', '$ngay', '$phuongthuc','1')";
} else 
$sql="INSERT INTO hoadon(hoten,diachi,dienthoai,email,ngaydathang,phuongthucthanhtoan,trangthai) VALUES ('$hoten', '$diachi', '$dienthoai', '$email', '$ngay', '$phuongthuc','1')";

	mysqli_query($link,$sql);
	
    $idhoadon=mysqli_insert_id($link);
	
    foreach($_SESSION['cart'] as $stt => $soluong)
            {
               $sql="select * from sanpham where idsanpham=$stt";
               $rows=mysqli_query($link,$sql);
               $row=mysqli_fetch_array($rows);
               $gia = $row['gia'];
               $idsanpham=$row['idsanpham'];
               $tensanpham=$row['tensanpham'];
               $gia=$row['gia'];
               $giamgia=$row['giamgia'];
               $quatang=$row['quatang'];
               $soluongkhuyenmai=$row['soluongkhuyenmai'];
               if($soluongkhuyenmai >= $soluong){
                        $sql1 ="insert into chitiethoadon(idhoadon,idsanpham,tensanpham,gia,soluong,giamgia,quatang,idchitiethoadon) values('$idhoadon','$idsanpham','$tensanpham','$gia','$soluong','$giamgia','$quatang','')";
               } else if($soluongkhuyenmai < $soluong && $soluongkhuyenmai > 0){
                        $sql1 ="insert into chitiethoadon(idhoadon,idsanpham,tensanpham,gia,soluong,giamgia,quatang,idchitiethoadon) values('$idhoadon','$idsanpham','$tensanpham','$gia','$soluongkhuyenmai','$giamgia','$quatang','')";
                        $sql2 ="insert into chitiethoadon(idhoadon,idsanpham,tensanpham,gia,soluong,giamgia,quatang,idchitiethoadon) values('$idhoadon','$idsanpham','$tensanpham','$gia','".($soluong - $soluongkhuyenmai)."',NULL,NULL,'')";
                        mysqli_query($link,$sql2);
               } else {
                $sql1 ="insert into chitiethoadon(idhoadon,idsanpham,tensanpham,gia,soluong,giamgia,quatang,idchitiethoadon) values('$idhoadon','$idsanpham','$tensanpham','$gia','$soluong',NULL,NULL,'')";
               }
               mysqli_query($link,$sql1);
              
            }
    foreach($_SESSION['cart'] as $stt => $soluong)
            {
               
               $sql="select * from sanpham where idsanpham=$stt";
               $rows=mysqli_query($link,$sql);
               $row=mysqli_fetch_array($rows);
               $ban=$row['daban']+$soluong;
               $soluongconlai = $row['soluong'] - $soluong;
               if($row['soluongkhuyenmai'] - $soluong >= 0)
                        $soluongkhuyenmaiconlai = $row['soluongkhuyenmai'] - $soluong;
                else
                        $soluongkhuyenmaiconlai = 0; 
               $sql="UPDATE sanpham SET daban='$ban',
                                        soluong='$soluongconlai',
                                        soluongkhuyenmai='$soluongkhuyenmaiconlai'
                                   WHERE idsanpham=$stt";
                mysqli_query($link,$sql);
            }

unset($_SESSION['cart']);
}
if($rows)
        echo "
        <script language='javascript'>
        alert('Đơn hàng của bạn đã thiết lập thành công, chúng tôi sẽ liên hệ với bạn sớm nhất');
        window.open('index.php','_self',3);
        </script>
        ";
else {
        echo"
        <script language='javascript'>
        alert('Thiết lập đơn hàng thất bại');
        window.open('index.php','_self',3);
        </script>";
}
?>
