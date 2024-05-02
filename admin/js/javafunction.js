function timkiemtructiep(str, type) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("row-sanpham").innerHTML = this.responseText;
        }
    };

    switch (type) {
        case "sanpham":
            xmlhttp.open("GET", "timkiem_sanpham.php?q=" + str, true);
            xmlhttp.send();
            break;
        case "danhmuc":
            xmlhttp.open("GET", "timkiem_danhmuc.php?q=" + str, true);
            xmlhttp.send();
            break;
        case "hoadon":
            xmlhttp.open("GET", "timkiem_hoadon.php?q=" + str, true);
            xmlhttp.send();
            break;
        case "nguoidung":
            xmlhttp.open("GET", "timkiem_nguoidung.php?q=" + str, true);
            xmlhttp.send();
            break;
        case "hotro":
            xmlhttp.open("GET", "timkiem_hotro.php?q=" + str, true);
            xmlhttp.send();
            break;
        case "hoadonnhapxuat":
            xmlhttp.open("GET", "timkiem_hoadonnhapxuat.php?keytimkiem_hoadonnhapxuat=" + str, true);
            xmlhttp.send();
            break;
    }
}

function timkiemhangtonkho(str, idkhohang) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("row-sanpham").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "timkiem_hoadonnhapxuat.php?keytimkiem_hangtonkho=" + str + "&idkhohang=" + idkhohang, true);
    xmlhttp.send();
}


function timkiemhoadon() {
    str1 = document.getElementById('timkiem-hoadon').value;
    str2 = document.getElementById('date-from').value;
    str3 = document.getElementById('date-to').value;
    str4 = document.getElementById('filter-donhang').value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("row-sanpham").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "timkiem_hoadon.php?q=" + str1 + "&date1=" + str2 + "&date2=" + str3 + "&trangthai=" + str4, true);
    xmlhttp.send();
}

function deleteconfirm() {
    if (confirm('Bạn chắc chắn thực hiện thao tác này chứ ?') === false)
        return false;
}

function checkdeldanhmuc(iddanhmuc) {
    var url = 'admin.php?admin=xoadm&iddanhmuc=' + iddanhmuc;
    if (confirm('Bạn có chắc chắn xóa danh mục id: ' + iddanhmuc + ' ?')) {
        window.open(url, '_self', 1);
    } else {
        return false;
    }
}

function checkdelsanpham(idsanpham) {
    var url = 'admin.php?admin=xoasp&idsanpham=' + idsanpham;
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm id: ' + idsanpham + ' ?')) {
        window.open(url, '_self', 1);
    } else {
        return false;
    }
}

function checkdelhoadon(idhoadon) {
    var url = 'admin.php?admin=xoahd&idhoadon=' + idhoadon;
    if (confirm('Bạn có chắc chắn muốn xóa hóa đơn id: ' + idhoadon + ' ?')) {
        window.open(url, '_self', 1);
    } else {
        return false;
    }
}

function checkdelhoadonnhapxuatkho(idhoadonnhapxuatkho) {
    var url = 'admin.php?admin=xulynhapxuatkhohang&submit-xoahoadonnhapxuatkho=' + idhoadonnhapxuatkho;
    if (confirm('Bạn có chắc chắn muốn xóa hóa đơn id: ' + idhoadonnhapxuatkho + ' ?')) {
        window.open(url, '_self', 1);
    } else {
        return false;
    }
}

function checkdelvitrikhohang(idvitrikhohang) {
    var url = 'admin.php?admin=xulyhangtonkho&submit-xoavitrikhohang=' + idvitrikhohang;
    if (confirm('Bạn có chắc chắn muốn xóa vị trí kho hàng ' + idvitrikhohang + ' ?')) {
        window.open(url, '_self', 1);
    } else {
        return false;
    }
}

function checkdelsanphamtonkho(idsanpham) {
    var url = 'admin.php?admin=xulyhangtonkho&submit-xoasanphamtonkho=' + idsanpham;
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm tồn kho id: ' + idsanpham + ' ?')) {
        window.open(url, '_self', 1);
    } else {
        return false;
    }
}

