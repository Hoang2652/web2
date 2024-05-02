<?php 
		if(isset($_GET['action']))
    {    $action=$_GET['action'];}
    else $action=""; 
		if(isset($_GET['content']))
				{
					switch ($_GET['content'])
					{
						case "timkiem":
							include ('timkiem.php');
							break;
						case "dangky":
							include ('dangky.php');
							break;
						case "dangnhap":
							include ('dangnhap.php');
							break;
						case "chitietsp":
							include ('chitietsp.php');
							break;
						case "cart":
							include ('cart/index.php');
							break;
						case "hotro":
							include ('hotro.php');
							break;
						case "sanpham":
							include ('sanpham.php');
							break;
						case "phukien":
							include ('phukien.php');
							break;
						case "hethang":
							include ('hethang.php');
							break;
						case "lichsumuahang":
							include ('lichsumuahang.php');
							break;
						case "ttcn":
							include ('thongtincanhan.php');
							break;	
						case "doimatkhau":
							include ('doimatkhau.php');
							break;
                        case "tintuc":
                            include ('tintuc.php');
                            break;
                        case "chitiettintuc":
                            include ('chitiettintuc.php');
                            break;
						case "doithongtincanhan":
							include ('update_thongtincanhan.php');
							break;
						case "xulydanhgia":
							include ('xulydanhgia.php');
							break;
						case "chitiethotro":
							include ('chitiethotro.php');
							break;
					}
				}
			else if(isset($_GET['iddanhmuc'])) {
					$sql = "SELECT * FROM sanpham  WHERE (iddanhmuc='{$_GET['iddanhmuc']}' OR loaisanpham='{$_GET['iddanhmuc']}') AND trangthai='1'";	
					if(isset($GET['iddanhmuc']))
					{
						echo "<script>console.log('123');</script>";
						$sql.="where iddanhmuc='".$_GET['iddanhmuc']."'";
					}
					/*------------Phan trang------------- */
					// Nếu đã có sẵn số thứ tự của trang thì giữ nguyên (ở đây tôi dùng biến $page) 
					// nếu chưa có, đặt mặc định là 1!   
					
					if(!isset($_GET['page'])){  
						$page = 1;  
					} else {  
						$page = $_GET['page'];  
					}  

					// Chọn số kết quả trả về trong mỗi trang mặc định là 9 
					$max_results = 12;  
						
					// Tính số thứ tự giá trị trả về của đầu trang hiện tại 
					$from = (($page * $max_results) - $max_results);  

					// Chạy 1 mysqli query để hiện thị kết quả trên trang hiện tại  

					$sql.=  "LIMIT $from, $max_results";
						
		
					$query=mysqli_query($link,$sql);
					$total=mysqli_num_rows($query);
					?>

					
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
							<div class="danhsachsanpham">	
							<?php
								$sql1="select tendanhmuc,mota from danhmuc where iddanhmuc='{$_GET['iddanhmuc']}'";
								$query1=mysqli_query($link,$sql1);
								if($row=mysqli_fetch_array($query1)){
							?>
								<div class='tabs'>
									<div><?php echo $row['tendanhmuc']?></div>
								</div>
								<div class="danhsachsanphamcon">
									<?php echo '<div style="max-width: 900px;width: fit-content;height: fit-content;margin: 25px auto;font-style: italic;color: grey;font-size: 14px;">"'.$row['mota'].'"</div>';
									if($total>0){
										while ($result=mysqli_fetch_array($query)){
											productCardBasic($result['idsanpham'],$result['hinhanh'],$result['tensanpham'],$result['gia']);
										} 
									?>
									<div class="phantrang">
								<?php 
								
								// Tính tổng kết quả trong toàn DB:  
								$total_results = mysqli_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM sanpham where iddanhmuc='{$_GET['iddanhmuc']}'"),0);  

								// Tính tổng số trang. Làm tròn lên sử dụng ceil()  
								$total_pages = ceil($total_results / $max_results);  


								// Tạo liên kết đến trang trước trang đang xem 
								if($page > 1){  
									$prev = ($page - 1);  
									echo "<a href=\"".$_SERVER['PHP_SELF']."?iddanhmuc=".$_GET['iddanhmuc']."&page=$prev\"><button class='trang'><</button></a>&nbsp;";  
								}  

								for($i = 1; $i <= $total_pages; $i++){  
									if(($page) == $i){
										echo "<button class='so-ht'>$i</button>&nbsp"; 
									} else {  
										echo "<a href=\"".$_SERVER['PHP_SELF']."?iddanhmuc=".$_GET['iddanhmuc']."&page=$i\"><button class='so'>$i</button></a>&nbsp;";  
									}  
								}  							

								// Tạo liên kết đến trang tiếp theo  
								if($page < $total_pages){  
									$next = ($page + 1);  
									echo "<a href=\"".$_SERVER['PHP_SELF']."?iddanhmuc=".$_GET['iddanhmuc']."&page=$next\"><button class='trang'>></button></a>";  
								}  
								echo "</center>";
							} else {echo "<div>Danh mục này hiện chưa có sản phẩm</div>";}
							} else {echo "<div>Có vẻ đường link của bạn không tồn tại</div>";} ?>
								</div>
						</div>
						</div>	
								
								<?php 
							} 
							else {include ('trangchu.php');}
							
?>