<link rel="stylesheet" href="css/them_sanpham.css">
<?php
		//include('../include/connect.php');
		$idsanpham=$_GET['idsanpham'];
        $sql="select * from sanpham where idsanpham=$idsanpham";
         $rows=mysqli_query($link,$sql);
         $row=mysqli_fetch_array($rows);
?>
<form class="formthemsanpham" action="update_sanpham.php?idsanpham=<?php echo $idsanpham;?>" method="post" name="frm" onsubmit="" enctype="multipart/form-data">
	<div class="add__sp">
		<div class="tieude_themsp">
			<div colspan=2>Cập nhật thông tin Sản Phẩm </div>
		</div>

		<div class="form-row mb-3">
			<div class="col-md-6">
				<label for="tensanpham">Tên SP</label>
				<input class="form-control" type="text" name="tensanpham" value="<?php echo $row['tensanpham'] ?>"/>
				<input class="form-control" type="hidden" name="idsanphamtonkho" value="<?php echo $row['idsanpham'] ?>"/>
			</div>
			<div class="col-md-6">
				<label for="iddanhmuc" style="display: grid">Thương Hiệu</label>
				<select class="custom-select mr-sm-2" style="width: 190px;" name="iddanhmuc">
					<?php 
						$sql1="select * from danhmuc WHERE loaidanhmuc='TH'";
						$rows1=mysqli_query($link,$sql1);
						while($row1=mysqli_fetch_array($rows1))
					{
					?>
					<option value="<?php echo $row1['iddanhmuc']?>" <?php if($row['iddanhmuc']==$row1['iddanhmuc']) echo 'selected';?>><?php echo $row1['tendanhmuc']?></option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="form-row mb-3">
			<div class="col-md-6">
				<label for="soluong">Số lượng mở bán</label>
				<input class="form-control col-sm-5" type="text" name="soluong" value="<?php echo $row['soluong'] ?>" />
			</div>
			<div class="col-md-6">
				<label for="soluong">Đã bán</label>
				<input class="form-control col-sm-5" type="text" name="daban" value="<?php echo $row['daban'] ?>" />
			</div>
			<div class="col-md-6">
				<label for="gia" >Giá</label>
				<input class="form-control col-sm-5" type="text" name="gia" value="<?php echo $row['gia'] ?>"/>
			</div>
			
		</div>
		<div class="form-row mb-3">
			<div class="col-md-6">
				<label for="hinhanh">Hình ảnh</label>
				<br />	
				<img src="../img/uploads/<?=$row['hinhanh']?>" width="160" height="160"/>	
				<br />
				<br />	
				<input class="form-control-file" type="file" name="hinhanh"/>
			</div>
		</div>
		<div class='form-row mb-3'>
            <div class='col-md-6'>
                <label for='loaisanpham'>Loại sản phẩm</label>	
				<br />		
                <select class='custom-select mr-sm-2' style='width: 190px;' name='loaisanpham' required>
					<?php 
						$sql1="select * from danhmuc WHERE loaidanhmuc='LSP'";
						$rows1=mysqli_query($link,$sql1);
						while($row1=mysqli_fetch_array($rows1))
					{
					?>
					<option value="<?php echo $row1['iddanhmuc']?>" <?php if($row['loaisanpham']==$row1['iddanhmuc']) echo 'selected="selected"';?>><?php echo $row1['tendanhmuc']?></option>
					<?php }?>
         	 	</select>
            </div>
            <div class='col-md-6'>
                <label for='xuatxu'>Xuất xứ</label>			
                <input class='form-control' type='text' name='xuatxu' value="<?php echo $row['xuatxu'] ?>" required/>
            </div>
        </div>
        <div class='form-row mb-3'>
            <div class='col-md-6'>
                <label for='mota'>Mô tả</label>			
                <input class='form-control' type='text' name='mota' value="<?php echo $row['mota'] ?>" required>
            </div>
            <div class='col-md-6'>
                <label for='baohanh'>Bảo hành (tháng)</label>			
                <input class='form-control' type='text' name='baohanh' value="<?php echo $row['baohanh'] ?>" required/>
            </div>
        </div>
		<div class="mb-3">
			<label for="chitiet">Chi tiết</label>
			<div>
				<textarea name="chitiet" id="chitiet"><?php echo $row['chitiet'] ?></textarea>
			</div>
		</div>
		Đề cử <font>(có thể bỏ qua)</font>
			<div class="mb-3 mt-2">
				<div class="form-check mb-2">
					<input class="form-check-input" type="checkbox" name="decudautrang" <?php if($rowss = mysqli_fetch_array(mysqli_query($link,"select * from sanphamdecu where idsanphamdecu='1' AND idsanpham ='".$row['idsanpham']."'"))) echo "checked";?>/>
					<label class="form-check-label" for="decudautrang">Xuất hiện đầu trang chủ</label>
				</div>
				<div class="form-check mb-2">
					<input class="form-check-input" class="form-control col-sm-5" type="checkbox" name="decugiuatrang" <?php if($rowss = mysqli_fetch_array(mysqli_query($link,"select * from sanphamdecu where idsanphamdecu='2' AND idsanpham ='".$row['idsanpham']."'"))) echo "checked"?>/>
					<label class="form-check-label" for="decugiuatrang" >Xuất hiện giữa trang chủ</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" class="form-control col-sm-5" type="checkbox" name="decusanpham" <?php if($rowss = mysqli_fetch_array(mysqli_query($link,"select * from sanphamdecu where idsanphamdecu='3' AND idsanpham ='".$row['idsanpham']."'"))) echo "checked"?>/>
					<label class="form-check-label" for="decusanpham" >Sản phẩm đề cử</label>
				</div>
			</div>
		Cài đặt khuyến mãi <font>(có thể bỏ qua)</font>
		<div class="form-row mb-3 mt-2">
			<div class="col-md-6">
				<label for="giamgia">Giảm giá: </label>
				<input class="form-control col-sm-5" maxlength="3" type="text" name="giamgia" value="<?php echo $row['giamgia'] ?>"/>
			</div>
			<div class="col-md-6">
				<label for="quatang" >Quà tặng (id sản phẩm): </label>
				<input class="form-control col-sm-5" type="text" name="quatang" value="<?php echo $row['quatang'] ?>"/>
			</div>
		</div>
		<div class="form-row">
			<div class="col-md-6">
				<label for="soluongkhuyenmai" >số lượng khuyến mãi (không thể vượt qua số lượng sản phẩm):</label>
				<input class="form-control col-sm-5" maxlength="5" type="text" name="soluongkhuyenmai" value="<?php echo $row['soluongkhuyenmai'] ?>"/>
			</div>
		</div>
		<div class="form-group row" style="margin-top: 2rem;"> 
			<input class="btn btn-primary" style="margin:auto;" type="submit" name="submit" value="Sửa sản phẩm" />
			<input class="btn btn-danger" style="margin:auto; margin-right: 10rem" type="reset" name="" value="Về mặc định" />
		</div>
		<div class="danhgia__title">
			<h4>Đánh giá tiêu biểu</h4>	
			<div id="danhsachdanhgia" class="danhsachdanhgia">
			<?php 
			$sqldanhgia = "select * from danhgia,nguoidung where idsanpham='".$row['idsanpham']."' && danhgia.idnguoidung =nguoidung.idnguoidung  order by ngaybinhluan DESC";
			$rowsdanhgia=mysqli_query($link,$sqldanhgia);
			$dem = $row['soluong']; 
			$count = 0;
			$add5cmt = 5;
			while ( ($count < $add5cmt) && $rowdanhgia=mysqli_fetch_array($rowsdanhgia)){
				$str = "";
				$count++;
				for($i = 1; $i < 6; $i++){
					if($i <= $rowdanhgia['sodiem'])
						$str = $str."<i class='fa-solid fa-star' style='color:hsl(47, 98%, 67%)'></i>";
					else
						$str = $str."<i class=\"fa-solid fa-star\" style='color: hsl(47, 2%, 71%);'></i>";
					}
					echo "<div class='binhluan'>
						<div class='fas fa-trash-alt binhluan-xoadanhgia cl_red' onclick='checkdeldanhgia(".$rowdanhgia['iddanhgia'].")'></div>
						<div class='binhluan-tengnuoidung'>".$rowdanhgia['tendangnhap']." - ".ngaythangnam($rowdanhgia['ngaybinhluan'])."</div>
						<div class='binhluan-sodiem'>".$str."</div>
						<div class='binhluan-chitiet'>".$rowdanhgia['binhluan']."</div>
					</div>";
							}
						?>			
			</div>
		</div>	
	</div>
</form>
<script type="text/javascript" language="javascript">
  CKEDITOR.replace( 'chitiet', {
	uiColor: '#d1d1d1'
});
</script>
