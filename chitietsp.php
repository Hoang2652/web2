<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/zoom/cloud-zoom.1.0.2.js"></script>
<link href="css/cloud-zoom.css" rel="stylesheet" type="text/css" />

<?php 
	$idsanpham=$_GET['idsanpham'];
	$rows=mysqli_query($link,"select * from sanpham where idsanpham=$idsanpham");
	$sumdanhgia = 0;
	function getTen($a){
		$string = "...";
		$result = "";
		$array = explode(" ", $a);
		$length = count($array);
		if ( $length > 7 ) {
			for( $i = 7; $i < $length; $i++){
				unset($array[$i]);
			}
			$result = implode(" ", $array).$string;
		}
		else{
			$result = $a;
		}
		return $result;
	}
	if ($row=mysqli_fetch_array($rows))
	{
		$sqldanhgia = "select danhgia.*,nguoidung.idnguoidung as nguoidanhgia,nguoidung.tendangnhap from danhgia,nguoidung where idsanpham='".$row['idsanpham']."' && danhgia.idnguoidung =nguoidung.idnguoidung  order by ngaybinhluan DESC";
		$rowsdanhgia=mysqli_query($link,$sqldanhgia);
		$dem = $row['soluong']; 
		if($row['giamgia'] != null && $row['soluongkhuyenmai'] > 0){
			$khuyenmai = $row['giamgia'];
			$giadagiam = $row['gia'] - $row['gia'] * $row['giamgia'] / 100;
		}
		if($row['quatang'] != null && $row['soluongkhuyenmai'] > 0){
			$quatang = $row['quatang'];
		}
		
?>

<div class="chitietsp">
	<div class="chitietsp-in">
		<div class="tabs">
				<div>CHI TIẾT SẢN PHẨM</div>
		</div>
		<div class="chitietsp__wrap">
			<div class="content__left">
				<div class="zoom-small-image">
					<a href='img/uploads/<?php echo $row['hinhanh'] ?>' width="300" height="300"  class = 'cloud-zoom' id='zoom1' rel="adjustX: 10, adjustY:-4">
						<img src="img/uploads/<?php echo $row['hinhanh'] ?>" width="250" height="250"  alt='' title="Optional title display" />
					</a>
				</div>
				<div class="mota">
					<?php echo $row['mota'] ?>
				</div>
				<!--- Chức năng đánh giá và xem đánh giá --->
				<div class="danhgia">
					<div class="danhgia__title">
						<h4>Đánh giá </h4>
						<div class="sobinhluan">
							<?php echo "(".mysqli_num_rows($rowsdanhgia).")"; ?>
						</div>
					</div>
					
					<form action="index.php?content=xulydanhgia" method="post" class="form__danhgia" name="frm" onsubmit="return checkdanhgia();">
						<div id="rating">
							<input type="radio" id="star5" name="sodiem" onclick="printStar(this.value)" value="5"/>
							<label class = "full" for="star5" title="Awesome - 5 stars"></label>
						
							<input type="radio" id="star4" name="sodiem" value="4" onclick="printStar(this.value)" check/>
							<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
						
							<input type="radio" id="star3" name="sodiem" value="3" onclick="printStar(this.value)" />
							<label class = "full" for="star3" title="Meh - 3 stars"></label>
						
							<input type="radio" id="star2" name="sodiem" value="2" onclick="printStar(this.value)" />
							<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
						
							<input type="radio" id="star1" name="sodiem" value="1" onclick="printStar(this.value)" />
							<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
						</div>
						<h4 style="clear: left">Ý kiến</h4>
						<div class="form-group row binhluan">
							<input class="form-control" type="text" name="binhluan" placeholder="Hãy để lại một chút ý kiến của bạn về sản phẩm này..." onclick="document.getElementById('warning-Password').innerHTML=''"/>
							<input type="text" name="idsanpham" value="<?php echo $row['idsanpham']; ?>" style="display: none;">
							<div class='canhbao canhbao-danhgia' id='warning-sodiem'></div>	
							<button name="submit-danhgia" class="btn btn-primary button__danhgia">
							<?php if(isset($_SESSION['idnguoidung']) && mysqli_num_rows(mysqli_query($link,"select * from danhgia where idnguoidung = ".$_SESSION['idnguoidung']." AND idsanpham = ".$idsanpham)) > 0) echo "Cập nhật đánh giá"; else echo "Đánh giá"; ?></button>
						</div>
					</form>	
					<div class="gachngang"></div>
					<div class="danhgia__title">
						<h4>Đánh giá tiêu biểu</h4>
					</div>		
					<div id="danhsachdanhgia" class="danhsachdanhgia">
						<?php
							$count = 0;
							$add5cmt = 5;
							if(mysqli_num_rows($rowsdanhgia) > 0){
								while ( ($count < $add5cmt) && $rowdanhgia=mysqli_fetch_array($rowsdanhgia)){
									$str = "";	
									$count++;
									$sumdanhgia = $sumdanhgia + $rowdanhgia['sodiem'];
									for($i = 1; $i < 6; $i++){
										if($i <= $rowdanhgia['sodiem'])
											$str = $str."<i class='fa-solid fa-star' style='color:hsl(47, 98%, 67%)'></i>";
										else
											$str = $str."<i class=\"fa-solid fa-star\" style='color: hsl(47, 2%, 71%);'></i>";
									}
									
									echo "<div class='binhluan'>";
									if(isset($_SESSION['idnguoidung']) && $rowdanhgia['nguoidanhgia'] == $_SESSION['idnguoidung']) 
										echo "<div class='binhluan-1__wrap'>";
									echo	"<div class='binhluan-1-left'>
												<div class='binhluan-tengnuoidung'>".$rowdanhgia['tendangnhap']." - ".ngaythangnam($rowdanhgia['ngaybinhluan'])."</div>
												<div class='binhluan-sodiem'>".$str."</div>
												<div class='binhluan-chitiet'>".$rowdanhgia['binhluan']."</div>
											</div>";
									if(isset($_SESSION['idnguoidung']) && $rowdanhgia['nguoidanhgia'] == $_SESSION['idnguoidung'])
										echo "<div class='bx bx-x-circle binhluan-xoadanhgia' onclick='checkdeldanhgia(".$rowdanhgia['iddanhgia'].")'></div></div>";
									echo "</div>";
									
								} 
							} else {
								echo"<div class='binhluan-empty' style='width: max-content;margin: auto;line-height: 100px;height: 100px;color: grey;font-style: italic;'>Hãy là người đầu tiên đánh giá sản phẩm này :D</div>";
							}
						?>			
					</div>
				</div> <!--- End Chức năng đánh giá và xem đánh giá --->
			</div>	
			<div class="content__right">
				<div class="basic_info">
					<p class="basic__info-name"> <?php echo $row['tensanpham'] ?></p>
					<p class="basic__info-price">
						<?php if(isset($khuyenmai)){ ?>
							<span style="display:block;">
								<font style="color: hsl(0, 3%, 77%); text-decoration: line-through;"><?php echo number_format($row['gia'],0,",",".");?> VNĐ</font>
							</span>
							<span>
								<b><font style="color: hsl(1, 100%, 56%)"><?php echo number_format($giadagiam,0,",",".");?> VNĐ</b></font>
								<i><font size="5"> <?php echo '(giảm '.$row['giamgia'].'%)' ?></font></i>
							</span>
						<?php } 
						else{ ?>
							<span>
								<b><font style="color: hsl(1, 100%, 56%)"><?php echo number_format($row['gia'],0,",",".");?> VNĐ</b></font>
							</span>
						<?php } ?>
						
					</p>
					<div class="avg-rating">
					<?php 
						$star = "";
						$sodanhgia = mysqli_num_rows($rowsdanhgia);
						if($sodanhgia>0){
							$avgdanhgia = $sumdanhgia / $sodanhgia;
							$avgdanhgia = round($avgdanhgia,1);
							for($i = 1; $i < 6; $i++){
								if($i <= $avgdanhgia)
									$star = $star."<i class='fa-solid fa-star r4' style='color:hsl(47, 98%, 67%)'></i>";
								else
									$star = $star."<i class=\"fa-solid fa-star r4\" style='color: hsl(47, 2%, 71%);'></i>";
							}
						}
						if(strlen($star)>0){
							echo "	<div class='avg__danhgia-star'>".$star."</div>
									<div class='avg__danhgia-number'>".$avgdanhgia."/5"." - (".$sodanhgia." bình chọn)"."</div>";
						}
						
					?>
					</div>
					<form action="index.php?content=cart&action=add&idsanpham=<?php echo $row['idsanpham'] ?>" method="post">
						<?php 
							if($dem <= 0){
								?><a href='index.php?content=hethang'><div class='btn button__add-cart'>Mua ngay</div></a> <?php
							} else { ?>
								<input class="btn button__add-cart" type="submit" value="Mua ngay" name="chovaogio" class="inputmuahang"/>
						<?php } ?>
					</form>
					<p class="basic__info-origin">
						<b>Xuất xứ: </b> 
						<?php 
							echo $row['xuatxu'];
						?>
					</p>
					<p class="basic__info-warranty">
						<b>Bảo hành: </b> 
						<?php 
							echo $row['baohanh'] ." tháng";
						?>
					</p>
					<p class="basic__info-number"> 
						<b>Còn lại: </b> 
						<?php 
							if( $dem > 0)
								echo $dem." sản phẩm";
							else 
								echo "Hết hàng";
						?>
					</p>
					
				</div>
				<?php if(isset($quatang)) { ?>
					<div class="sanpham__gift-wrap">
						<div class="sanpham__gift-title">Khuyễn mãi, quà tặng kèm</div>
						<div class="sanpham__gift-info">
							<div class="sanpham__gift-1">
							<?php
								$idspkm = $row['quatang'];
								$spkm = mysqli_query($link,"select * from sanpham where idsanpham=$idspkm");
								$rowspkm = mysqli_fetch_array($spkm);
								$imgspkm = $rowspkm['hinhanh'];
							?>
							<a href="index.php?content=chitietsp&idsanpham=<?php echo $idspkm ?>" style="color:black;">
							<img class="img__spkm" src="img/uploads/<?php echo $imgspkm;?>">	
							<div class="gift-title">Quà Tặng</div>
							<div class="ten-spkm">
								<?php echo $rowspkm['tensanpham'] ?>
							</div>
							<font style="color: hsl(0, 3%, 77%); text-decoration: line-through; font-weight: 500;"> 
								<?php echo number_format($rowspkm['gia'],0,",",".") ?>  VNĐ
							</font> 
							<font style="color: hsl(1, 100%, 56%); margin-left:12px;"> 
								0  VNĐ
							</font>
							</a>
							</div>
							<div class="sanpham__gift-2">
								<?php $sum = $row['gia'] + $rowspkm['gia'] ?>
								<div class="sanpham__gift-2-sum">
									Tổng cộng: 
									<font style="color: hsl(0, 3%, 77%); text-decoration: line-through; font-size: 13px;"> 
										<?php echo number_format($sum,0,",",".") ?>
									</font>
									<font style="color: hsl(1, 100%, 56%)">
										<?php echo number_format($giadagiam,0,",",".");?> VNĐ
									</font>
								</div>
								<div class="sanpham__gift-2-tk">
									Tiết kiệm: 
									<font style="color: hsl(1, 100%, 56%)">
										<?php echo number_format($rowspkm['gia'],0,",",".") ?> VNĐ
									</font>
								</div>
								
							</div>
						</div> 
					</div>
				<?php } ?>
				<div class="tinhnang">
					<div class="tieudetinhnang">
						<ul class="title__thuoctinhsp">
							<li>
								<h4>Thuộc tính sản phẩm</h4>
							</li>
						</ul>
					</div>
					
					<div id="tab1">
						<?php echo $row['chitiet'] ?>
					</div>
				</div>	
			</div>	
		</div>
		<section class="new container" id="new">
			<h2 class="section__title" style="color: hsl(206, 93%, 55%);">
				Sản phẩm đề cử
			</h2>
			
			<div class="new__container">
            <div class="swiper new-swiper">
                <div class="swiper-wrapper-1">
                    <?php 
                    $sql4="select * from sanpham where trangthai='1' order by daban DESC LIMIT 0,8";
                    $recommendedproduct = mysqli_query($link,$sql4);
                    while($rows=mysqli_fetch_array($recommendedproduct)){
						productCardRecommended($rows['idsanpham'],$rows['hinhanh'],$rows['tensanpham'],$rows['gia']);
					} ?>
                </div>
                <div class="new-button-wrapper"> 
                    <div class="new-button-prev">
                        <i class='bx bx-chevron-left'></i>
                    </div>
                    <div class="new-button-next">
                        <i class='bx bx-chevron-right' ></i>
                    </div>
                </div> 
            </div>
        </div>
    	</section>	
	</div>
</div>
<?php } ?>

<script language="javascript">
 	function checkdanhgia(){
		var error=0;
	    if(frm.sodiem.value==0)
		{
			document.getElementById('warning-sodiem').innerHTML="Bạn chưa đánh giá sản phẩm";
			error++;	
		}
		if(error>0) {
			alert('Bình luận thất bại');
			return false;
		} else {
			return true;
		}
	}
	function printStar(rating){
		document.getElementById("saodanhgia").innerHTML = " ("+ rating +")";
	}
</script>
