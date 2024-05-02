<script type="text/javascript" src="js/checkbox.js"></script>
<?php
	if(isset($_POST['id']))
	{
	foreach($_POST['id'] as $idhoadon)
	{
		$_SESSION['id'][$idhoadon]=1;
	}
	

		if(isset($_POST['giaohang']))
		{
			foreach($_SESSION['id'] as $idhoadon=>$value)
			{
				if ($value==1)
				$sql="update hoadon set trangthai=2 where idhoadon='$idhoadon'";
				mysqli_query($link,$sql);
				unset($_SESSION['id']);
				echo "
							<script language='javascript'>
								alert('Đã chuyển sang trạng thái giao hàng');
								window.open('admin.php?admin=hienthihd','_self', 1);
							</script>
						";
			}
		}
		else if(isset($_POST['huy']))
			{ 
				foreach($_SESSION['id'] as $idhoadon=>$value)
				{
					if ($value==1)
					$sql="update hoadon set trangthai=3 where idhoadon='$idhoadon'";
					mysqli_query($link,$sql);
					unset($_SESSION['id']);
					echo "
							<script language='javascript'>
								alert('Đã chuyển sang trạng thái huỷ đơn hàng');
								window.open('admin.php?admin=hienthihd','_self', 1);
							</script>
						";
				}
			}
			else
					{
						foreach($_SESSION['id'] as $idhoadon=>$value)
						{
							if ($value==1)
							$sql="delete from hoadon where idhoadon='$idhoadon'";
							mysqli_query($link,$sql);
							$sql1="delete from chitiethoadon where idhoadon='$idhoadon'";
							mysqli_query($link,$sql1);
							unset($_SESSION['id']);
							echo "
							<script language='javascript'>
								alert('Xóa thành công');
								window.open('admin.php?admin=hienthihd','_self', 1);
							</script>
						";
						}
			
					}

			}		else echo "
							<script language='javascript'>
								alert('Bạn chưa chọn hóa đơn cần xử lý');
								window.open('admin.php?admin=hienthihd','_self', 1);
							</script>
						";
		
?>