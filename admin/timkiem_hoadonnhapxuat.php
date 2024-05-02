<?php 
include('../include/connect.php');
include('function/function.php');
if(isset($_GET['keytimkiem_hangtonkho']) && isset($_GET['idkhohang']))
{
    $q = $_GET["keytimkiem_hangtonkho"];
    $sql1 = mysqli_query($link,"SELECT * FROM sanpham,vitrikhohang,vitrisanpham WHERE (sanpham.idsanpham like '%".$q."%' OR sanpham.tensanpham like '%".$q."%') AND vitrisanpham.idsanpham=sanpham.idsanpham AND vitrikhohang.idvitrikhohang = vitrisanpham.idvitrikhohang AND sanpham.idkhohang=".$_GET['idkhohang']);
    $sql2 = mysqli_query($link,"SELECT * FROM sanpham WHERE (sanpham.idsanpham like '%".$q."%' OR sanpham.tensanpham like '%".$q."%') AND sanpham.idkhohang=".$_GET['idkhohang']);

    if(($sql1 && mysqli_num_rows($sql1)!=0)){
        while ($bien = mysqli_fetch_array($sql1)){ ?>
                            <tr class='noidung_hienthi_sp' style="<?php if( $bien['trangthai'] > "1") echo "opacity: 0.4;";?>">
                                <td class='masp_hienthi_sp' rowspan=$displayRowSpan><?php echo $bien['tenvitrikhohang']; ?></td> 
                                <td class="masp_hienthi_sp"><?php  echo $bien['tensanpham'] ?></td>
                                <td class="masp_hienthi_sp"><?php  echo $bien['idsanpham'] ?></td>
                                <td class="stt_hienthi_sp"><?php echo $bien['soluong'] ?></td>
                                <td class="sl_hienthi_sp"><?php echo $bien['gia'] ?></td>
                                <td class="sl_hienthi_sp"><?php if( $bien['trangthai'] > "1") echo "Chưa thể bán"; else echo "sãn sàng bán"?></td>
                                <td class="active_hienthi_sp" style="width:70px;">
                                    <a href="admin.php?admin=xulyhangtonkho&submit-formchinhsuasanphamtonkho=<?php echo $bien['idsanpham']; ?>&idkhohang=<?php echo $_GET['idkhohang']; ?>"><i class="fas fa-info-circle" style='transform: scale(1.5); color: #007bff;'></i></a>                    
                                </td>
                            </tr>
        <?php }
    }
    if($sql2 && mysqli_num_rows($sql2)!=0){
        while ($bien2 = mysqli_fetch_array($sql2))
        if(mysqli_num_rows(mysqli_query($link,"select * from vitrisanpham where idsanpham = ".$bien2['idsanpham']." LIMIT 0,1")) == 0){
?>
                            <tr class='noidung_hienthi_sp' style="<?php if( $bien2['trangthai'] > "1") echo "opacity: 0.4;";?>">
                                <td class="masp_hienthi_sp"><?php echo "<font color='red'>Chưa có vị trí</font>";?></td>
                                <td class="masp_hienthi_sp"><?php  echo $bien2['tensanpham'] ?></td>
                                <td class="masp_hienthi_sp"><?php  echo $bien2['idsanpham'] ?></td>                        
                                <td class="stt_hienthi_sp"><?php echo $bien2['soluong'] ?></td>
                                <td class="sl_hienthi_sp"><?php echo $bien2['gia'] ?></td>
                                <td class="sl_hienthi_sp"><?php if( $bien2['trangthai'] > "1") echo "Chưa thể bán"; else echo "sãn sàng bán"?></td>
                                <td class="active_hienthi_sp" style="width:70px;">
                                    <a href="admin.php?admin=xulyhangtonkho&submit-formchinhsuasanphamtonkho=<?php echo $bien2['idsanpham']; ?>&idkhohang=<?php echo $_GET['idkhohang']; ?>"><i class="fas fa-info-circle" style='transform: scale(1.5); color: #007bff;'></i></a>
                                </td>
                            </tr>
        <?php 
        }
    }
else echo "<tr height='120px'><td colspan='99'>Hiện tại kho hàng này chưa có sản phẩm</td></tr>";
} else if (isset($_GET['keytimkiem_hoadonnhapxuat'])){
    $q = $_GET["keytimkiem_hoadonnhapxuat"];
    $sql = mysqli_query($link,"SELECT * FROM hoadonnhapxuatkho WHERE idhoadonnhapxuatkho like '%".$q."%' ORDER by idhoadonnhapxuatkho DESC");
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
}
?>