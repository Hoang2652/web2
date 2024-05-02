<?php
if(isset($_GET['idsanpham'])){
    $idsanpham = $_GET['idsanpham'];
    $sqlcheck = "select sanpham.tensanpham as name,chitiethoadon.idsanpham from chitiethoadon inner join sanpham where sanpham.idsanpham = chitiethoadon.idsanpham and sanpham.idsanpham='".$idsanpham."' limit 0,1";
    $resultcheck = mysqli_query($link,$sqlcheck);
    if($row = mysqli_fetch_array($resultcheck)){
        echo "<script>
        alert('Không thể xóa sản phẩm \'".$row['name']."\' vì có hóa đơn mang chi tiết sản phẩm này');
        window.open('admin.php?admin=hienthisp','_self', 1);
        </script>";
    } else {
        $sqlrecommendcheck = mysqli_query($link,"select * from sanphamdecu where idsanpham='$idsanpham'");
        if(mysqli_num_rows($sqlrecommendcheck) > 0){
            mysqli_query($link,"DELETE FROM sanphamdecu WHERE idsanpham='$idsanpham' AND idsanphamdecu='3'");
            mysqli_query($link,"UPDATE sanphamdecu SET idsanpham='0' WHERE idsanpham='$idsanpham' AND idsanphamdecu='2'");
            mysqli_query($link,"UPDATE sanphamdecu SET idsanpham='0' WHERE idsanpham='$idsanpham' AND idsanphamdecu='1'");
        }
        $sql = "select tensanpham from sanpham where idsanpham = '".$idsanpham."'";
        $result = mysqli_query($link,$sql);
        $row2 = mysqli_fetch_array($result);
        $delete = "delete from sanpham where idsanpham='".$idsanpham."'";
        if (mysqli_query($link,$delete)){
            echo "<script>
            alert('Xóa sản phẩm \'".$row2['tensanpham']."\' thành công.');
            window.open('admin.php?admin=hienthisp','_self', 1);
            </script>";
        }
    }
}
?>
