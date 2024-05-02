<link rel="stylesheet" href="css/hienthi_sp.css">
<script type="text/javascript" src="js/checkbox.js"></script>
<?php
	include ('../include/connect.php');
	
    $select = "select * from tintuc ";
    $query = mysqli_query($link,$select);
    $dem = mysqli_num_rows($query);

	function getNoidung($a){
		$string = "...";
		$result = "";
		$array = explode(" ", $a);
		$length = count($array);
		if ( $length > 30 ) {
			for( $i = 30; $i < $length; $i++){
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
<form action="admin.php?admin=xulytt" method="post">
<div class="quanlytintuc">
	<h3 class="title__tintuc">QUẢN LÝ TIN TỨC</h3>
	<div class="tacvu__tintuc">
		<a href='?admin=themtt' class="btn btn-primary">Thêm tin tức</a>
		<div id="check">
			<p>
				<input type="submit" name="xoa" value="Xóa tin tức" class="btn btn-danger"/>
			</p>
		</div>
		<p class="sum-tintuc">Có tổng <font color=red><b><?php echo $dem ?></b></font> tin tức</p>
	</div>
</div>

	<div class="content-table">
		<table>
			<thead>
				<tr class='tieude_hienthi_sp tieude-tintuc'>
					<th width="30"><input type="checkbox" name="check"  class="checkbox" onclick="checkall('item', this)"></th>
					<th>ID</th>
					<th>Tiêu đề</th>
					<th>Nội dung ngắn</th>
					<th>Hình ảnh</th>
					<th>Tác giả</th>
					<th>Active</th>
				</tr>
			</thead>

		<?php
		
		/*------------Phan trang------------- */
			// Nếu đã có sẵn số thứ tự của trang thì giữ nguyên (ở đây tôi dùng biến $page) 
			// nếu chưa có, đặt mặc định là 1!   

			if(!isset($_GET['page'])){  
			$page = 1;  
			} else {  
			$page = $_GET['page'];  
			}  

			// Chọn số kết quả trả về trong mỗi trang mặc định là 10 
			$max_results = 10;  

			// Tính số thứ tự giá trị trả về của đầu trang hiện tại 
			$from = (($page * $max_results) - $max_results);  

			// Chạy 1 mysqli query để hiện thị kết quả trên trang hiện tại  

			$sql = mysqli_query($link,"SELECT * FROM tintuc order by idtintuc DESC LIMIT $from, $max_results"); 



									
			if($dem > 0)
				while ($bien = mysqli_fetch_array($sql))
				{
		?>
					<tr class='noidung_hienthi_sp'>
						<td class="masp_hienthi_sp"><input type="checkbox" name="id[]" class="item" class="checkbox" value="<?=$bien['idtintuc']?>"/></td>
						<td class="masp_hienthi_sp" width="30"><?php  echo $bien['idtintuc'] ?></td>
						<td class="stt_hienthi_sp"><?php echo $bien['tieude'] ?></td>
						<td class="img_hienthi_sp" width="300"> 
							<?php 
								$noidungngan = $bien['noidungngan'];
								echo getNoidung($noidungngan); 
							?> 
						</td>
						<td class="sl_hienthi_sp"><img src="../img/tintuc/<?php echo $bien['hinhanh'] ?>" width="80" height="60"/></td>
						<td class="sl_hienthi_sp"><?php echo $bien['tacgia'] ?></td>
						<td class="active_hienthi_sp">
							<a href='?admin=suatt&idtintuc=<?php echo $bien['idtintuc'] ?>'><img src="img/sua.png" title="Sửa"></a>
						</td>
					</tr>
		<?php 
			}
			
			else echo "<tr><td colspan='6'>Không có khách hàng</td></tr>";
			
		?>
		</table>
	</div>
</form>
