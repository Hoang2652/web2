<?php
	if(isset($_POST['id']))
	{
	foreach($_POST['id'] as $idhotro)
	{
		$_SESSION['id'][$idhotro]=1;
	}
	

		if(isset($_POST['giaohang']))
		{
			foreach($_SESSION['id'] as $idhotro=>$value)
			{
				if ($value==1)
				$sql="update hotro set trangthai=2 where idhotro='$idhotro'";
				mysqli_query($link,$sql);
				unset($_SESSION['id']);
				echo "
							<script language='javascript'>
								alert('Đã xử lý');
								window.open('admin.php?admin=hienthiht','_self', 1);
							</script>
						";
			}
		}
		else if(isset($_POST['huy']))
			{ 
				foreach($_SESSION['id'] as $idhotro=>$value)
				{
					if ($value==1)
					$sql="update hotro set trangthai=3 where idhotro='$idhotro'";
					mysqli_query($link,$sql);
					unset($_SESSION['id']);
					echo "
							<script language='javascript'>
								alert('Đã huỷ');
								window.open('admin.php?admin=hienthiht','_self', 1);
							</script>
						";
				}
			}
			else
					{
						foreach($_SESSION['id'] as $idhotro=>$value)
						{
							if ($value==1)
							$sql="delete from hotro where idhotro='$idhotro'";
							mysqli_query($link,$sql);
							unset($_SESSION['id']);
							echo "
							<script language='javascript'>
								alert('Xóa thành công');
								window.open('admin.php?admin=hienthiht','_self', 1);
							</script>
						";
						}
			
					}

			}		else echo "
							<script language='javascript'>
								alert('Bạn chưa chọn hỗ trợ cần xử lý');
								window.open('admin.php?admin=hienthiht','_self', 1);
							</script>
						";
		
?>