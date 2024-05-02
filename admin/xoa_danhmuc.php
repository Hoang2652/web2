<?php
if(isset($_GET['iddanhmuc'])){
    $iddanhmuc = $_GET['iddanhmuc'];
    $sqlcheck = "select sanpham.iddanhmuc,danhmuc.tendanhmuc as name from sanpham inner join danhmuc where sanpham.iddanhmuc = danhmuc.iddanhmuc and danhmuc.iddanhmuc='".$iddanhmuc."' limit 0,1";
    $resultcheck = mysqli_query($link,$sqlcheck);
    if($row = mysqli_fetch_array($resultcheck)){
        echo "<script>
        alert('Không thể xóa danh mục \'".$row['name']."\' vì đang có sản phẩm mang danh mục này.');
        window.open('admin.php?admin=hienthidm','_self', 1);
        </script>";
    } else {
        $sql = "select tendanhmuc from danhmuc where iddanhmuc = '".$iddanhmuc."'";
        $result = mysqli_query($link,$sql);
        $row2 = mysqli_fetch_array($result);
        $delete = "delete from danhmuc where iddanhmuc='".$iddanhmuc."'";
        if (mysqli_query($link,$delete)){
            echo "<script>
            alert('Xóa danh mục \'".$row2['tendanhmuc']."\' thành công.');
            window.open('admin.php?admin=hienthidm','_self', 1);
            </script>";
        }
    }
}
?>
