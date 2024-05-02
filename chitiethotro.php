<?php 
if(isset($_GET['idcauhoi'])){
	$idcauhoi=$_GET['idcauhoi'];
	$select=mysqli_query($link,"select * from traloicauhoi where idcauhoi='".$idcauhoi."'");
    if(mysqli_num_rows($select) == 0)
        include('trangkhongtontai.php');
    else {
        while($row=mysqli_fetch_array($select))
        {
?>
<input action="action" onclick="window.history.go(-1); return false;" type="submit" value="<- Quay về trang trước"/>
<div class="chitiettintuc">
	<h3><?php echo $row['noidungcauhoi'] ?></h3>
	<div class="cautraloi">
		<p><?php echo $row['cautraloi'] ?></p>
	</div>
</div>
<?php }}} else {
    include('trangkhongtontai.php');
} ?>