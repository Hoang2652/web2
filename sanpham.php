
	<div id="content">
		<div id="lofslidecontent45" class="lof-slidecontent" style="width: 1000px; height: 350px; margin: 12px auto; border: solid 4px grey;">
			<div class="preload"><div></div></div>
				<div id="lof-main-outer">
					<ul class="lof-main-wapper">
						<li><img src="img/slide/slide1.png" width="1000" height="350"></li>
						<li><img src="img/slide/slide.png" width="1000" height="350"></li>
						<li><img src="img/slide/slide2.png" width="1000" height="350"></li>
						<li><img src="img/slide/slide3.png" width="1000" height="350"></li>
						<li><img src="img/slide/slide4.png" width="1000" height="350"></li>
					</ul>
				</div>
				<div class="lof-navigator-wapper">

					<div onClick="return false" href="" class="lof-next">Next</div>
					  <div class="lof-navigator-outer">
							<ul class="lof-navigator">
							   <li><img src="img/slide/slide1.png" width="70" height="25" /></li>       		
							   <li><img src="img/slide/slide.png" width="70" height="25" /></li>       		
							   <li><img src="img/slide/slide2.png" width="70" height="25" /></li>       		
							   <li><img src="img/slide/slide3.png" width="70" height="25" /></li>       		
							   <li><img src="img/slide/slide4.png" width="70" height="25" /></li>       		
							</ul>
					  </div>
					<div onClick="return false" href="" class="lof-previous">Previous</div>
				</div> 
		</div>
	</div>
		<div class="select__wrap">
			<div id="select">
				<form action="index.php?content=timkiem" method="GET">
					<input type="hidden" name="content" value="timkiem">
					<input class="search__sanpham" type="text" name="timkiem" onkeyup="livesreach(this.value)" placeholder="Nhập id hoặc tên sản phẩm"/>
					<div id="livesreach"></div>
					<button type="submit" name="btntk" value="Tìm kiếm" class="search__sanpham-icon" width="50px" height="50px">
						<i class='bx bx-search'></i>
					</button>
				</form>
			</div>
		</div>
		<div class="product-wrapper">
			<div class="product-filter">
				<?php include "home_include/left_content.php"; ?>
			</div>
			<div class="product-info">
				<?php 
				$sql="select * from danhmuc where loaidanhmuc='TH' order by iddanhmuc";
				$result=mysqli_query($link,$sql);
			
			
				while($row=mysqli_fetch_array($result))
				{ 
				?> 	
				<div class="danhsachsanpham">
					<div class='tabs'>
						<div>Phân loại: <?php echo $row["tendanhmuc"];?></div> 
					</div>	 
					<?php 
					$sql1="select * from sanpham where iddanhmuc={$row['iddanhmuc']} AND trangthai='1' order by idsanpham  LIMIT 0,4";
					$kq=mysqli_query($link,$sql1);
					$dem = mysqli_num_rows($kq);
					if($dem>0)
					{
					?>
					<div id="xemthem" style="height: 15px;">
						<p><a href="index.php?iddanhmuc=<?php echo $row['iddanhmuc']?>">Xem thêm >></a></p>
					</div>
					<?php } 
							else echo "<div id='thongbaokhongco'>Không có sản phẩm để hiển thị !</div>";
					?>
					<div class="danhsachsanphamcon">
						<?php while($rows=mysqli_fetch_array($kq))
						{ 
							productCardBasic($rows['idsanpham'],$rows['hinhanh'],$rows['tensanpham'],$rows['gia']);
						} ?>
						
					</div>
				</div><!-- end san pham-->
					<?php 
				}?>
			</div>
		</div>