function checkdelkhohang(idkhohang) {
    var url = 'admin.php?admin=xulykhohang&submit-xoakhohang=' + idkhohang;
    if (confirm('Bạn có chắc chắn muốn xóa kho hàng id: ' + idkhohang + ' ?')) {
        window.open(url, '_self', 1);
    } else {
        return false;
    }
}

function additionData(idCol) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("inputfield").innerHTML = document.getElementById("inputfield").innerHTML + this.responseText;
            document.getElementById("replaceButton").innerHTML = "<a class='btn btn-primary' onclick='additionData(" + (Number(idCol) + 1) + ")'>Thêm dòng dữ liệu</a>";
        }
    };
    xmlhttp.open("GET", "themdongdulieunhapxuat.php?submit-themcotdulieu=" + idCol, true);
    xmlhttp.send();
}


function livesreachxuatkho(str1, idCol) {
    if (str1.length == 0) {
        document.getElementById("livesreach-sanphamtonkho").innerHTML = "";
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("livesreach-sanphamtonkho").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "themdongdulieunhapxuat.php?submit-livesreachxuatkho=" + str1 + "&idCol=" + idCol, true);
        xmlhttp.send();
    }
}

function additionDataXuat(idsanpham, idCol) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("inputfield").innerHTML = document.getElementById("inputfield").innerHTML + this.responseText;
            document.getElementById("replaceButton").innerHTML = "<input type='text' class='form-control' id='timkiem-sanphamtonkho' name='timkiem' placeholder='Nhập id hóa đơn' onkeyup='livesreachxuatkho(this.value," + (Number(idCol) + 1) + ")'>";
            document.getElementById("livesreach-sanphamtonkho").innerHTML = "";
        }
    };
    xmlhttp.open("GET", "themdongdulieunhapxuat.php?submit-themcotdulieuxuat=" + idsanpham + "&idCol=" + idCol, true);
    xmlhttp.send();
}

function livesreachthemsanphamtonkho(str) {
    if (str.length == 0) {
        document.getElementById("livesreach-themsanphamtonkho").innerHTML = "";
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("livesreach-themsanphamtonkho").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "timkiem_sanpham.php?idsanphamtonkho=" + str, true);
        xmlhttp.send();
    }
}

function additionDataSanPham(idsanpham) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("inputfield").innerHTML = this.responseText;
            document.getElementById("livesreach-themsanphamtonkho").innerHTML = "";
        }
    };
    xmlhttp.open("GET", "themdongdulieunhapxuat.php?submit-themdulieusanpham=" + idsanpham, true);
    xmlhttp.send();
}

function checkdelnguoidung(idnguoidung) {
    var url = 'admin.php?admin=xoand&idnguoidung=' + idnguoidung;
    if (confirm('Bạn có chắc chắn muốn xóa người dùng id: ' + idnguoidung + ' ?')) {
        window.open(url, '_self', 1);
    } else {
        return false;
    }
}

function checkdelcauhoithuonggap(idcauhoi) {
    var url = 'admin.php?admin=cauhoithuonggap&submit_xoacauhoithuonggap=' + idcauhoi;
    if (confirm('Bạn có chắc chắn muốn xóa câu hỏi id: ' + idcauhoi + ' ?')) {
        window.open(url, '_self', 1);
    } else {
        return false;
    }
}

function checkdelvitrisanpham(idvitrisanpham, idsanpham) {
    var url = 'admin.php?admin=xulyhangtonkho&submit_xoavitrisanpham=' + idvitrisanpham + "&idsanpham=" + idsanpham;
    if (confirm('Bạn có chắc chắn muốn gỡ vị trí id: ' + idvitrisanpham + ' của sản phẩm này ?')) {
        window.open(url, '_self', 1);
    } else {
        return false;
    }
}

function addvitrisanpham(idsanpham) {
    var idvitrisanpham = document.getElementById("idvitrikhohang").value;
    var url = 'admin.php?admin=xulyhangtonkho&submit-themvitrisanpham=' + idvitrisanpham + "&idsanpham=" + idsanpham;
    window.open(url, '_self', 1);
}

function checkdeldanhgia(iddanhgia) {
    var url = 'update_sanpham.php?&submit_xoadanhgia=' + iddanhgia;
    if (confirm('Bạn có chắc chắn muốn xóa đánh giá này ?')) {
        window.open(url, '_self', 1);
    } else {
        return false;
    }
}