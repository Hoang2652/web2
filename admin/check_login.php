<?php
session_start();
include("../administrator/connect.php");
include("../administrator/function.php");
echo "<meta charset='UTF-8' />";
if(isset($_POST['login']))
{
    $tendangnhap = $_POST['user'];
    $password = $_POST['pass'];
    $sql_check = mysqli_query($link,"select * from users where tendangnhap = '$tendangnhap'");
    $dem = mysqli_num_rows($sql_check);
    if($dem == 0)
    {
        echo "Tài khoản không tồn tại";
    }
    else
    {
        $sql_check2 = mysqli_query($link,"select * from users where tendangnhap = '$tendangnhap' and password = '$password'");
        $dem2 = mysqli_num_rows($sql_check2);
        if($dem2 == 0)
            redirect("login.php", "Mật khẩu đăng nhập không đúng",0.5);
        else
        {
            while($rows = mysqli_fetch_object($sql_check2))
            {
                $phanquyen = $rows -> phanquyen	;
                if($phanquyen = '1')
                {
                    $_SESSION['admin'] = $tendangnhap;
                    echo "<script language='javascript'>
                        alert('Đăng nhập thành công');
                        window.open('trangchu.php','_self',1);
                    </script>";
                }
                else
                {
                    $_SESSION['user'] = $tendangnhap;
                    redirect("../index.php", "Đăng nhập thành công!", 0.5);
                }
            }
        }
    }
}