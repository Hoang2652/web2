<?php
include "include/connect.php";
if(isset($_GET['q']))
{
    $q = $_GET["q"];
    $sql="select * FROM sanpham WHERE (tensanpham like '%".$q."%' OR idsanpham like '%".$q."%') AND trangthai='1' LIMIT 6 ";
    $result = mysqli_query($link,$sql);

    echo "<div id='xuatlivesreach'>";   
    if(mysqli_num_rows($result)!=0){
        echo "
        <table class='tablelivesreach'>
            <thead>
                <tr>
                <th width='40px'>ID</th>
                <th id='header-hinhsp'></th>
                <th id='header-tensp'>Tên sản phẩm</th>
                <th>Giá tiền</th>
                </tr>
            </thead>    
            <tbody>";
    
        while($row = mysqli_fetch_array($result)) {            
        echo "<tr class='table-content'>";
        echo "<td><a href='index.php?content=chitietsp&idsanpham=".$row['idsanpham']."'><font color='blue'><b>" .$row['idsanpham']. "</b></font></a></td>";
        echo "<td><a href='index.php?content=chitietsp&idsanpham=".$row['idsanpham']."'><img src=\"img/uploads/" .$row['hinhanh']. "\"</a></td>";
        echo "<td><a href='index.php?content=chitietsp&idsanpham=".$row['idsanpham']."'><font color='black'>" .$row['tensanpham']. "</font></a></td>";
        echo "<td><a href='index.php?content=chitietsp&idsanpham=".$row['idsanpham']."'><font color='red'><b>" .$row['gia']. "</b></font></a></td>";        
        echo "</tr>";
        }

        echo "</tbody>
        </table>";
    } else {
        echo "Không có sản phẩm cần tìm";
    }
    echo "</div>";
}
    /*if(mysqli_num_rows($result)>=5){
        echo "<div> Và rất nhiều kết quả khác nữa.</div>"
    }*/
?>