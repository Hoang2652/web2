<div class="title__tintuc">
	TIN TỨC MỚI NHẤT
</div>

<div id="tintuc">
<div class="img__tintuc">
	<img src="img/Biatintuc.PNG" alt="">
</div>
	<div class="container__tintuc">
		<?php
			//$select = mysqli_query($link,"select * from tintuc order by idtintuc DESC");
		
		
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

			$sql = mysqli_query($link,"SELECT * FROM tintuc ORDER by idtintuc DESC  LIMIT $from, $max_results"); 

			function getNdTintuc($a){
				$string = "...";
				$result = "";
				$array = explode(" ", $a);
				$length = count($array);
				if ( $length > 13 ) {
					for( $i = 13; $i < $length; $i++){
						unset($array[$i]);
					}
					$result = implode(" ", $array).$string;
				}
				else{
					$result = $a;
				}
				return $result;
			}

			function getDay($b){
				$array = explode("-", $b);
				$day = $array[2];
				return $day;

			}

			function getMonth($b){
				$array = explode("-", $b);
				$month = $array[1];
				return "Th".$month;

			}

			while($row=mysqli_fetch_array($sql))
			{
		?>
		
		<div class="tintuccon">
			<div class="imgtintuc">
				<a href="index.php?content=chitiettintuc&idtintuc=<?php echo $row['idtintuc'] ?>">
					<img src="img/tintuc/<?php echo $row['hinhanh'] ?>" width="450px" height="300px;">
				</a>
			</div>
			<div class="tieudetintuc">
				<p><a href="index.php?content=chitiettintuc&idtintuc=<?php echo $row['idtintuc'] ?>"><?php echo $row['tieude'] ?></a></p>
			</div>
			<div class="post-date">
				<span class="post-date-day">
					<?php
						$ngaydangtin = $row['ngaydangtin'];
						echo getDay($ngaydangtin);
					?>
				</span>
				<span class="post-date-month">
					<?php
						$thangdangtin = $row['ngaydangtin'];
						echo getMonth($thangdangtin);
					?>
				</span>
			</div>
			<div class="noidungtintuc">
			<p>
				<span> 
					<?php 
						$noidungtintuc = $row['noidungngan'];
						echo getNdTintuc($noidungtintuc); 
					?> 
				</span>
			</p>
			</div>
		
		</div>
		<?php } ?>
	</div>
</div>
<div id="phantrang_sp">
	
	<?php
			// Tính tổng kết quả trong toàn DB:  
			$total_results = mysqli_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tintuc"),0);  

			// Tính tổng số trang. Làm tròn lên sử dụng ceil()  
			$total_pages = ceil($total_results / $max_results);  


			// Tạo liên kết đến trang trước trang đang xem 
			if($page > 1){  
			$prev = ($page - 1);  
			echo "<a href=\"".$_SERVER['PHP_SELF']."?content=tintuc&page=$prev\"><button class='trang'>Trang trước</button></a>&nbsp;";  
			}  

			for($i = 1; $i <= $total_pages; $i++){  
			if(($page) == $i){  
			echo "$i&nbsp;";  
			} else {  
			echo "<a href=\"".$_SERVER['PHP_SELF']."?content=tintuc&page=$i\"><button class='so'>$i</button></a>&nbsp;";  
			}  
			}  

			// Tạo liên kết đến trang tiếp theo  
			if($page < $total_pages){  
			$next = ($page + 1);  
			echo "<a href=\"".$_SERVER['PHP_SELF']."?content=tintuc&page=$next\"><button class='trang'>Trang sau</button></a>";  
			}  
			echo "</center>";  		
		
	?>
	</div>