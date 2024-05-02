<?php
if(isset($_GET['idnguoidung'])){
    $idnguoidung = $_GET['idnguoidung'];
    $sqlcheck = "select idhoadon from hoadon where idnguoidung ='".$idnguoidung."' limit 0,1";
    $resultcheck = mysqli_query($link,$sqlcheck);
    if($row = mysqli_fetch_array($resultcheck)){
        echo "<script>
        alert('Không thể xóa thành viên có id: \'".$idnguoidung."\' vì đã có liên kết với hóa đơn');
        window.open('admin.php?admin=hienthind','_self', 1);
        </script>";
    } else {
        $delete = "delete from nguoidung where idnguoidung='".$idnguoidung."'";
        if (mysqli_query($link,$delete)){
            echo "<script>
            alert('Xóa thành viên có id: \'".$idnguoidung."\' thành công.');
            window.open('admin.php?admin=hienthind','_self', 1);
            </script>";
        }
    }
}
?>
