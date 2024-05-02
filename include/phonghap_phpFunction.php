<?php 
include('connect.php');

function productCard($idsanpham,$hinhanh,$tensanpham,$gia){
	?>
	<article class="featured__card">
		<a href="index.php?content=chitietsp&idsanpham=<?php echo $idsanpham; ?>">
			<span class="featured__tag">Sale</span>

			<img src="img/uploads/<?php echo $hinhanh; ?>" alt="" class="featured__img">

			<div class="featured__data">
				<h3 class="featured__title"><?php echo $tensanpham; ?></h3>
				<span class="featured__price"><?php echo number_format($gia,0,",",".");?> VNĐ</span>
			</div>

			<button class="button featured__button">Xem chi tiết</button>
		</a>
	</article>
	<?php
}

function productCardRecommended($idsanpham,$hinhanh,$tensanpham,$gia){
	?>
    <article class="new__card swiper-slide">
    	<a href="index.php?content=chitietsp&idsanpham=<?php echo $idsanpham; ?>">
			<span class="new__tag">Recommended</span>

			<img src="img/uploads/<?php echo $hinhanh; ?>" alt="" class="new__img">

			<div class="new__data">
				<h3 class="new__title"><?php echo $tensanpham; ?></h3>
				<span class="new__price"><?php echo number_format($gia,0,",",".");?> VNĐ</span>
			</div>

			<button class="button new__button">Xem chi tiết</button>
        </a>
    </article>
	<?php
}

function productCardBasic($idsanpham,$hinhanh,$tensanpham,$gia){
	include('connect.php');
	$querykhuyenmai=mysqli_query($link,"select giamgia,quatang,soluongkhuyenmai from sanpham where idsanpham=$idsanpham LIMIT 0,1");
	if($rowkhuyenmai = mysqli_fetch_array($querykhuyenmai)){
		if($rowkhuyenmai['soluongkhuyenmai'] > 0 && $rowkhuyenmai['giamgia'] != null){
			$khuyenmai = "-".$rowkhuyenmai['giamgia']."%";
		} else if($rowkhuyenmai['soluongkhuyenmai'] > 0  && $rowkhuyenmai['quatang'] != null){
			$khuyenmai = '<i class="fa-solid fa-gift" style="line-height: 36px;font-size: 20px;"></i>';
		}
	}
	?>
	<div class="sanpham card">
		<?php if(isset($khuyenmai)) { ?>
			<div class="card-tag"><?php echo $khuyenmai; ?></div>
		<?php } ?>
		<a href="index.php?content=chitietsp&idsanpham=<?php echo $idsanpham; ?>">
			<img class="card-img-top" src="img/uploads/<?php echo $hinhanh;?>">				
			<p><?php echo $tensanpham;?></p>
			<?php
				$sqldanhgia = "select * from danhgia,nguoidung where idsanpham='".$idsanpham."' && danhgia.idnguoidung =nguoidung.idnguoidung order by ngaybinhluan DESC";
				$rowsdanhgia=mysqli_query($link,$sqldanhgia);
				$star = "";
				$sumdanhgia = 0;
				$sodanhgia = mysqli_num_rows($rowsdanhgia);
				while($rowdanhgia=mysqli_fetch_array($rowsdanhgia)){
					$sumdanhgia = $sumdanhgia + $rowdanhgia['sodiem'];
				}
				if($sodanhgia>0){
					$avgdanhgia = $sumdanhgia / $sodanhgia;
					$avgdanhgia = round($avgdanhgia,1);
					for($i = 1; $i < 6; $i++){
						if($i <= $avgdanhgia)
							$star = $star."<i class='fa-solid fa-star' style='color:hsl(47, 98%, 67%)'></i>";
						else
							$star = $star."<i class=\"fa-solid fa-star\" style='color: hsl(47, 2%, 71%);'></i>";
					}
				}
				else{
					$star = "&nbsp;";
				}
				echo "<div class='avg__sp-star'>".$star."</div>";

			if($rowkhuyenmai['giamgia'] != null){
			?>
			<h4 style="text-decoration: line-through; color: grey"><?php echo number_format($gia,0,",",".");?> VNĐ</h4> 
			<h4><i class="fa-solid fa-hand-point-right"></i><?php echo " ".number_format($gia*(1-$rowkhuyenmai['giamgia']/100),0,",",".");?> VNĐ</h4> 
			<?php } else {?>
			<h4><?php echo number_format($gia,0,",",".");?> VNĐ</h4> 
			<?php }?>
		</a>
	</div><!-- End .sanpham-->
<?php
}

function alertBox($title, $message){
	echo"
	<div class='exitField' onclick=\"document.getElementById(\'alertBox\').innerHTML=''\">
		<div class='alertBox-holder'>
			<div class='alertBox-title'>.$title</div>
			<div class='alertBox-context'>".$message."</div>
			<div class='alertBox-interact' onclick=\"document.getElementById(\'alertBox\').innerHTML=''\"> Oke </div>
		</div>
	</div>
	";
}

function alertBoxWithDirectory($title, $message, $directory){
	echo"
	<div class='exitField' onclick=\"window.open('".$directory."','_self', 1)\">
		<div class='alertBox-holder'>
			<div class='alertBox-title'>.$title</div>
			<div class='alertBox-context'>".$message."</div>
			<div class='alertBox-interact' onclick=\"window.open('".$directory."','_self', 1)\"> Oke </div>
		</div>
	</div>
	";
}
?>