<?php
if(isset($_GET['timkiem']) || isset($_GET['minprice']) || isset($_GET['maxprice']))
{
  	$tim="";
	$gia2="";
	$minprice=0;
	$maxprice=99999999999;
	$subsql="";

	if($_GET['minprice'] != ""){
		$minprice=$_GET['minprice'];
		$gia2=$gia2."Từ ".$minprice." VND ";
	}
	if($_GET['maxprice'] != ""){
		$maxprice=$_GET['maxprice'];
		$gia2.=$gia2."đến ".$maxprice." VND";
	}
	if(isset($_GET['minprice']) || isset($_GET['maxprice'])){
		$subsql .="and (gia between ".$minprice." and ".$maxprice.") ";
	}

	if(isset($_GET['timkiem'])){
		$tim=$_GET['timkiem'];
		$subsql=$subsql."and tensanpham like '%".$tim."%' ";
	}
	
	$sql="select * FROM sanpham WHERE trangthai='1' ".$subsql;

  if(!isset($_GET['page'])){  
	$page = 1;  
	} else {  
	$page = $_GET['page'];  
	}  
 
	$rows=mysqli_query($link,$sql);
	$tong=mysqli_num_rows($rows);
    if($tong<0)
     echo"Không tìm được sản phẩm nào";
    else {
		?>
		<div class="danhsachsanpham">
			<div class="tabs">
				<div>Từ khóa "<font color="blue"><b><?php echo $tim ?></b></font>" <?php echo $gia2 ?> có <font color="red"><?php echo $tong?></font> kết quả </div>
			</div>	
		<div class="danhsachsanphamcon">
		<?php

		// Chọn số kết quả trả về trong mỗi trang mặc định là 9
		$max_results = 12;  

		// Tính số thứ tự giá trị trả về của đầu trang hiện tại 
		$from = (($page * $max_results) - $max_results);  

		// Chạy 1 mysqli query để hiện thị kết quả trên trang hiện tại  

		$sql1=  $sql."LIMIT $from, $max_results";
		$rows1=mysqli_query($link,$sql1);
		$tong=mysqli_num_rows($rows1);
		if($tong==0)
		{
			echo "<div id='thongbaokhongco'>Không có sản phẩm để hiển thị !</div>";
		}

		while($row=mysqli_fetch_array($rows1))
		{
		?>	
			<div class="sanpham card">
				<a href="index.php?content=chitietsp&idsanpham=<?php echo $row['idsanpham'] ?>">
					<img class="card-img-top" src="img/uploads/<?php echo $row['hinhanh'];?>">				
					<p><a><?php echo $row['tensanpham'];?></a></p>
					<h4>Giá: <?php echo number_format($row['gia'],0,",",".");?> VNĐ</h4>
				</a>
			</div><!-- End .sanpham-->
		<?php }} ?>
		</div><!-- End .danhsachsanphamcon-->	
	</div><!-- End .sanpham-->	

	<div class="phantrang">
						<?php 
						
						// Tính tổng kết quả trong toàn DB:  
						$total_results = mysqli_num_rows($rows);

						// Tính tổng số trang. Làm tròn lên sử dụng ceil()  
						$total_pages = ceil($total_results / $max_results);  

						// Tạo liên kết đến trang trước trang đang xem 
						if($page > 1){  
						$prev = ($page - 1);  
						echo "<a href=\"".$_SERVER['PHP_SELF']."?content=timkiem&timkiem=".$tim."&minprice=".$minprice."&maxprice=".$maxprice."&btntk=Tìm+Kiếm&page=$prev\"><button class='trang hover'><</button></a>&nbsp;";  
						}  

						for($i = 1; $i <= $total_pages; $i++){  
						if(($page) == $i){
							
						echo "<a><button class='tranghientai' disabled>$i</button></a>&nbsp;"; 
						} else {  
						echo "<a href=\"".$_SERVER['PHP_SELF']."?content=timkiem&timkiem=".$tim."&minprice=".$minprice."&maxprice=".$maxprice."&btntk=Tìm+Kiếm&page=$i\"><button class='so hover'>$i</button></a>&nbsp;";  
						}  
						}  

						// Tạo liên kết đến trang tiếp theo  
						if($page < $total_pages){  
						$next = ($page + 1);  
						echo "<a href=\"".$_SERVER['PHP_SELF']."?content=timkiem&timkiem=".$tim."&minprice=".$minprice."&maxprice=".$maxprice."&btntk=Tìm+Kiếm&page=$next\"><button class='trang hover'>></button></a>";  
						}  
						echo "</center>";  	
						?>
		</div>
<?php }?>