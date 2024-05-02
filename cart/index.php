<?php

   if(isset($_GET['idsanpham']))
    $idsanpham=$_GET['idsanpham'];
    else $idsanpham=0;

   if(!isset($_POST['soluongmua']))
   {
        $_POST['soluongmua']=1;
   }

   switch($action){
    
    case "xoa":
    unset ($_SESSION['cart']);
	echo "<script language='javascript'>
		alert('Đã xóa toàn bộ trong giỏ hàng');
		</script>";
    break;

    case"check":
    include('check.php');
    break;

    case"thanhtoan":
    include('ttkh.php');
    break;

    case"insert":
    include('insert.php');
    break;

    case"add":
        $sql="select soluong from sanpham where idsanpham=$idsanpham";
        $result=mysqli_query($link,$sql);
        $row=mysqli_fetch_array($result);

        if($row['soluong'] < $_POST['soluongmua'])
        {
            echo "<script language='javascript'>
                alert('Sản phẩm này tạm thời hết hàng, mời bạn chọn mua sản phẩm khác hoặc quay lại đợt sau !');
                history.back(); 
                history.go(-1);
                </script>";
    
        } elseif($_POST['soluongmua'] <= 0) {
            echo '<script language="javascript">
                alert("Số lương mua không hợp lệ");
                history.back(); 
                history.go(-1);
                </script>';
        } else {
            
            if(isset($_SESSION['cart'][$idsanpham])){
                $_SESSION['cart'][$idsanpham]+=$_POST['soluongmua'];
            } else {
                $_SESSION['cart'][$idsanpham]=$_POST['soluongmua'];
            }
    
            echo '<script language="javascript">
                alert("Sản phẩm đã được thêm vào giỏ hàng của bạn");
                history.back(); 
                history.go(-1);
                </script>';
        }
    break;

    case"addcart":
   // foreach($_POST['idsanpham'] as $idsanpham)
    $sql="select soluong from sanpham where idsanpham=$idsanpham";
    $rows=mysqli_query($link,$sql);
    $row=mysqli_fetch_array($rows);
    if($row['soluong']==0)
    {
        echo '<script language="javascript">
    alert("Sản phẩm này tạm thời hết hàng mời bạn chọn mua sản phẩm khác hoặc quay lại đợt sau");
    history.back(); 
     history.go(-2);
    </script>';
    }
    else if($row['soluong']<$_SESSION['cart'][$idsanpham])
    {
        echo '<script language="javascript">
    alert("Sỗ lượng bạn đặt mua lớn hơn số hàng còn lại trong kho");
    history.back(); 
     history.go(-2);
    </script>';
    }
    else
    {
    $sl=$_POST['sl'];
  
    $_SESSION['cart'][$idsanpham]=$sl;
    echo '<script language="javascript">
    alert("Sản phẩm đã được thêm vào giỏ hàng của bạn");
    history.back(); 
     history.go(-2);
    </script>';
    }
    break;
      case "update": 
    if(isset($_POST['huy']))
    $sl=0;
    else
    $sl=$_POST['sl'];

	
    if($sl==0)
    unset ($_SESSION['cart'][$idsanpham]);
    else
    $_SESSION['cart'][$idsanpham]=$sl;
    echo '<script language="javascript">
    alert("cập nhật thành công");
     window.location.href="index.php?content=cart";
    </script>';
	
    break;
    default:
    include('viewcart.php');
    break;
     }
     ?>

