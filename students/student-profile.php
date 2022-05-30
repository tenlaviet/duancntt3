<?php
session_start();
require '../libs/students.php';
require_once("../libs/connection.php");
if(isset($_SESSION['username']))
{
    $masv =$_SESSION['username'];
}

    //$sql = 'select s.MaSv, s.HoTen, s.GioiTinh, s.NgaySinh, s.MaLop, s.MaCn, s.user_id, u.CMND, u.email, u.SDT FROM `sinhvien` s inner join `user` u on s.user_id = u.id';

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
        <title>Thông Tin Cá Nhân</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/png" href="../img/Logo-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="../img/Logo-16x16.png" sizes="16x16" />
        <link href="../styles/sidebar.css" rel="stylesheet" type="text/css" />
        <link href="../styles/header.css" rel="stylesheet" type="text/css" />
        <link href="../styles/table.css" rel="stylesheet" type="text/css" />
        <script src="https://kit.fontawesome.com/19fbdee3eb.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php include 'C:\xampp\htdocs\duancntt3\component\student-sidebar.php';?>
        <div class="wrapper">
            <h1>Thông Tin Cá Nhân</h1>
            <div class="table-wrapper">
                <table class="profile-table">
                    <?php
                    $sql = "select s.MaSv, s.HoTen, s.GioiTinh, s.NgaySinh, s.MaLop, s.MaCn, s.user_id, u.CMND, u.SDT, u.email FROM `sinhvien` s inner join `user` u on s.user_id = u.id where s.MaSv ='$masv';";
                    $students = executeResult($sql);
                    $index = 1;
                    foreach ($students as $item){ ?>
                    <tr>
                        <th>Mã sinh viên</th>
                        <td><?php echo $item['MaSv']; ?></td>
                    </tr>
                    <tr>
                        <th>Họ tên</th>
                        <td><?php echo $item['HoTen']; ?></td>
                    </tr>
                    <tr>
                        <th>Giới tính</th>
                        <td><?php echo $item['GioiTinh']; ?></td>
                    </tr>
                    <tr>
                        <th>Ngày sinh</th>
                        <td><?php echo $item['NgaySinh']; ?></td>
                    </tr>
                    <tr>
                        <th>Lớp</th>
                        <td><?php echo $item['MaLop']; ?></td>
                    </tr>
                    <tr>
                        <th>Chuyên ngành</th>
                        <td><?php echo $item['MaCn']; ?></td>
                    </tr>
                    <tr>
                        <th>CMND</th>
                        <td><?php echo $item['CMND']; ?></td>
                    </tr>
                    <tr>
                        <th>email</th>
                        <td><?php echo $item['email']; ?></td>
                    </tr>    
                    <tr>
                        <th>SDT</th>
                        <td><?php echo $item['SDT']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
                <form method="get" action="student-profile-edit.php">
                    <input onclick="window.location = 'student-profile-edit.php?id=<?php echo $item['user_id']; ?>'" type="button" value="Sửa Thông Tin Cá Nhân" class="fix-profile button"/>
                    <input type="hidden" name="id" value="<?php echo $item['user_id']; ?>"/>
                </form>
            </div>
        </div>
    </body>
</html>