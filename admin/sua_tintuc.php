<link rel="stylesheet" href="css/them_sanpham.css">
<?php
		$idtintuc=$_GET['idtintuc'];
        $sql="select * from tintuc where idtintuc='".$_GET['idtintuc']."'";
         $rows=mysqli_query($link,$sql);
         $row=mysqli_fetch_array($rows);
?>
<form action="update_tintuc.php?idtintuc=<?php echo $idtintuc;?>" method="post" name="frm" onsubmit="" enctype="multipart/form-data" class="form-suatintuc">
    <div class="dangky">	
        <table>
            <div class="tabs">
				<div style="text-align: center; font-weight: bold;">SỬA TIN TỨC</div>
			</div>
			<div class="form-row mb-3">			
				<div class="col-md-8"> 
					<label for="tendangnhap">Tiêu đề  </label>
					<input type="text" name="tieude" class="form-control  col-sm-10" value="<?php echo $row['tieude'];?>"/>
				</div>
				<div class="col-md-4">
					<label for="tennguoidung">Tác giả</label>
					<input type="text" name="tacgia" class="form-control col-sm-12"value="<?php echo $row['tacgia'];?>"/>
				</div>
			</div>
            <div class="form-row mb-3">			
				<div class="col-md-6"> 
					<label for="hinhanh">Hình ảnh  </label>
                    <br />	
                    <img src="../img/tintuc/<?=$row['hinhanh']?>" width="340" height="300"/>
                    <br />	
                    <br />	
					<input type="file" name="hinhanh" class="form-control-file"/>
				</div>
			</div>
			<div class="form-row mb-3">			
				<div class="col-md-12"> 
					<label for="noidungngan">Nội dung ngắn </label>
					<textarea name="noidungngan" class="form-control nd-ngan">
                        <?php echo $row['noidungngan'];?>
                    </textarea>
				</div>
			</div>	
			<div class="mb-3">
				<label for="chitiet">Nội dung chi tiết</label>
				<div>
					<textarea name="noidungchitiet" id="chitiet">
                        <?php echo $row['noidungchitiet'];?>
                    </textarea>
				</div>
			</div>
            <div class="form-group row" style="margin-top: 2rem;"> 
			    <input class="btn btn-primary" style="margin:auto;" type="submit" name="submit" name="update" value="Sửa tin tức" />
			    <input class="btn btn-danger" style="margin:auto; margin-right: 10rem" type="reset" name="" value="Về mặc định" />
		    </div>
        </table> 
    </div>
</form>
<script type="text/javascript" language="javascript">
 
  CKEDITOR.replace( 'chitiet', {
	uiColor: '#d1d1d1'
});
</script>