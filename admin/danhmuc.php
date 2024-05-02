<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php 
   if($_SESSION['phanquyen']!=0)
   {
		echo "
		<script language='javascript'>
		alert('Bạn không được ủy quyền để vào đây');
		window.open('admin.php','_self', 1);
		</script>";
		exit();
   }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Danh Mục</title>
<link rel="stylesheet" href="css/hienthi_sp.css" />
</head>
<?php
	include '../include/connect.php';
	$hienthi = mysqli_query($link,"SELECT * FROM danhmuc order by iddanhmuc DESC");
	$dem = mysqli_num_rows($hienthi);

	function getMota($a){
		$string = "...";
		$result = "";
		$array = explode(" ", $a);
		$length = count($array);
		if ( $length > 50 ) {
			for( $i = 50; $i < $length; $i++){
				unset($array[$i]);
			}
			$result = implode(" ", $array).$string;
		}
		else{
			$result = $a;
		}
		return $result;
	}
?>
<div class="quanlysp" style=" height: 130px;">
	<h3>QUẢN LÝ DANH MỤC</h3>
	
	<div class="live-search form-row">
		<div class="col-md-2 mb-3">
			<label><i class="fas fa-search"></i> Tìm kiếm danh mục</label>
			<input class="form-control" type="text" name="timkiem" placeholder="Nhập id hoặc tên..." onkeyup="timkiemtructiep(this.value,'danhmuc')">
		</div>
		<div class="col-md-2 mb-3">
			<button style="margin-top: 32px; border: none"><a href='?admin=themdm' class="btn btn-primary">Thêm danh mục</a></button>
		</div>
		<p style="float:right; margin-top: 45px;">Có tổng cộng: <font color=red><b><?php echo $dem ?></b></font> danh mục</p>
	</div>
</div>
<div class='scb content-table'>
	<table>
		<thead>
        <tr class="tieude_hienthi_sp">
        	<th>ID</th>
            <th> Tên phân loại</th>
            <th>Loại danh mục</th>
			<th style="width: 620px;">Mô tả</th>
            <th colspan=2>Chỉnh sửa</th>
        </tr>
		</thead>
		<tbody id="row-sanpham">
        <?php
			
			if($dem !="")
			{
				while($bien=mysqli_fetch_array($hienthi))
				{
				
		?>
                   <tr>
                   <td class="masp_hienthi_sp">
                    	<?php echo $bien['iddanhmuc'] ?>
                   </td>
                   <td class="tensp_hienthi_sp">
                    	<?php echo $bien['tendanhmuc'] ?>
                    </td>
                    <td class="masp_hienthi_sp">
                    <?php
						if($bien['loaidanhmuc'] == "LSP") {
							echo "Loại sản phẩm";
						}
						else if($bien['loaidanhmuc'] == "TH") {
							echo "Thương hiệu";
						} else {
							echo "*Chưa rõ*";
						}
						
					?>
                    </td>
					<td class="masp_hienthi_sp">
						<?php 
							$mota = $bien['mota'];
							echo  getMota($mota);
						?>
					</td>
                    <td class="active_hienthi_sp">
						<a href="?admin=suadm&iddanhmuc=<?php echo $bien['iddanhmuc']?>"><i class="fas fa-tools" style="transform: scale(1.5); color: #007bff;"></i></a>
						<a><button type="submit" onclick="checkdeldanhmuc(<?php echo $bien['iddanhmuc']?>)"><i class="fas fa-trash-alt" style="transform: scale(1.5); color: red;"></i></button></a>
                   </td>
           
           
        <?php  
				}
			}
			else
				{
					echo "<tr><td colspan='5'>Không có danh mục nào </td></tr>";
				}
			
		?>
		</tbody>
    </table>
			</div>
<body>
</body>
</html>