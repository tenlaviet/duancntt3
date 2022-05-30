<?php
	session_start();

 ?>

<?php

if(isset($_GET['logout'])) {
session_destroy();
header('Location: login/dangnhap.php');
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Trang chủ</title>
	<charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/png" href="../img/Logo-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../img/Logo-16x16.png" sizes="16x16" />
    <link href="./styles/sidebar.css" rel="stylesheet" type="text/css" />
    <link href="./styles/header.css" rel="stylesheet" type="text/css" />
    <link href="./styles/table.css" rel="stylesheet" type="text/css" />
    <script src="https://kit.fontawesome.com/19fbdee3eb.js" crossorigin="anonymous"></script>
</head>
<body>
	<?php include 'C:\xampp\htdocs\duancntt3\component\student-sidebar.php';?>
	<h1>Mục Lục</h1>

	<a href="/duancntt3/students/student-profile.php">Thông tin cá nhân</a> <br/> <br/>
	<a href="/duancntt3/students/student-bangdiem.php">Bảng điểm</a> <br/> <br/>
	<a href="/duancntt3/students/student-profile.php">Bảng điểm</a> <br/> <br/>
	<a href="/duancntt3/students/student-profile.php">lịch thi</a> <br/> <br/>


                    <form method="get" action="trang_sinhvien.php">
                        <input onclick="return confirm('Bạn có chắc muốn logout không?');" type="submit" name="logout" value="logout"/>
                    </form>
</body>
</html>