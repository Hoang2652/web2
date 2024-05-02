<?php 
// Use in noitce!!!!!!!!
   function mysqli_result($res, $row, $field=0) {
    $res->data_seek($row);
  $datarow = $res->fetch_array();
  return $datarow[$field];
}

include 'function/function.php';
include("../include/connect.php");
$ngay=date("Y").":".date("m").":".date("d").":".date("H").":".date("i").":".date("s");
$sourcesql = "select * from sanpham";
$querysourcesql = mysqli_query($link,$sourcesql);
while($row = mysqli_fetch_array($querysourcesql)){
    mysqli_query($link,"INSERT INTO sanphamtonkho VALUES('".$row['idsanpham']."','".$row['tensanpham']."','".$row['soluong']."','".$row['gia']."','$ngay',0,0)");
}
?>