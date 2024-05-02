<?php 
// Use in noitce!!!!!!!!
   function mysqli_result($res, $row, $field=0) {
    $res->data_seek($row);
  $datarow = $res->fetch_array();
  return $datarow[$field];
}

include 'function/function.php';
include("../include/connect.php");
$sourcesql = "select * from sanpham";
$querysourcesql = mysqli_query($link,$sourcesql);
while($row = mysqli_fetch_array($querysourcesql)){
  $row2 = mysqli_fetch_array(mysqli_query($link,"select * from sanphamtonkho,hoadonnhapxuatkho,khohang where 
  sanphamtonkho.idhoadonnhapxuatkho = hoadonnhapxuatkho.idhoadonnhapxuatkho
  AND (hoadonnhapxuatkho.diachinhapkho = khohang.diachikhohang OR hoadonnhapxuatkho.diachixuatkho = khohang.diachikhohang) LIMIT 0,1"));
  mysqli_query($link,"UPDATE sanpham SET idkhohang = '".$row2['idkhohang']."' WHERE `sanpham`.`idsanpham` = ".$row['idsanpham']);
}
?>

function mysqli_result($res, $row, $field=0) {
    $res->data_seek($row);
  $datarow = $res->fetch_array();
  return $datarow[$field];
}




// SOURCE ADD IDHOADONNHAPXUATKHO TO SANPHAM FROM SANPHAMTONKHO
include 'function/function.php';
include("../include/connect.php");
$sourcesql = "select * from sanpham";
$querysourcesql = mysqli_query($link,$sourcesql);
while($row = mysqli_fetch_array($querysourcesql)){
  $row2 = mysqli_fetch_array(mysqli_query($link,"select * from sanphamtonkho where idsanpham=".$row['idsanpham']));
  mysqli_query($link,"UPDATE sanpham SET idhoadonnhapxuatkho = '".$row2['idhoadonnhapxuatkho']."' WHERE `sanpham`.`idsanpham` = ".$row['idsanpham']);
}


//SOURCE ADD KHUYENMAI TO CHITIETHOADON
include 'function/function.php';
include("../include/connect.php");
$sourcesql = "select * from chitiethoadon";
$querysourcesql = mysqli_query($link,$sourcesql);
while($row = mysqli_fetch_array($querysourcesql)){
  $row2 = mysqli_fetch_array(mysqli_query($link,"select * from sanpham where idsanpham=".$row['idsanpham']));
  mysqli_query($link,"UPDATE chitiethoadon SET tensanpham = '".$row2['tensanpham']."',`gia` = '".$row2['gia']."' WHERE `chitiethoadon`.`idchitiethoadon` = ".$row['idchitiethoadon']);
}

// SOURCE 1ST TIME SANPHAMTONKHO
include 'function/function.php';
include("../include/connect.php");
$ngay=date("Y").":".date("m").":".date("d").":".date("H").":".date("i").":".date("s");
$sourcesql = "select * from sanpham where iddanhmuc='1'";
$querysourcesql = mysqli_query($link,$sourcesql);
while($row = mysqli_fetch_array($querysourcesql)){
    mysqli_query($link,"INSERT INTO sanphamnhapxuatkho VALUES('13','".$row['idsanpham']."','".$row['tensanpham']."','".$row['soluong']."','chiếc','".$row['gia']."')");
}