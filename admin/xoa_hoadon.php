<?php
if(isset($_GET['idhoadon'])){
    $idhoadon = $_GET['idhoadon'];
    $delete1 = "delete from hoadon where idhoadon='".$idhoadon."'";
    $result = mysqli_query($link,$delete1);
    $delete2 = "delete from chitiethoadon where idhoadon='".$idhoadon."'";
    if (mysqli_query($link,$delete2)){
        echo "<script>
        alert('Xóa hóa đơn id: \'".$idhoadon."\' thành công.');
        window.open('admin.php?admin=hienthihd','_self', 1);
        </script>";
    } else {
        echo "<script>
        alert('Xóa hóa đơn id: \'".$idhoadon."\' thất bại.');
        window.open('admin.php?admin=hienthihd','_self', 1);
        </script>";
    }
}
?>