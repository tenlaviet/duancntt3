<?php
	session_start();

 ?>
<?php include("permission_sinhvien.php");
if (isset($_SESSION['username'])) {
	 echo $_SESSION['username'];
}
?>
<?php
if(isset($_GET['logout'])) {
session_destroy();
header('Location: login/dangnhap_sinhvien.php');
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Trang chủ</title>
	<charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Mục Lục</h1>

<a href="/duancntt3/student/student-profile.php">Thông tin cá nhân</a> <br/> <br/>
<a href="/duancntt3/student/student-profile.php">Đăng ký học</a> <br/> <br/>
<a href="/duancntt3/student/student-profile.php">Bảng điểm</a> <br/> <br/>
<a href="/duancntt3/student/student-profile.php">lịch thi</a> <br/> <br/>


                    <form method="get" action="trang_sinhvien.php">
                        <input onclick="return confirm('Bạn có chắc muốn logout không?');" type="submit" name="logout" value="logout"/>
                    </form>
</body>
</html>