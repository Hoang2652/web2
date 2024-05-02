<link rel="stylesheet" href="css/hienthi_sp.css">
<script type="text/javascript" src="js/checkbox.js"></script>
<?php
	include ('../include/connect.php');
	
    $select = "select * from hoadonnhapxuatkho";
    $query = mysqli_query($link,$select);
    $dem = mysqli_num_rows($query);
?>

<div class="quanlykhohang">
	<h3>QUẢN LÝ KHO HÀNG (QUẢN LÝ NHẬP XUẤT)</h3>
    <form action="admin.php?admin=xulynhapxuatkhohang" method="post" style="width:100%;">
        <div class="live-search form-row">
            <div class="col-md-3 mb-3 sreachsanpham">
                <label><i class="fas fa-search"></i> Tìm kiếm hóa đơn...</label>
                <input type="text" class="form-control" name="timkiem" placeholder="Nhập id hóa đơn" onkeyup="timkiemtructiep(this.value,'hoadonnhapxuat')">
            </div>
            <div class="form-row col-md-2 mb-3 mr-1 ml-1">
                <div>
                    <a href='?admin=xulynhapxuatkhohang&nhapxuat=nhap' class="btn btn-primary mg-3">Thêm hóa đơn nhập kho</a>
                </div>
            </div>
            <div class="form-row col-md-2 mb-3 mr-1">
                <div>
                    <a href='?admin=xulynhapxuatkhohang&nhapxuat=xuat' class="btn btn-primary mg-3">Thêm hóa đơn xuất kho</a>
                </div>
            </div>
            <div class="col-md-3 mb-3 form-row">
                <label>Cập nhật trạng thái:</label>
                <div style="border: none;width: 280px;">
                    <button class="btn btn-primary" type="submit" name="dagiaohang">Đã giao hàng</button>
                    <button class="btn btn-danger" type="submit" name="dabihuy">Hủy đơn hàng</button>
                </div>
             </div>
        </div>
        <div class='content-table scb'>
            <table>
                <thead>
                    <tr class='tieude_hienthi_sp'>
                        <th width="30"><input type="checkbox" name="check"  class="checkbox" onclick="checkall('item', this)"></th>
                        <th>ID hóa đơn</th>
                        <th style="width: 130px;">Đối tác</th>
                        <th style="width: 100px;">Loại hóa đơn</th>
                        <th style="width: 350px;">Ngày nhập/xuất</th>
                        <th style="width: 90px;">Trạng thái</th>
                        <th colspan=2 style="width: 90px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="row-sanpham">
                <?php
                    $sql = mysqli_query($link,"SELECT * FROM hoadonnhapxuatkho ORDER by idhoadonnhapxuatkho DESC");
                    if(mysqli_num_rows($sql)!=0)
                    while ($bien = mysqli_fetch_array($sql))
                    {
                ?>
                        <tr class='noidung_hienthi_sp'>
                            <td class="masp_hienthi_sp"><input type="checkbox" name="idhoadonhapxuat[]" class="item" class="checkbox" value="<?=$bien['idhoadonnhapxuatkho']?>"></td>
                            <td class="masp_hienthi_sp"><?php  echo $bien['idhoadonnhapxuatkho'] ?></td>
                            <td class="stt_hienthi_sp"><?php echo $bien['tendoitac'] ?></td>
                            <td class="sl_hienthi_sp"><?php echo $bien['loaihoadon'] ?></td>
                            <td class="sl_hienthi_sp"><?php echo ngaythangnam($bien['ngaynhapxuat']) ?></td>
                            <td class="sl_hienthi_sp"><?php echo $bien['trangthai'] ?></td>
                            <td class="active_hienthi_sp" style="width:70px;">
                                <a href="admin.php?admin=chitiethoadonnhapxuatkho&idhoadonnhapxuatkho=<?php echo $bien['idhoadonnhapxuatkho']; ?> "><i class="fas fa-info-circle" style='transform: scale(1.5); color: #007bff;'></i></a>
                                <div onclick="checkdelhoadonnhapxuatkho(<?php echo $bien['idhoadonnhapxuatkho']?>)"><i class="fas fa-trash-alt" style="transform: scale(1.5); color: red;" ></i></div>
                            </td>
                        </tr>
                <?php 
                }
                else echo "<tr><td colspan='99'>Hiện tại chưa có hóa đơn nhập xuất</td></tr>";
                ?>
                </tbody>
            </table>
        </div>
    </form>
</div>