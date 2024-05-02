<?php
function mysqli_result($res, $row, $field=0) {
	$res->data_seek($row);
  $datarow = $res->fetch_array();
  return $datarow[$field];
}
session_start();
if(isset($_SESSION['tendangnhap']))
{
	if($_SESSION['phanquyen']==1)
    {
	    header("location:../index.php");
    }
if($_SESSION['tendangnhap']==0)
{
	header("location:admin.php");
}
}
?>
<link rel="stylesheet" href="css/login.css" type="text/css">
<div class="body">
    <div class="tieude1">
        <div class="quantri">
            <h2>Đăng nhập quản trị</h2>
        </div>
    </div>
<?php
include("../include/connect.php");

if(isset($_POST['login']))
{
    $tendangnhap = $_POST['tendangnhap'];
    $matkhau = MD5($_POST['matkhau']);
    $sql_check = mysqli_query($link,"select * from nguoidung where tendangnhap = '$tendangnhap'");
    $dem = mysqli_num_rows($sql_check);
    if($dem == 0)
    {
        echo "<p class='thongbao1'>Tài khoản không tồn tại</p>";
    }
    else
    {
        $sql_check2 = "select * from nguoidung where tendangnhap = '$tendangnhap' and matkhau = '$matkhau'";
		$row=mysqli_query($link,$sql_check2);	
        $dem2 = mysqli_num_rows($row);
        if($dem2 == 0)
            echo "<p class='thongbao1'>Mật khẩu không chính xác</p>";
        else
        {
	
		 while($row = mysqli_fetch_array($row))
            {
              $_SESSION['tendangnhap'] = $tendangnhap;
				$_SESSION['phanquyen'] = $row['phanquyen'];
				$_SESSION['idnd'] = $row['idnd'];
                if($rows['phanquyen'] == 0)
                {
                    
					echo "
							<script language='javascript'>
								alert('Đăng nhập quản trị thành công');
								window.open('admin.php','_self', 1);
							</script>
						";
                }
                else
                {
                    
					header('location:../index.php');
                }
            }
        }
    }
}
?>
<div class="admin_login">
    <form action="" method="post">
        <label>Tên tài khoản:</label><input type="text" name="tendangnhap" placeholder=" tendangnhap"><br>
        <label>Mật khẩu:</label><input type="password" name="matkhau" placeholder=" matkhau"><br>
        <button name="login" class="dangnhap">Đăng nhập</button><button class="thoat"><a href="../index.php">Thoát</a></button>
    </form>
</div>
</div>
