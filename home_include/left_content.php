<?php include 'include/connect.php';?>
	<div id="locsanpham">
					<div class="center">
					<h4><i class="far fa-copyright"></i> THƯƠNG HIỆU</h4>
					<?php 
					   $sql="select * from danhmuc where loaidanhmuc='TH'";
					   $result=mysqli_query($link,$sql);
					?>
						<ul>
						<?php 
						   while($row=mysqli_fetch_array($result))
						   {
						?>
							<li><a href="index.php?iddanhmuc=<?php echo $row['iddanhmuc'] ?>"><i class="far fa-hand-point-right"></i> <?php echo $row["tendanhmuc"];?></a></li>
							<?php } ?>
							
							
						</ul>
					</div><!-- End .center -->
		</div>	<!-- End .menu-left -->
				
				<div id="locsanpham">
					<div class="center">
						<h4><i class="fas fa-gem"></i> PHỤ KIỆN</h4>
						<?php 
					   $sql="select * from danhmuc where loaidanhmuc='LSP' AND iddanhmuc != '8'";
					   $result=mysqli_query($link,$sql);
						?>
						<ul>
						<?php 
						   while($row=mysqli_fetch_array($result))
						   {
						?>
							<li><a href="index.php?iddanhmuc=<?php echo $row['iddanhmuc'] ?>"><i class="far fa-hand-point-right"></i> <?php echo $row["tendanhmuc"];?></a></li>
							<?php } ?>
						</ul>
					</div><!-- End .center -->
				</div><!-- End .phukien -->	

				<div id="locsanpham">
					<div class="center">
						<h4><i class="fas fa-funnel-dollar"></i> GÍA THÀNH</h4>
						<form style="margin: 5px auto;width: 250px;" action="index.php?content=timkiem" method="GET">
						<input type="hidden" name="content" value="timkiem">
							<div class="form__row">
								<div class="input__price">
									<input class="form-control" type="text" name="minprice" placeholder="Từ giá: "/>
								</div>
								<div class="input__price ip-bot">
									<input class="form-control" type="text" name="maxprice" placeholder="Đến giá: "/>
								</div>
							</div>
							<div class="gia-submit">
								<input type="submit" name="btntk" value="Lọc" class="btn btn-primary"/>
							</div>
						</form>
					</div><!-- End .center -->
				</div><!-- End .phukien -->	
