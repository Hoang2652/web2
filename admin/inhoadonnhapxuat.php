<?php
session_start();
include("../include/connect.php");
include("function/function.php");
$idhoadonnhapxuatkho=$_GET['idhoadonnhapxuatkho'];
$sql1="select * from hoadonnhapxuatkho where idhoadonnhapxuatkho='$idhoadonnhapxuatkho'";
$rows1=mysqli_query($link,$sql1);
$row1=mysqli_fetch_array($rows1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hóa Đơn Nhập xuất</title></head>
<body onLoad="window.print()">
<div id="wrapper" style="margin:0 auto; width:700px;">
<table width="100%">
                <!--DWLayoutTable-->
                <tr>
                  <td height="25" valign="top"align="center"><div align="left">
                    <table width="100%">
                      <tbody>
                        <tr>
                          <td width="5" height="95">&nbsp;</td>
                       
                          <td width="343"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tbody>
                                <tr>
                                  <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                                      <tbody>
                                        <tr>
                                          <td colspan="2"><strong>CỦA HÀNG BÁN ĐỒNG HỒ TRỰC TUYẾN PHONG HẤP</strong></td>
                                        </tr>
                                        <tr>
                                          <td>Địa chỉ</td>
                                          <td>: Đăng Văn Ngữ - Phú Nhuận - Thành phố Hồ Chí Minh</td>
                                        </tr>
                                        <tr>
                                          <td>Di Động </td>
                                          <td>: 0938909944</td>
                                        </tr>
                                        <tr>
                                          <td>Email</td>
                                          <td>:hieutran@gmail.com</td>
                                        </tr>
                                      </tbody>
                                  </table></td>
                                </tr>
                              </tbody>
                          </table></td>
                        </tr>
                      </tbody>
                    </table>
                  </div></td>
                </tr>
  <tr>
                  <td width="562" height="25" valign="top"align="center">  <hr>
                    <strong><font color="#FF0000" size="+2">HÓA ĐƠN <?php if($row1['loaihoadon'] == "nhập") echo "NHẬP"; else echo"XUẤT"; ?> KHO</font></strong></td>
  </tr>
                <tr>
                  <td height="54"  >                    
                      <div align="left">
                        <b>Thông tin Khách hàng:</b>                    </div>
              <table width="100%" >
                            <tr>
                              <td width="3%" >&nbsp;</td>
                              <td width="34%" >Đối tác:</td>
                              <td width="63%" ><?php echo $row1['tendoitac'];?></td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
                              <td >Địa chỉ nhập kho:</td>
                              <td ><?php echo $row1['diachinhapkho'];?></td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
                              <td >Địa chỉ xuất kho:</td>
                              <td >   0<?php echo $row1['diachixuatkho'];?></td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
                              <td >Điện thoại :</td>
                              <td >   0<?php echo $row1['dienthoai'];?></td>
                            </tr>
                          
                            <tr>
                              <td>&nbsp;</td>
                              <td>Email : </td>
                              <td >    <?php echo $row1['email'];?> </td>
                            </tr>

                            <tr>
                              <td >&nbsp;</td>
                              <td >Ngày <?php echo $row1['loaihoadon']; ?> kho:</td>
                                    
			
                              <td ><?php echo ngaythangnam($row1['ngaynhapxuat']);?></td>
                            </tr>
                    </table>
        <br />
                          <span class="style3"><B>Thông tin đơn hàng : </B></span>
                          <table width="100%" style="border-collapse:collapse;">
                            <tr>
                              <td bgcolor="#CCCCCC"  align="left" style="border:1px solid green;"><div align="center">STT</div></td>
                              <td bgcolor="#CCCCCC"  align="left" style="border:1px solid green; width: 400px;"><div align="center">Tên sản phẩm</div></td>
                              <td bgcolor="#CCCCCC"  align="left" style="border:1px solid green; width: 100px;"><div align="center">Mã sản phẩm</div></td>
                              <td bgcolor="#CCCCCC"  align="left" style="border:1px solid green; width: 70px;"><div align="center">Số lượng</div></td>
                              <td align="right" bgcolor="#CCCCCC"  align="left" style="border:1px solid green; width: 150px;"><div align="center">Đơn giá</div></td>
                              <td align="right" bgcolor="#CCCCCC"  align="left" style="border:1px solid green; width: 175px;"><div align="center">Thành tiền</div></td>
                            </tr>
                          <?php
   $stt=1;
	$tong=0;
	$sql="select * from chitiethoadonnhapxuatkho where idhoadonnhapxuatkho={$_GET['idhoadonnhapxuatkho']}";
	$rows=mysqli_query($link,$sql);
	while($row=mysqli_fetch_array($rows))
	{
		$thanhtien=$row['dongia']*$row['soluong'];
	$tong+=$thanhtien;
	
	?>
        <tr>
          <td align="left" style="border:1px solid green;"><?php echo  $stt++?></td>
          <td  align="left" style="border:1px solid green;"><div align="center"><?php echo $row['tensanpham'];?></div></td>
          <td align="center" align="left" style="border:1px solid green;"><?php echo $row['idsanpham'];?></td>
          <td align="center"  align="left" style="border:1px solid green;"><?php echo $row['soluong'];?></td>
          <td align="center" align="left" style="border:1px solid green;"><?php echo number_format($row['dongia'],"0",",",".")?> VNĐ</td>
          <td align="center" align="left" style="border:1px solid green;"><?php echo number_format($thanhtien,"0",",",".")?> VNĐ</td>
        </tr>
		<?php } ?>   
        <tr style="border:1px solid green;">
          <td colspan="99" align="left"><div align="right">Tổng giá trị đơn hàng: <?php echo number_format($tong,"0",",",".") ?> VNĐ</div></td>
        </tr>     
		
      </table>
		  
              <table width="100%" border="0" align="right">
                            <tr>
                              <td colspan="3"><div align="right"> Ngày <?php echo ngaythangnam($row1['ngaynhapxuat']);?></div></td>
                            </tr>
                            <tr>
                              <td><div align="center"><strong>Nhân viên Bán hàng</strong></div></td>
                              <td>&nbsp;</td>
                              <td><div align="center"><strong>Khách hàng</strong></div></td>
                            </tr>
                            <tr>
                              <td height="23"><div align="center">(Ký tên + Đóng dấu Công ty)</div></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td height="73">&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                           
                          </table>
                    <p>&nbsp;</p>
	                      <p><br>
                                      </p>
                    </td>
                </tr>
              </table>
</div>
</body>
</html>
