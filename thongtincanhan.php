<?php
echo "<script>document.getElementById('content').innerHTML=''</script>";
echo "<script>document.getElementById('left-content').innerHTML=''</script>";
echo "<script>document.getElementById('doitac').innerHTML=''</script>";
    $sql = "select * from nguoidung where idnguoidung='".$_SESSION['idnguoidung']."'";
    if ($query = mysqli_query($link,$sql)){
        $row = mysqli_fetch_array($query);
    }
?>

<div id='khungcangiua'>
    <div id="thongtincanhan">
        <h6 style="text-align: center; font-weight: bold;"><i class="fas fa-user"></i> Thông tin cá nhân</h6>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Họ tên: <?php echo $row['tennguoidung']; ?></li>
            <li class="list-group-item">Tên đăng nhập: <?php echo $row['tendangnhap']; ?></li>
            <li class="list-group-item">Email: <?php echo $row['email']; ?></li>
            <li class="list-group-item">Địa chỉ: <?php echo $row['diachi']; ?></li>
            <li class="list-group-item">Điện thoại: <?php echo $row['dienthoai']; ?></li>
            <li class="list-group-item">Ngày sinh: <?php echo ngaythangnam($row['ngaysinh']); ?></li>
            <li class="list-group-item">Giới tính: <?php echo ($row['gioitinh'] == 'nam') ? "Nam" : "Nữ"; ?></li>
        </ul>
    </div>
    <div id="quanlythongtincanhan">
        <a href="index.php?content=doimatkhau">
            <div class="card-body vienthongtin">
                <h5 class="card-title"><i class="fas fa-key"></i> Sửa đổi mật khẩu</h5>
                <p class="card-text textchuthich">Thay đổi mật khẩu nâng cao bảo mật cho tài khoản.</p>
            </div>
        </a>
        <a href="index.php?content=lichsumuahang">
            <div class="card-body vienthongtin">
                <h5 class="card-title"><i class="fas fa-history"></i> Lịch sử mua hàng</h5>
                <p class="card-text textchuthich">Bạn có thể xem lại tất cả những gì bạn đã từng mua.</p>
            </div>
        </a>
        <a href="index.php?content=doithongtincanhan">
            <div class="card-body vienthongtin">
                <h5 class="card-title"><i class="fas fa-wrench"></i> Thay đổi thông tin cá nhân</h5>
                <p class="card-text textchuthich">Cập nhật thông tin bản thân nếu cần thiết, mà chả thèm đâu lmao.</p>
            </div>
        </a>
    </div>
</div>
