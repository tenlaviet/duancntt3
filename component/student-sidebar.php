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
                <li><a href="/duancntt3/students/student-profile.php">Thông Tin Cá Nhân</a></li>
                <li><a href="/duancntt3/students/student-bangdiem.php">Bảng Điểm</a></li>
                <li><a href="/duancntt3/login/doimatkhau.php">Đổi mật khẩu</a></li>
            </ul>
        </div>
        <div>
            <form method="get" action="student-profile.php">
                <input onclick="return confirm('Bạn có chắc muốn logout không?');" type="submit" name="logout" value="logout" class="btn_logout"/>
            </form>
        </div>
    </div>
</body>

</html>