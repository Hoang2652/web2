 <div id="dangnhap">
					<div class="center1">
						<h4>ĐĂNG NHẬP</h4>
						<?php if(isset($_SESSION['username'])){
							?>
								<div id="dangnhap-in">
								<span id="xinchao"><p>Xin chào: <span> <?php echo $_SESSION['username'] ?> </span></p></span>
								<span id="logout"><p><a href="logout.php"><button name="login">Đăng xuất</button></a></p></span>
						</div><!-- End .dangnhap-in-->
							<?php 
						}
						else{
						?>
						<div id="dangnhap-in">
						<div id="login-respond"></div>
								<span><p>Tên đăng nhập: <input type="text" size="10" name="username" id="username"></p> <br>
								<p>Mật khẩu: <input type="password" size="10" name="password" id="password"></p> <br>
								<p><input type="checkbox" name="saveinfo" id="checkluudangnhap">  Lưu đăng nhập</p></span>
								<div style="width: fit-content; margin: 15px auto;"><a><button name="login" id="login-submit">Đăng nhập</button></a></div>
								<?php
								if(isset($_COOKIE['username']) && isset($_COOKIE['password']))
								{
									echo "<script language='javascript'>document.getElementById('username').value='" .$_COOKIE['username']. "';</script>";
									echo "<script language='javascript'>document.getElementById('password').value='" .$_COOKIE['password']. "';</script>";
								}
								?>
							<ul>
								<li id="dangkycss">Chưa có tài khoản? => <a href="index.php?content=dangky">Đăng ký</a></li>
							</ul>
						</div><!-- End .dangnhap-in-->
						<?php } ?>
					</div><!-- End .center1-->
				</div><!-- End .giohang-->
				<div id="giohang">
					<div class="center1">
						<h4>GIỎ HÀNG</h4>
							<a href="index.php?content=cart"><img src="img/images.jpg" title="Vào giỏ hàng" width="150" height="100px"></a>
							<?php 
								$tongtien=0;
								if(isset($_SESSION['cart']))
								$count=count($_SESSION['cart']);
								else $count=0;
								if($count==0){
							?>
							<p>Không có sản phẩm</p>
							<?php } 
							else {
							?>
							<p id="soluonggiohang">Có <span><?=$count?></span> sản phẩm trong giỏ</p>
							 
							<p id="tiengiohang">
							 <?php $sql ="select * from sanpham where idsp in(";
        
							foreach($_SESSION['cart'] as $id => $soluong)
								{
									if($soluong>0)
									$sql .= $id.",";
								}
								if (substr($sql,-1,1)==',')
								{
									$sql = substr($sql,0,-1);
								}
									$sql .=' )order by idsp 	';
									$rows=mysqli_query($link,$sql);
									while ($row=mysqli_fetch_array($rows))
									{  
										$tongtien+=$_SESSION['cart'][$row['idsp']]*$row['gia']; 
									}
								?> <?php  echo number_format($tongtien,"0",",",".");?> VNĐ
							</p>
							<?php } ?>
							<div id="nut-lichsumuahang"><a href="index.php?content=lichsumuahang">Lịch sử mua hàng</a></div>			
					</div><!-- End .center1-->
				</div><!-- End .giohang-->