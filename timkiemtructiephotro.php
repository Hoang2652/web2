<?php
include "include/connect.php";
if(isset($_GET['q']))
{
    $q = $_GET["q"];
    $sql="select * FROM traloicauhoi WHERE (noidungcauhoi like '%".$q."%') LIMIT 6";
    $result = mysqli_query($link,$sql);
    echo    "<div class='inner-list-question-hotro'>
            <ul class='list-group list-group-flush'>";
    if(mysqli_num_rows($result)!=0){
        while($row = mysqli_fetch_array($result))
            echo "<a href='index.php?content=chitiethotro&idcauhoi=".$row['idcauhoi']."'><li class='list-question'>".$row['noidungcauhoi']."</li></a>";
    } else {
        echo "<li class='list-group-item'>Không có hỗ trợ cần tìm</li>";
    }
    echo"</div>
    </div>";
}
    /*if(mysqli_num_rows($result)>=5){
        echo "<div> Và rất nhiều kết quả khác nữa.</div>"
    }*/
?>