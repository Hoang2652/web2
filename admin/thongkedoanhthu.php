<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<link rel="stylesheet" href="css/hienthi_sp.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<div class="quanlysp">
	<h3>THỐNG KÊ DOANH THU THEO THỜI GIAN</h3>
    <div class="khungbang" style="margin-top: 20px;">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="inputCity">Từ ngày:</label>
                    <input type="date" class="form-control" id="inputfromdate">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">Đến ngày:</label>
                    <input type="date" class="form-control" id="inputtodate" name="khoangthoigian">
                </div>
                <div class="form-group col-md-2" style="margin-top:32px;">
                <button id="btn-thongke" class="btn btn-primary" style="display: inline-block;">Thống kê</button>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">Theo mốc thời gian:</label>
                    <select id="select-thongke" class="custom-select">
                        <option value="1d" selected>Hôm nay</option>
                        <option value="7d">7 ngày trước</option>
                        <option value="30d">30 ngày trước</option>
                        <option value="365d">1 năm trước</option>
                    </select>
                </div> 
            </div>
        <div id="doanhthuchart" style="height: 250px;"></div>
        <div id="tenchart" style="display:inline-block;">Biểu đồ thống kê doanh thu:</div><div id="tenchart-change" style="display:inline-block; padding-left:10px;"></div>.
    </div>
    <div>
        <div>
            <h3>THỐNG KÊ SẢN PHẨM BÁN CHẠY THEO THỜI GIAN</h3>
        </div>
        <div>
            <div class="form-group col-md-2">
                <label for="inputState">Chọn thời gian:</label>
                <select id="select-time" class="custom-select">
                    <option value="1d" selected>Hôm nay</option>
                    <option value="7d">7 ngày trước</option>
                    <option value="30d">30 ngày trước</option>
                    <option value="365d">1 năm trước</option>
                </select>
            </div> 
        </div>
        <div id="result" class='content-table scb'></div>
    </div>
</div>


<script type="text/javascript">
        $(document).ready(function(){
            function ngaythangnam(namthangngay){
                if(namthangngay!="")
                {
                var datearr = namthangngay.split("-", 3);
                var ntn = datearr[2]+"-"+datearr[1]+"-"+datearr[0];
                }		
                return ntn;
                
            }

            taixongthongke();
            var chart = new Morris.Area({
                element: 'doanhthuchart',

                data:[{date: "Hôm nay chưa có doanh thu", sales: 0}],

                xkey: 'date',

                ykeys: ['sales'],

                labels: ['Doanh thu']
            });

            function taixongthongke(){
                $.ajax({
                    url:"xulythongke.php",
                    method:"POST",
                    dataType:"JSON",
                    data:{time: "1d"},
                    success:function(data) {
                        chart.setData(data);
                        $('#tenchart-change').text('Hôm nay');
                    }
                });
            }

            function formatNumber(num) {
                var numStr = num.toString();
                var splitNum = numStr.split('.');
                var wholeNum = splitNum[0];
                var decimalNum = (splitNum[1] !== undefined) ? '.' + splitNum[1] : '';
                var pattern = /(-?\d+)(\d{3})/;
                while (pattern.test(wholeNum)) {
                    wholeNum = wholeNum.replace(pattern, "$1,$2");
                }
                return wholeNum + decimalNum + ' VNĐ';
            }

            $('#select-thongke').change(function(){
                var time = document.getElementById('select-thongke').value;

                switch(time){
                    case '1d':
                    $('#tenchart-change').text('Hôm nay');
                    break;
                    case '7d':
                    $('#tenchart-change').text('7 ngày trước');
                    break;
                    case '30d':
                    $('#tenchart-change').text('30 ngày trước');
                    break;
                    case '365d':
                    $('#tenchart-change').text('365 ngày trước');
                    break;
                };

                $.ajax({
                    url:"xulythongke.php",
                    method:"POST",
                    dataType:"JSON",
                    data:{time: time},
                    success:function(data) {
                        chart.setData(data);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert("Lỗi: " + textStatus + "\n" + errorThrown);
                    }
                });
            });

            $('#btn-thongke').click(function(){
                alert('ok da nhan');
                var inputfromdate =  document.getElementById('inputfromdate').value;
                var inputtodate =  document.getElementById('inputtodate').value;
                $('#tenchart-change').text('Từ ngày '+ngaythangnam(inputfromdate)+' đến ngày '+ngaythangnam(inputtodate));
                $.ajax({
                    url:"xulythongke.php",
                    method:"POST",
                    dataType:"JSON",
                    data:{inputfromdate: inputfromdate, inputtodate: inputtodate},

                    success:function(data) {
                        chart.setData(data);
                    }
                });
            });

            $('#select-time').change(function(){
                var selectTime = document.getElementById('select-time').value;

                $.ajax({
                    url:"xulythongke.php",
                    method:"POST",
                    dataType:"JSON",
                    data:{selectTime: selectTime},
                    success:function(data) {
                        var table = "<table>";
                        table += "<thead><tr class='tieude_hienthi_sp'><th>ID sản phẩm</th><th>Hình ảnh</th><th>Tên sản phẩm</th><th>Số lượng bán</th><th>Doanh thu</th></tr></thead>";
                        for (var i = 0; i < data.length; i++) {
                            table += "<tr>";
                            table += "<td>" + data[i].idsanpham + "</td>";
                            table += "<td class='img_hienthi_sp'><img src='../img/uploads/" + data[i].hinhanh + "' width='62px' height='62px'></td>";
                            table += "<td>" + data[i].tensanpham + "</td>";
                            table += "<td>" + data[i].total_quantity + "</td>";
                            table += "<td>" + formatNumber(data[i].total_revenue) + "</td>";
                            table += "</tr>";
                        }
                        table += "</table>";
                        
                        // Gán bảng vào phần tử #result
                        $('#result').html(table);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert("Lỗi: " + textStatus + "\n" + errorThrown);
                    }
                });
            });
        });
</script>


