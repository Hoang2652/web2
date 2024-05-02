 
  <?php
    $loi=0;
    if(!isset($_SESSION['idnguoidung']))
	  {
		  echo("<script language='javascript'>
      alert('Bạn cần phải đăng nhập mới được tiếp tục thanh toán');
      history.back(); 
      history.go(-1);
      </script>");
	  } else {
     foreach($_SESSION['cart'] as $stt => $soluong)
            {
               
               $sql="select soluong,tensanpham,daban from sanpham where idsanpham=$stt";
               $rows=mysqli_query($link,$sql);
               $row=mysqli_fetch_array($rows);
               $sl=$_SESSION['cart'][$stt];
               if($row['soluong']==0 or $row['soluong']<$sl)
               {
               echo("<script language='javascript'>
               history.back(); 
               history.go(-2);
               alert ('Sản phẩm ". $row['tensanpham']. " đã hết hoặc không đủ số lượng trong kho');
               </script>");
               $loi+=1;
               }
            }
     if($loi==0)
      echo '<meta http-equiv="refresh" content="0;index.php?content=cart&action=thanhtoan">';
    }
            ?>