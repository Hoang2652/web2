<link rel="stylesheet" href="css/hienthi_sp.css">
<script type="text/javascript" src="js/checkbox.js"></script>
<?php
	include ('../include/connect.php');
	
    $select = "select * from sanpham inner join danhmuc on sanpham.iddanhmuc=danhmuc.iddanhmuc order by idsanpham DESC";
    $query = mysqli_query($link,$select);
    $dem = mysqli_num_rows($query);
?>
<div class="quanlysp">
	<h3>QUẢN LÝ SẢN PHẨM</h3>
    <p style="float:right;">Có tổng cộng:<font color=red><b><?php echo $dem ?></font> sản phẩm</b></p>
    <form action="admin.php?admin=xulysp" method="post" onsubmit="return deleteconfirm()" style="width: 100%;">
    <div class="live-search form-row">
		<div class="col-md-3 mb-3 sreachsanpham">
			<label><i class="fas fa-search"></i> Tìm kiếm sản phẩm</label>
            <input type="text" class="form-control" name="timkiem" placeholder="Nhập id, tên sản phẩm" onkeyup="timkiemtructiep(this.value,'sanpham')">
        </div>
        <div class="col-md-6 mb-3 pl-4 form-row thaotac">
            <div class="col-md-5 mb-3">
                <div class='themsanpham' style="margin-top: 32px; border: none"><a href='?admin=themsp' class="btn btn-primary">Thêm sản phẩm</a></div>
            </div>
            <div class="col-md-5 mb-3">
                <button class="btn btn-primary" type="submit" name="hide" value="Ẩn / Hủy ẩn" style="margin-top: 32px;">Ngưng bán / Mở bán</button>
            </div>
        </div>
    </div>
<div class='content-table scb'>
	<table>
        <thead>
            <tr class='tieude_hienthi_sp'>
                <th width="30"><input type="checkbox" name="check"  class="checkbox" onclick="checkall('item', this)"></th>
                <th>ID</th>
                <th>Hình ảnh</th>
		        <th style="width: 350px;">Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đã bán</th>
                <th style="width: 110px;">Giá</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody id="row-sanpham">
    <?php
		$sql = mysqli_query($link,"SELECT * FROM sanpham left join danhmuc on sanpham.iddanhmuc=danhmuc.iddanhmuc ORDER by idsanpham DESC"); 				
    if($dem > 0)
        while ($bien = mysqli_fetch_array($sql))
        {
	?>
            <tr class='noidung_hienthi_sp'>
                <td class="masp_hienthi_sp"><input type="checkbox" name="id[]" class="item" class="checkbox" value="<?=$bien['idsanpham']?>"/></td>
                <td class="masp_hienthi_sp"><?php  echo $bien['idsanpham'] ?></td>
                <td class="img_hienthi_sp"><img src="../img/uploads/<?php echo $bien['hinhanh'] ?>"  width='62px' height='62px'></td>
                <td class="img_hienthi_sp"><?php echo $bien['tensanpham'] ?></td>
				<td class="sl_hienthi_sp"><?php echo $bien['soluong'] ?></td>
				<td class="sl_hienthi_sp"><?php echo $bien['daban'] ?></td>
                <td class="gia_hienthi_sp"><?php echo number_format($bien['gia']).' VNÐ' ?></td>
                <td  class="madm_hienthi_sp"> <?=$bien['tendanhmuc'] ?></td>
                <td  class="madm_hienthi_sp"><?php
                if($bien['trangthai']==1)
                    echo "<font color='blue'>Mở bán</font>";
                else
                    echo "<font color='red'>Không mở bán</font>";

                ?>
                </td>
                <td class="active_hienthi_sp">
                    <a href='admin.php?admin=suasp&idsanpham=<?php echo $bien['idsanpham']  ?>'><i class="fas fa-tools" style="transform: scale(1.5); color: #007bff;"></i></a>
                    <div onclick="checkdelsanpham(<?php echo $bien['idsanpham']?>)"><i class="fas fa-trash-alt" style="transform: scale(1.5); color: red;" ></i></div>
				</td>
            </tr>
	<?php 	
	    }

	    else echo "<tr><td colspan='10'>Không có sản phẩm trong CSDL</td></tr>";
	
	?>
        </tbody>
	</table>
</div>
    </div>
    </form>

