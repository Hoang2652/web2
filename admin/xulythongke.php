<?php 
include 'function/function.php';
include ('../include/connect.php');

if(isset($_POST['time'])){
    $time = $_POST['time'];
    $present = date('y-m-d');
    switch($time){
        case "1d":
            $past = date('y-m-d');
            break;
        case "7d":
            $past = date('y-m-d',mktime(0, 0, 0, date("m")  , date("d")-7, date("Y")));
            break;
        case "30d":
            $past = date('y-m-d',mktime(0, 0, 0, date("m")  , date("d")-30, date("Y")));
            break;
        case "365d":
            $past = date('y-m-d',mktime(0, 0, 0, date("m")  , date("d")-365, date("Y")));
            break;
    }

    $sql = "select ngaydathang,idhoadon from hoadon where ngaydathang between '".$past."' and '".$present."' order by ngaydathang ASC";
    $result = mysqli_query($link,$sql);
    while($row = mysqli_fetch_array($result)){
        $subsql = "select chitiethoadon.idsanpham,chitiethoadon.soluong,chitiethoadon.gia from chitiethoadon inner join sanpham where chitiethoadon.idsanpham = sanpham.idsanpham and idhoadon = ".$row['idhoadon'];
        $subresult = mysqli_query($link,$subsql);
        $doanhthu = 0;
        while($subrow = mysqli_fetch_array($subresult))
        $doanhthu += $subrow['gia']*$subrow['soluong'];
        $chart_data[] = array(
            'date' => $row['ngaydathang'],
            'sales' => $doanhthu
        );
    }
    echo $data = json_encode($chart_data);
}


if(isset($_POST['inputfromdate']) && isset($_POST['inputtodate'])){
    $fromdate = $_POST['inputfromdate'];
    $todate = $_POST['inputtodate'];
   
    $sql = "select ngaydathang,idhoadon from hoadon where ngaydathang between '".$fromdate."' and '".$todate."' order by ngaydathang ASC";
    $result = mysqli_query($link,$sql);
    while($row = mysqli_fetch_array($result)){
        $subsql = "select chitiethoadon.idsanpham,chitiethoadon.soluong,chitiethoadon.gia from chitiethoadon inner join sanpham where chitiethoadon.idsanpham = sanpham.idsanpham and idhoadon = ".$row['idhoadon'];
        $subresult = mysqli_query($link,$subsql);
        $doanhthu = 0;
        while($subrow = mysqli_fetch_array($subresult))
        $doanhthu += $subrow['gia']*$subrow['soluong'];
        $chart_data[] = array(
            'date' => $row['ngaydathang'],
            'sales' => $doanhthu
        );
    }
    echo $data = json_encode($chart_data);
}

if(isset($_POST['selectTime'])){
    $time = $_POST['selectTime'];
    $present = date('y-m-d');
    switch($time){
        case "1d":
            $past = date('y-m-d');
            break;
        case "7d":
            $past = date('y-m-d',mktime(0, 0, 0, date("m")  , date("d")-7, date("Y")));
            break;
        case "30d":
            $past = date('y-m-d',mktime(0, 0, 0, date("m")  , date("d")-30, date("Y")));
            break;
        case "365d":
            $past = date('y-m-d',mktime(0, 0, 0, date("m")  , date("d")-365, date("Y")));
            break;
    }

    $sql = "select sp.idsanpham, sp.hinhanh, sp.tensanpham, SUM(cthd.soluong) as total_quantity, SUM(cthd.gia * cthd.soluong) as total_revenue
            from chitiethoadon cthd INNER JOIN sanpham sp on cthd.idsanpham = sp.idsanpham 
            INNER JOIN ( select ngaydathang, idhoadon from hoadon where ngaydathang between '".$past."' AND '".$present."') hd on cthd.idhoadon = hd.idhoadon 
            group by  sp.idsanpham,  sp.tensanpham ORDER BY total_revenue DESC";
    $result = mysqli_query($link,$sql);
    if ($result) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo 'Lỗi truy vấn dữ liệu';
    }
}
?>

