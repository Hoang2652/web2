<?php 
echo "<script>document.getElementById('content').innerHTML=''</script>";
echo "<script>document.getElementById('left-content').innerHTML=''</script>";

if(isset($_POST['changepassword'])){
    $idnguoidung = $_SESSION['idnguoidung'];
    $oldpassword = MD5($_POST['oldpassword']); 
    $newpassword = MD5($_POST['newpassword']);

    $sqlcheck = "select idnguoidung from nguoidung where matkhau='".$oldpassword."' and idnguoidung='".$idnguoidung."'";
    if(mysqli_query($link,$sqlcheck)){
        $sql = "update nguoidung set matkhau='".$newpassword."' where idnguoidung='".$idnguoidung."'";
        if(mysqli_query($link,$sql)) {
            echo "<script language='javascript'>
            window.open('index.php','_self', 1);
            alert('Đổi mật khẩu thành công!');

            </script>";
        }
    } else {
        echo "<script language='javascript'>
        alert('Đổi mật khẩu thất bại: Sai mật khẩu cũ!');
        window.open('index.php?content=doimatkhau','_self', 1);
        </script>";
    }

}

?>
<div id="dangnhap-in">
	<form class="dangky" action="index.php?content=doimatkhau" method="post" name="frm" onsubmit="return checkformdoimatkhau()" style="width: 500px;margin: auto;margin-top: 4rem;">
		<b><h3 style="text-align: center">Đổi mật khẩu</h3></b>
		<div class="form-group pr-4">
			<label for="CustomerID">Nhập mật khẩu cũ:</label>
			<input class="form-control" type="password" name="oldpassword" maxlength="20" onclick="document.getElementById('warning-CustomerID').innerHTML=''">
			<div style=" font-size: 80%; color: red;" id="warning-oldpassword"></div>
		</div>
		<div class="form-group pr-4">
			<label for="Password">Nhập mật khẩu mới: </label>
			<input class="form-control" type="password" name="newpassword" size="20" onclick="document.getElementById('warning-Password').innerHTML=''">
			<div style=" font-size: 80%; color: red;" id="warning-newpassword"></div>
		</div>
        <div class="form-group pr-4">
			<label for="retypePassword">Nhập lại mật khẩu: </label>
			<input class="form-control" type="password" name="retypenewpassword" size="20" onclick="document.getElementById('warning-retype-Password').innerHTML=''">
			<div style=" font-size: 80%; color: red;" id="warning-retypenewpassword"></div>
		</div>
		<div style="width: fit-content; margin: 15px auto;"><a><button name="changepassword" class="btn btn-primary">Đổi mật khẩu</button></a></div>
	</form>
</div>
    <script language="javascript">
 	function checkformdoimatkhau(){
		var error=0;
	    if(frm.oldpassword.value=="")
		{
			document.getElementById('warning-oldpassword').innerHTML="Bạn chưa nhập mật khẩu cũ";
			error++;	
		}

		if(frm.newpassword.value=="")
	 	{
			document.getElementById('warning-newpassword').innerHTML="Bạn chưa nhập mật khẩu mới";
			error++;
		} else if(frm.newpassword.value.length<6 || frm.newpassword.value.length>24)
		{
			document.getElementById('warning-newpassword').innerHTML="Mật khẩu phải có số kí tự trong khoảng 6-24";	
			error++;
		}

        if(frm.retypenewpassword.value=="")
	 	{
			document.getElementById('warning-retypenewpassword').innerHTML="Bạn chưa nhập lại mật khẩu mới";
			error++;
		} else if (frm.retypenewpassword.value!=frm.newpassword.value){
            document.getElementById('warning-retypenewpassword').innerHTML="Mật khẩu mới không khớp với mật khẩu cũ";
			error++;
        }

		if(error>0) {
			alert('Đổi mật khẩu không thành công');
			return false;
		} else {
			return true;
		}
	}
	</script>