<?php
session_start();
require '../libs/students.php';
require_once("../libs/connection.php");
if(isset($_SESSION['username']))
{
    echo $_SESSION['username'];
    $masv =$_SESSION['username'];
}

    //$sql = 'select s.MaSv, s.HoTen, s.GioiTinh, s.NgaySinh, s.MaLop, s.MaCn, s.user_id, u.CMND, u.email, u.SDT FROM `sinhvien` s inner join `user` u on s.user_id = u.id';




?>
<?php
if(isset($_GET['logout'])) {
session_destroy();
header('Location: ../login/dangnhap.php');
}
?>
 

<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách sinh vien</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Danh sách sinh vien</h1>
            <div align="center">


        </div>
        <form method="get" action="student-profile.php">
        <input onclick="return confirm('Bạn có chắc muốn logout không?');" type="submit" name="logout" value="logout"/>
        </form>
        <a href="/duancntt3/trang_sinhvien.php">trang chu</a> <br/> <br/>

        <a href="/duancntt3/login/doimatkhau.php">doi mat khau</a> <br/> <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Mã sinh viên</td>
                <td>Họ tên</td>
                <td>Giới tính</td>
                <td>Ngày sinh</td>
                <td>Lớp</td>
                <td>Chuyên ngành</td>
                
                <td>CMND</td>
                <td>email</td>
                <td>SDT</td>

            </tr>

            <?php
            $sql = "select s.MaSv, s.HoTen, s.GioiTinh, s.NgaySinh, s.MaLop, s.MaCn, s.user_id, u.CMND, u.SDT, u.email FROM `sinhvien` s inner join `user` u on s.user_id = u.id where s.MaSv ='$masv';";
            $students = executeResult($sql);
            $index = 1;
            foreach ($students as $item){ ?>
            <tr>
                <td><?php echo $item['MaSv']; ?></td>
                <td><?php echo $item['HoTen']; ?></td>
                <td><?php echo $item['GioiTinh']; ?></td>
                <td><?php echo $item['NgaySinh']; ?></td>
                <td><?php echo $item['MaLop']; ?></td>
                <td><?php echo $item['MaCn']; ?></td>
               
                <td><?php echo $item['CMND']; ?></td>
                <td><?php echo $item['email']; ?></td>
                <td><?php echo $item['SDT']; ?></td>

            </tr>
            <?php } ?>
                                                <form method="get" action="student-profile-edit.php">
                            <input onclick="window.location = 'student-profile-edit.php?id=<?php echo $item['user_id']; ?>'" type="button" value="sửa thông tin cá nhân" class="fix button"/>
                            <input type="hidden" name="id" value="<?php echo $item['user_id']; ?>"/>
                        </form>

        </table>
    </body>
</html>