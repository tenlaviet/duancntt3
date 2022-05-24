<?php
	session_start();
	include("permission.php");
//if (isset($_SESSION['username'])) {
//	 echo $_SESSION['username'];
//}
?>

<?php
if(isset($_GET['logout'])) {
session_destroy();
header('Location: login/dangnhap.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="icon" type="image/png" href="./img/Logo-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="./img/Logo-16x16.png" sizes="16x16" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet" />
    <title>Trang chủ</title>
</head>

<body>
    <div class="sidebar">

    </div>
    <h1>Mục Lục</h1>
    <a href="/duancntt3/student/student-list.php">Danh sách sinh viên</a> <br /> <br />
    <a href="/duancntt3/admin/user-list.php">Danh sách người dùng</a> <br /> <br />
    <a href="/duancntt3/lop/lop-list.php">Danh sách lớp</a> <br /> <br />
    <a href="/duancntt3/giaovien/giaovien-list.php">Danh sách giáo viên</a> <br /> <br />
    <a href="/duancntt3/course/course-list.php">Danh sách khóa học</a> <br /> <br />
    <a href="/duancntt3/monhoc/monhoc-list.php">Danh sách môn học</a> <br /> <br />
    <a href="/duancntt3/major/major-list.php">Danh sách chuyên ngành</a> <br /> <br />
    <a href="/duancntt3/student/student-profile.php">profile</a> <br /> <br />

    <form method="get" action="trangchu.php">
        <input onclick="return confirm('Bạn có chắc muốn logout không?');" type="submit" name="logout" value="logout" />
    </form>
</body>

</html>