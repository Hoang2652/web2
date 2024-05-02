<?php
session_start();
include("include/connect.php");
include("admin/function/function.php");
if(isset($_POST['login']))
{
    $tendangnhap = $_POST['tendangnhap'];
    $matkhau = MD5($_POST['matkhau']);
	if($tendangnhap == "" || $matkhau == "")
	{
		echo "
			<script language='javascript'>
			alert('Vui lòng nhập đầy đủ thông tin đăng nhập');
			window.history.go(-1);
			</script>
			";
	}
	else {	
		$sql_check = mysqli_query($link,"select * from nguoidung where tendangnhap = '$tendangnhap'");
		$dem = mysqli_num_rows($sql_check);
		if($dem == 0)
		{
			$_SESSION['thongbaolo'] = "Tài khoản không tồn tại";
			echo "
				<script language='javascript'>
				alert('Tài khoản không tồn tại');
				window.history.go(-1);
				</script>
				";
		}
    else
    {
        $sql_check2 = mysqli_query($link,"select * from nguoidung where tendangnhap = '$tendangnhap' and matkhau = '$matkhau'");
        $dem2 = mysqli_num_rows($sql_check2);
        if($dem2 == 0)
			echo "
				<script language='javascript'>
				alert('Mật khẩu đăng nhập không đúng');
				window.history.go(-1);
				</script>
				";
        else
			{
            $row = mysqli_fetch_array($sql_check2);
				if($row['trangthai'] == 0)
					echo "
					<script language='javascript'>
						alert('Tài khoản này hiện đang bị khóa');
						window.history.go(-1);
					</script>
					";
                else if (isset($_SESSION['tendangnhap'])){
					echo "
					<script language='javascript'>
						alert('Hiện tại bạn đang đăng nhập bằng tài khoản '" .$_SESSION['tendangnhap']. "' . Hãy đăng xuất để đăng nhập bằng tài khoản khác.');
						window.history.go(-1);
					</script>
					";
				}
				else {
					$_SESSION['tendangnhap'] = $tendangnhap;
					$_SESSION['phanquyen'] = $row['phanquyen'];
					$_SESSION['idnguoidung'] = $row['idnguoidung'];

					if (!empty($_POST['saveinfo']))
					{
						setcookie("tendangnhap", $_POST['tendangnhap'] , time() + 86400, "/");
						setcookie("matkhau", $_POST['matkhau'] , time() + 86400, "/");
					}

					switch ($_SESSION['phanquyen']) {
						case 0:
						echo "<script language='javascript'>
						alert('Đăng nhập quản trị viên thành công');
						window.open('admin/admin.php','_self', 1);
						</script>
						";
						break;
						
						case 1:
						echo "<script language='javascript'>
						 alert('Đăng nhập thành công');
						window.open('index.php','_self', 1);
						</script>";
						break;

						case 2:
						echo "<script language='javascript'>
						alert('Đăng nhập quản lý thành công');
						window.open('admin/admin.php','_self', 1);
						</script>";
						break;
					}
				}
            }
        }
    }
}

?>