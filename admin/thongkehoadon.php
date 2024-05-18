<?php 
include 'function/function.php';
include ('../include/connect.php');

if(isset($_POST['idnguoidung'])){
    $userId = $_POST['idnguoidung'];
    $data = [];
    $sql = "select * from hoadon where idnguoidung = ". $userId;
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result)){
        while($row = mysqli_fetch_array($result)){
            $trangthai_string = "";
            $phuongthucthanhtoan_string = "";
            if($row['trangthai']==1) $trangthai_string = "Chưa xử lý"; 
            else if($row['trangthai']==2) $trangthai_string = "Đã giao hàng"; 
            else $trangthai_string = "Đã hủy đơn hàng";
            if($row['phuongthucthanhtoan']==2) $phuongthucthanhtoan_string = "Chuyển khoản";
            else $phuongthucthanhtoan_string = "Tiền mặt";
            $data[] = array(
                'idhoadon' => $row['idhoadon'],
                'diachi' => $row['diachi'],
                'dienthoai' => $row['dienthoai'],
                'phuongthucthanhtoan' => $phuongthucthanhtoan_string,
                'ngaydathang' => $row['ngaydathang'],
                'trangthai' => $trangthai_string,
            );
        }
        echo $json_data = json_encode($data);
    }
}

?>