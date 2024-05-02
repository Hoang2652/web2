<?php
if(isset($_GET['admin']))
	switch($_GET['admin'])
	{
		case 'hienthisp':
			include ("sanpham.php");
			break;
		case 'themsp':
			include ("them_sanpham.php");
			break;
		case 'suasp':
			include ("sua_sanpham.php");
			break;
		case 'xoasp':
			include ("xoa_sanpham.php");
			break;
		case 'hienthidm':
			include ("danhmuc.php");
			break;
		case 'themdm':
			include ("them_danhmuc.php");
			break;
		case 'suadm':
			include ("sua_danhmuc.php");
			break;
		case 'xoadm':
			include ("xoa_danhmuc.php");
			break;
		case 'hienthitt':
			include ("tintuc.php");
			break;
		case 'themtt':
			include ("them_tintuc.php");
			break;
		case 'suatt':
			include ("sua_tintuc.php");
			break;
		case 'hienthind':
			include ("nguoidung.php");
			break;
		case 'themnd':
			include ("them_nguoidung.php");
			break;
		case 'suand':
			include ("sua_nguoidung.php");
			break;
		case 'xoand':
			include ("xoa_nguoidung.php");
			break;
		case 'xulyhd':
			include ("xulyhd.php");
			break;
		case 'hienthiht':
			include ("hotro.php");
			break;
		case 'hienthihd':
			include ("hoadon.php");
			break;
		case 'chitiethoadon':
			include ("chitiethoadon.php");
			break;
		case 'hienthithongkedanhthu':
			include ("thongkedoanhthu.php");
			break;
		case 'xoahd':
			include ("xoa_hoadon.php");
			break;
		case 'xulyht':
			include ("xulyht.php");
			break;
		case 'xulysp':
			include ("xulysp.php");
			break;
		case 'xulytt':
			include ("xulytt.php");
			break;
		case 'cauhoithuonggap':
			include ("cauhoithuonggap.php");
			break;
		case 'hienthiqlkh':
			include ("quanlykhohang.php");
			break;
		case 'nhapxuatkhohang':
			include ("nhapxuatkhohang.php");
			break;
		case 'xulynhapxuatkhohang':
			include ("xulynhapxuatkhohang.php");
			break;
		case 'chitiethoadonnhapxuatkho':
			include ("chitiethoadonnhapxuatkho.php");
			break;
		case 'hangtonkho':
			include ("hangtonkho.php");
			break;
		case 'xulykhohang':
			include ("xulykhohang.php");
			break;
		case 'xulyhangtonkho':
			include ("xulyhangtonkho.php");
			break;
		case 'hienthitc':
			include ("quanlytrangchu.php");
			break;
		case 'xulythongke':
			include ("xulythongke.php");
			break;
		default:
			include ("admin.php");
			break;
	}
	else 
	{
	?>
		<div id="admincon">
			
			<div id="sanphammoi">
				<div class='sanphammoitheongay'>Đơn hàng cần được xử lý</div>
				<div class="scb" style="border-radius: 10px; box-shadow: 0 8px 20px rgb(35 0 77 / 20%); overflow: auto; height: 500px">
					<table class="table" style=" border: 1px solid hsl(0, 0%, 80%); background-color: #fff; margin: 0">
					<?php $ngay=date('Y-m-d'); ?>
						<thead class="tieudespmoi">
							<th>STT</th>
							<th>Họ tên</th>
							<th>Địa chỉ</th>
							<th>Điện thoại</th>
							<th>Ngày đặt hàng</th>
						</thead>
						<tbody>
						<?php 
							$i=1;
							$sql=mysqli_query($link,"select * from hoadon where trangthai='1'");
							while($row=mysqli_fetch_array($sql))
							{
						
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $row['hoten'] ?></td>
							<td><?php echo $row['diachi'] ?></td>
							<td><?php echo $row['dienthoai'] ?></td>
							<td><?php echo ngaythangnam($row['ngaydathang']) ?></td>
						</tr>
					<?php } ?>
					</tbody>
					</table>
				</div>
				<div style="padding: 20px; height: 5rem; text-align: center; margin-bottom: 5rem;"><a href="admin.php?admin=hienthihd" class="btn btn-primary" style="padding: 0.725rem 2.5rem; border-radius: 0.5rem;">Chi tiết</a></div>
			</div>
		</div>
	<?php 
	}

?>