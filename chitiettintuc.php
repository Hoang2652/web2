<?php 

	$idtintuc=$_GET['idtintuc'];
	$select=mysqli_query($link,"select * from tintuc where idtintuc='".$idtintuc."'");
	$row=mysqli_fetch_array($select)
?>
<!-- <input action="action" onclick="window.history.go(-1); return false;" type="submit" value="<- Quay về trang trước"/> -->
<div class="chitiettintuc">
	<h3><?php echo $row['tieude'] ?></h3>
	<div class="noidungchitiettintuc">
		<img src="img/tintuc/<?php echo $row['hinhanh']?>" width="200" height="200">
		<p><?php echo $row['noidungngan'] ?></p>
	</div>
	<div class="noidungfull">
		<p><?php echo $row['noidungchitiet'] ?></p>
		<span>Tác giả: <?php echo $row['tacgia'] ?></span>
	</div>
</div>