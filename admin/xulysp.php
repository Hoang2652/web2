<?php
	if(isset($_POST['id']))
	{
	foreach($_POST['id'] as $idsanpham)
	{
		$_SESSION['id'][$idsanpham]=1;
	}
	

		if(isset($_POST['giaohang']))
		{
			foreach($_SESSION['id'] as $idsanpham=>$value)
			{
				if ($value==1)
				$sql="update hoadon set trangthai=2 where idsanpham='$idsanpham'";
				mysqli_query($link,$sql);
				unset($_SESSION['id']);
				echo "
							<script language='javascript'>
								alert('Đã giao hàng');
								window.open('admin.php?admin=hienthisp','_self', 1);
							</script>
						";
			}
		}
		else if(isset($_POST['huy']))
			{ 
				foreach($_SESSION['id'] as $idsanpham=>$value)
				{
					if ($value==1)
					$sql="update hoadon set trangthai=3 where idsanpham='$idsanpham'";
					mysqli_query($link,$sql);
					unset($_SESSION['id']);
					echo "
							<script language='javascript'>
								alert('Đã huỷ đơn hàng');
								window.open('admin.php?admin=hienthisp','_self', 1);
							</script>
						";
				}
			}
			else
					{
						foreach($_SESSION['id'] as $idsanpham=>$value)
						{
							$result = mysqli_query($link,"select trangthai from sanpham where idsanpham='".$idsanpham."'");
							$row =  mysqli_fetch_array($result);

							if ($row['trangthai']==1){
							$sql1="update sanpham set trangthai='0' where idsanpham='$idsanpham'";
							mysqli_query($link,$sql1);
							unset($_SESSION['id']);
							echo "
								<script language='javascript'>
									alert('Ẩn sản phẩm thành công');
									window.open('admin.php?admin=hienthisp','_self', 1);
								</script>
								";
							} else if ($row['trangthai']==0) {
								$check=mysqli_fetch_array(mysqli_query($link,"select * from sanpham where idsanpham='$idsanpham'"));
								if($check['loaisanpham'] != "" && $check['tensanpham'] != "" && $check['loaisanpham'] != "" && $check['mota'] != "" && $check['xuatxu'] != "" && $check['baohanh'] != "" && $check['chitiet'] != "" && $check['iddanhmuc'] != ""){
								$sql1="update sanpham set trangthai='1' where idsanpham='$idsanpham'";
								mysqli_query($link,$sql1);
								unset($_SESSION['id']);
								echo "
									<script language='javascript'>
										alert('Mở bán sản phẩm thành công');
										window.history.go(-1);
									</script>
									";
								} else {
									echo "
									<script language='javascript'>
										alert('Mở bán thất bại:  sản phẩm chưa đủ dữ liệu để mở bán, vui lòng điền đầy đủ dữ liệu');
										window.history.go(-1);
									</script>
									";
								}
							}
						}
			
					}

			}		else echo "
							<script language='javascript'>
								alert('Bạn chưa chọn sản phẩm cần xử lý');
								window.open('admin.php?admin=hienthisp','_self', 1);
							</script>
						";
		
?>