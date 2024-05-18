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

if(isset($_POST['selectTime1'])){
    $time = $_POST['selectTime1'];
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
        case "999d":
            $past = date('y-m-d',mktime(0, 0, 0, date("m")  , date("d")-2999, date("Y")));
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
        case "999d":
            $past = date('y-m-d',mktime(0, 0, 0, date("m")  , date("d")-2999, date("Y")));
            break;
    }

    // Calculate sum of all bills on each day
    $chart_data = [];
    $user_sql = "select distinct hoadon.idnguoidung, nguoidung.tennguoidung from hoadon inner join nguoidung on nguoidung.idnguoidung = hoadon.idnguoidung";
    $user_result = mysqli_query($link,$user_sql);
    if(mysqli_num_rows($user_result)){
        while($user_row = mysqli_fetch_array($user_result)){
            $sql = "select ngaydathang,idhoadon,idnguoidung from hoadon where ngaydathang between '".$past."' and '".$present."' and idnguoidung = " . $user_row['idnguoidung']. " order by ngaydathang ASC";
            $result = mysqli_query($link,$sql);
            if(mysqli_num_rows($result)){
                while($row = mysqli_fetch_array($result)){
                    $subsql = "select chitiethoadon.soluong,chitiethoadon.gia from chitiethoadon where idhoadon = ".$row['idhoadon'];
                    $subresult = mysqli_query($link,$subsql);
                    $doanhthu = 0;
                    while($subrow = mysqli_fetch_array($subresult))
                    $doanhthu += $subrow['gia']*$subrow['soluong'];
                    array_push($chart_data, array(
                        'idnguoidung' => $row['idnguoidung'],
                        'tennguoidung' => $user_row['tennguoidung'],
                        'idhoadon' => $row['idhoadon'],
                        'sales' => $doanhthu
                    ));
                }
            }
        }
        echo $data = json_encode(calculateSalesPerUser($chart_data));
    } else {
        $chart_data[] = array('message' => "Không có kết quả ghi nhận");
        echo $data = json_encode($chart_data);
    }
}

if(isset($_POST['inputfromdate1']) && isset($_POST['inputtodate1'])){
    $fromdate = $_POST['inputfromdate1'];
    $todate = $_POST['inputtodate1'];

    // Calculate sum of all bills on each day
    $chart_data = [];
    $user_sql = "select distinct hoadon.idnguoidung, nguoidung.tennguoidung from hoadon inner join nguoidung on nguoidung.idnguoidung = hoadon.idnguoidung";
    $user_result = mysqli_query($link,$user_sql);
    if(mysqli_num_rows($user_result)){
        while($user_row = mysqli_fetch_array($user_result)){
            $sql = "select ngaydathang,idhoadon,idnguoidung from hoadon where ngaydathang between '".$fromdate."' and '".$todate."' and idnguoidung = " . $user_row['idnguoidung']. " order by ngaydathang ASC";
            $result = mysqli_query($link,$sql);
            if(mysqli_num_rows($result)){
                while($row = mysqli_fetch_array($result)){
                    $subsql = "select chitiethoadon.soluong,chitiethoadon.gia from chitiethoadon where idhoadon = ".$row['idhoadon'];
                    $subresult = mysqli_query($link,$subsql);
                    $doanhthu = 0;
                    while($subrow = mysqli_fetch_array($subresult))
                    $doanhthu += $subrow['gia']*$subrow['soluong'];
                    array_push($chart_data, array(
                        'idnguoidung' => $row['idnguoidung'],
                        'tennguoidung' => $user_row['tennguoidung'],
                        'idhoadon' => $row['idhoadon'],
                        'sales' => $doanhthu
                    ));
                }
            }
        }
        echo $data = json_encode(calculateSalesPerUser($chart_data));
    } else {
        $chart_data[] = array('message' => "Không có kết quả ghi nhận");
        echo $data = json_encode($chart_data);
    }
}



function isUserExistInArray($userId, $array){
    if(count($array) == 0){
        return false;
    }

    foreach($array as $temp){
        // echo "next step, compare temp = " . $temp . " with userId = " . $userId;
        if((int)$temp == (int)$userId){
            return true;
        }
    }
    return false;
}

function calculateSalesPerUser($input) {
    $salesPerUser = [];
    $addedToArrayUser = [];
        foreach ($input as $row) {
            $userId = $row['idnguoidung'];
            $username = $row['tennguoidung'];
            $billID = $row['idhoadon'];
            $sales = $row['sales'];
            if(isUserExistInArray($userId, $addedToArrayUser)){
                for($i = 0; $i < sizeof($salesPerUser); $i++){
                    if( $salesPerUser[$i] -> userId == $userId){
                        $salesPerUser[$i]->sales += $sales;
                        break;
                    }
                }
            } else {
                array_push($addedToArrayUser, $userId);
                array_push($salesPerUser, (object) array(
                    'userId' => $userId ,
                    'username' => $username,
                    'sales' => $sales,
                    'billID' => $billID
                ));
            }
    }
    return $salesPerUser;
}
?>

