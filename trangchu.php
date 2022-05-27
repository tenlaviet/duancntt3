<?php
	session_start();

 ?>
<?php include("permission.php");
if (isset($_SESSION['username'])) {
	 
	 if $_SESSION['permission'];
}
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
</head>
<body>
<h1>Mục Lục</h1>
<a href="/duancntt3/students/student-list.php">Danh sách sinh viên</a> <br/> <br/>
<a href="/duancntt3/admin/user-list.php">Danh sách người dùng</a> <br/> <br/>
<a href="/duancntt3/lop/lop-list.php">Danh sách lớp</a> <br/> <br/>
<a href="/duancntt3/giaovien/giaovien-list.php">Danh sách giáo viên</a> <br/> <br/>
<a href="/duancntt3/course/course-list.php">Danh sách khóa học</a> <br/> <br/>
<a href="/duancntt3/monhoc/monhoc-list.php">Danh sách môn học</a> <br/> <br/>
<a href="/duancntt3/major/major-list.php">Danh sách chuyên ngành</a> <br/> <br/>
<a href="/duancntt3/students/student-profile.php">profile</a> <br/> <br/>

                    <form method="get" action="trangchu.php">
                        <input onclick="return confirm('Bạn có chắc muốn logout không?');" type="submit" name="logout" value="logout"/>
                    </form>
</body>
</html>