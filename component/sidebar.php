<?php
if(isset($_GET['logout'])) {
session_destroy();
header('Location: ../login/dangnhap.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <div class="user">
            <img src="../img/user.png" alt="avatar" class="avatar">
            <span class="user-name">
                <?php if (isset($_SESSION['username'])) {
                    echo $_SESSION['username'];
                }?>
            </span>
        </div>
        <div class="navlist">
            <ul>
                <li><a href="/duancntt3/students/student-list.php">Danh sách sinh viên</a></li>
                <li><a href="/duancntt3/admin/user-list.php">Danh sách người dùng</a></li>
                <li><a href="/duancntt3/lop/lop-list.php">Danh sách lớp</a></li>
                <li><a href="/duancntt3/giaovien/giaovien-list.php">Danh sách giáo viên</a></li>
                <li><a href="/duancntt3/course/course-list.php">Danh sách khóa học</a></li>
                <li><a href="/duancntt3/monhoc/monhoc-list.php">Danh sách môn học</a></li>
                <li><a href="/duancntt3/major/major-list.php">Danh sách chuyên ngành</a></li>
                <li class="dropdown">
                    <a href="#">
                        <div class="btn-dropdown">
                            <span>User</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="/duancntt3/students/student-profile.php">Profile</a></li>
                        <li><a href="/duancntt3/students/student-profile-edit.php">Sửa Thông Tin Cá Nhân</a></li>
                        <li><a href="/duancntt3/login/doimatkhau.php">Đổi Mật Khẩu</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div>
            <form method="get" action="student-list.php">
                <input onclick="return confirm('Bạn có chắc muốn logout không?');" type="submit" name="logout" class="btn_logout" value="Logout" />
            </form>
        </div>
    </div>
</body>

</html>