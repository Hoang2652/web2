<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>





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
                    <option value="999d">Toàn bộ</option>
                </select>
            </div> 
        </div>
        <div id="result2" class='content-table scb'></div>
    </div>

    <div>
        <div>
            <h3>THỐNG KÊ TOP 5 CHIẾN THẦN MUA HÀNG</h3>
        </div>
        <div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="inputCity">Từ ngày:</label>
                    <input type="date" class="form-control" id="inputfromdate1">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">Đến ngày:</label>
                    <input type="date" class="form-control" id="inputtodate1" name="khoangthoigian">
                </div>
                <div class="form-group col-md-2" style="margin-top:32px;">
                <button id="btn-thongke1" class="btn btn-primary" style="display: inline-block;">Thống kê</button>
                </div>
                <!-- <div class="form-group col-md-2">
                    <label for="inputState">Chọn thời gian:</label>
                    <select id="select-time" class="custom-select">
                        <option value="1d" selected>Hôm nay</option>
                        <option value="7d">7 ngày trước</option>
                        <option value="30d">30 ngày trước</option>
                        <option value="365d">1 năm trước</option>
                        <option value="999d" selected>Toàn thời gian</option>
                    </select>
                </div>  -->
            </div>
        </div>
        <div id="result" class='content-table scb'></div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Danh sách hóa đơn <div id="bill_quantity"><div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bill_detail">
      <div class="card" >
            <div class="card-body">
                <h5 class="card-title">Hóa đơn (id: 12713861)</h5>
                <h6 class="card-subtitle mb-2 text-muted">Ngày đặt hàng: 10/08/2024</h6>
                <p class="card-text mb-1">Địa chỉ: </p>
                <p class="card-text mb-1">Điện thoại: </p>
                <p class="card-text mb-1">Trang thái: đã giao.</p>
                <a href="#" class="card-link">Xem chi tiết</a>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

        $(document).ready(function(){

            // Do once after load complete
            $.ajax({
                    url:"xulythongke.php",
                    method:"POST",
                    dataType:"JSON",
                    data:{selectTime: '999d'},
                    success:function(data) {
                        data.sort((a, b) => parseFloat(b.sales) - parseFloat(a.sales));
                        var table = "<table>";
                        table += "<thead><tr class='tieude_hienthi_sp'><th>ID người dùng</th><th>Tên người dùng</th><th>Tổng số tiền mua</th><th>Thao tác</th></tr></thead>";
                        for (var i = 0; i < 5; i++) {
                            table += "<tr>";
                            table += "<td>" + data[i].userId + "</td>";
                            table += "<td >" + data[i].username + "</td>";
                            table += "<td>" + formatNumber(data[i].sales) + "</td>";
                            table += "<td><button type='button' value='" + data[i].userId + "' class='btn btn-primary detail_require' data-toggle='modal' data-target='#exampleModalCenter'>Xem đơn hàng</button></td>";
                            table += "</tr>";

                        }
                        table += "</table>";
                        

                        $('#result').html(table);
                        $(".detail_require").on("click", function() {
                            let buttonValue = $(this).val();
                            console.log(buttonValue);
                            // Gán bảng vào phần tử #result
                            $.ajax({
                                url:"thongkehoadon.php",
                                method:"POST",
                                dataType:"JSON",
                                data:{idnguoidung: buttonValue},
                                success:function(data) {
                                    
                                    var modalHtml = "";

                                    for (var i = 0; i < data.length; i++) {
                                        modalHtml += "<div class='card mb-3' >";
                                        modalHtml += "<div class='card-body'>"
                                        modalHtml += "<div class='row'>";
                                        modalHtml += "<div class='col-md-6'>";
                                        modalHtml += "    <h5 class='card-title'>Hóa đơn (id: " + data[i].idhoadon + ")</h5>";
                                        modalHtml += "    <h6 class='card-subtitle mb-2 text-muted'>Ngày đặt hàng: " + ngaythangnam(data[i].ngaydathang) + "</h6>";
                                        modalHtml += "    <a href='admin.php?admin=chitiethoadon&idhoadon=" + data[i].idhoadon + "' class='card-link'>Xem chi tiết</a>";
                                        modalHtml += "</div>";
                                        modalHtml += "<div class='col-md-6 ml-auto'>";
                                        modalHtml += "    <h6 class='card-subtitle mb-2 text-muted'>Thông tin liên hệ</h6>";
                                        modalHtml += "    <p class='card-text mb-0'>Địa chỉ: " + data[i].diachi + "</p>";
                                        modalHtml += "    <p class='card-text mb-0'>Điện thoại: " + data[i].dienthoai + "</p>";
                                        modalHtml += "    <p class='card-text mb-0'>Trang thái: " + data[i].trangthai + "</p>";
                                        modalHtml += "    <p class='card-text mb-2'>Phương thức thanh toán: " + data[i].phuongthucthanhtoan + "</p>";
                                        modalHtml += "</div>";
                                        modalHtml += "</div>";
                                        modalHtml += "</div>"
                                        modalHtml += "</div>"
                                    }
                                    
                                    // Gán bảng vào phần tử #result
                                    $('#bill_detail').html(modalHtml);
                                    $('#bill_quantity').html("(Tổng cộng: " + data.length + " hóa đơn)");
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    $('#bill_detail').html(" -> Đã có lỗi xảy ra rồi >.<");
                                }
                            });
                        });
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        $('#result').html(" -> Đã có lỗi xảy ra rồi >.<");
                    }
                });

            function ngaythangnam(namthangngay){
                if(namthangngay!="")
                {
                var datearr = namthangngay.split("-", 3);
                var ntn = datearr[2]+"-"+datearr[1]+"-"+datearr[0];
                }		
                return ntn;
                
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
                var selectTime1 = document.getElementById('select-time').value;

                $.ajax({
                    url:"xulythongke.php",
                    method:"POST",
                    dataType:"JSON",
                    data:{selectTime1: selectTime1},
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
                        $('#result2').html(table);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert("Lỗi: " + textStatus + "\n" + errorThrown);
                    }
                });
            });

            // When select range dates, this function triggered
            // $('#select-time').change(function(){
            //     var selectTime = document.getElementById('select-time').value;

            //     $.ajax({
            //         url:"xulythongke.php",
            //         method:"POST",
            //         dataType:"JSON",
            //         data:{selectTime: selectTime},
            //         success:function(data) {
            //             data.sort((a, b) => parseFloat(b.sales) - parseFloat(a.sales));
            //             var table = "<table>";
            //             table += "<thead><tr class='tieude_hienthi_sp'><th>ID người dùng</th><th>Tên người dùng</th><th>Tổng số tiền mua</th><th>Thao tác</th></tr></thead>";
            //             for (var i = 0; i < data.length && i < 5; i++) {
            //                 table += "<tr>";
            //                 table += "<td>" + data[i].userId + "</td>";
            //                 table += "<td >" + data[i].username + "</td>";
            //                 table += "<td>" + formatNumber(data[i].sales) + "</td>";
            //                 table += "<td><button type='button' value='" + data[i].userId + "' class='btn btn-primary detail_require' data-toggle='modal' data-target='#exampleModalCenter'>Xem đơn hàng</button></td>";
            //                 table += "</tr>";

            //             }
            //             table += "</table>";
                        

            //             $('#result').html(table);
            //             $(".detail_require").on("click", function() {
            //                 let buttonValue = $(this).val();
            //                 console.log(buttonValue);
            //                 // Gán bảng vào phần tử #result
            //                 $.ajax({
            //                     url:"thongkehoadon.php",
            //                     method:"POST",
            //                     dataType:"JSON",
            //                     data:{idnguoidung: buttonValue},
            //                     success:function(data) {
                                    
            //                         var modalHtml = "";

            //                         for (var i = 0; i < data.length; i++) {
            //                             modalHtml += "<div class='card mb-3' >";
            //                             modalHtml += "<div class='card-body'>"
            //                             modalHtml += "<div class='row'>";
            //                             modalHtml += "<div class='col-md-6'>";
            //                             modalHtml += "    <h5 class='card-title'>Hóa đơn (id: " + data[i].idhoadon + ")</h5>";
            //                             modalHtml += "    <h6 class='card-subtitle mb-2 text-muted'>Ngày đặt hàng: " + ngaythangnam(data[i].ngaydathang) + "</h6>";
            //                             modalHtml += "    <a href='admin.php?admin=chitiethoadon&idhoadon=" + data[i].idhoadon + "' class='card-link'>Xem chi tiết</a>";
            //                             modalHtml += "</div>";
            //                             modalHtml += "<div class='col-md-6 ml-auto'>";
            //                             modalHtml += "    <h6 class='card-subtitle mb-2 text-muted'>Thông tin liên hệ</h6>";
            //                             modalHtml += "    <p class='card-text mb-0'>Địa chỉ: " + data[i].diachi + "</p>";
            //                             modalHtml += "    <p class='card-text mb-0'>Điện thoại: " + data[i].dienthoai + "</p>";
            //                             modalHtml += "    <p class='card-text mb-0'>Trang thái: " + data[i].trangthai + "</p>";
            //                             modalHtml += "    <p class='card-text mb-2'>Phương thức thanh toán: " + data[i].phuongthucthanhtoan + "</p>";
            //                             modalHtml += "</div>";
            //                             modalHtml += "</div>";
            //                             modalHtml += "</div>"
            //                             modalHtml += "</div>"
            //                         }
                                    
            //                         // Gán bảng vào phần tử #result
            //                         $('#bill_detail').html(modalHtml);
            //                         $('#bill_quantity').html("(Tổng cộng: " + data.length + " hóa đơn)");
            //                     },
            //                     error: function(xhr, textStatus, errorThrown) {
            //                         $('#bill_detail').html(" -> Đã có lỗi xảy ra rồi >.<");
            //                     }
            //                 });
            //             });
            //         },
            //         error: function(xhr, textStatus, errorThrown) {
            //             $('#result').html(" -> Đã có lỗi xảy ra rồi >.<");
            //         }
            //     });
            // });

            
            $('#btn-thongke1').click(function(){
                var inputfromdate1 =  document.getElementById('inputfromdate1').value;
                var inputtodate1 =  document.getElementById('inputtodate1').value;
                if(inputfromdate1 == null || inputtodate1 == null){
                    alert("Vui lòng chọn cả 2 khoảng thời gian");   
                }
                $.ajax({
                    url:"xulythongke.php",
                    method:"POST",
                    dataType:"JSON",
                    data:{inputfromdate1: inputfromdate1, inputtodate1: inputtodate1},
                    success:function(data) {
                        data.sort((a, b) => parseFloat(b.sales) - parseFloat(a.sales));
                        var table = "<table>";
                        table += "<thead><tr class='tieude_hienthi_sp'><th>ID người dùng</th><th>Tên người dùng</th><th>Tổng số tiền mua</th><th>Thao tác</th></tr></thead>";
                        for (var i = 0; i < data.length && i < 5; i++) {
                            table += "<tr>";
                            table += "<td>" + data[i].userId + "</td>";
                            table += "<td >" + data[i].username + "</td>";
                            table += "<td>" + formatNumber(data[i].sales) + "</td>";
                            table += "<td><button type='button' value='" + data[i].userId + "' class='btn btn-primary detail_require' data-toggle='modal' data-target='#exampleModalCenter'>Xem đơn hàng</button></td>";
                            table += "</tr>";

                        }
                        table += "</table>";
                        

                        $('#result').html(table);
                        $(".detail_require").on("click", function() {
                            let buttonValue = $(this).val();
                            console.log(buttonValue);
                            // Gán bảng vào phần tử #result
                            $.ajax({
                                url:"thongkehoadon.php",
                                method:"POST",
                                dataType:"JSON",
                                data:{idnguoidung: buttonValue},
                                success:function(data) {
                                    
                                    var modalHtml = "";

                                    for (var i = 0; i < data.length; i++) {
                                        modalHtml += "<div class='card mb-3' >";
                                        modalHtml += "<div class='card-body'>"
                                        modalHtml += "<div class='row'>";
                                        modalHtml += "<div class='col-md-6'>";
                                        modalHtml += "    <h5 class='card-title'>Hóa đơn (id: " + data[i].idhoadon + ")</h5>";
                                        modalHtml += "    <h6 class='card-subtitle mb-2 text-muted'>Ngày đặt hàng: " + ngaythangnam(data[i].ngaydathang) + "</h6>";
                                        modalHtml += "    <a href='admin.php?admin=chitiethoadon&idhoadon=" + data[i].idhoadon + "' class='card-link'>Xem chi tiết</a>";
                                        modalHtml += "</div>";
                                        modalHtml += "<div class='col-md-6 ml-auto'>";
                                        modalHtml += "    <h6 class='card-subtitle mb-2 text-muted'>Thông tin liên hệ</h6>";
                                        modalHtml += "    <p class='card-text mb-0'>Địa chỉ: " + data[i].diachi + "</p>";
                                        modalHtml += "    <p class='card-text mb-0'>Điện thoại: " + data[i].dienthoai + "</p>";
                                        modalHtml += "    <p class='card-text mb-0'>Trang thái: " + data[i].trangthai + "</p>";
                                        modalHtml += "    <p class='card-text mb-2'>Phương thức thanh toán: " + data[i].phuongthucthanhtoan + "</p>";
                                        modalHtml += "</div>";
                                        modalHtml += "</div>";
                                        modalHtml += "</div>"
                                        modalHtml += "</div>"
                                    }
                                    
                                    // Gán bảng vào phần tử #result
                                    $('#bill_detail').html(modalHtml);
                                    $('#bill_quantity').html("(Tổng cộng: " + data.length + " hóa đơn)");
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    $('#bill_detail').html(" -> Đã có lỗi xảy ra rồi >.<");
                                }
                            });
                        });
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        $('#result').html(" -> Đã có lỗi xảy ra rồi >.<");
                    }
                });
            });
            
        });
</script>


