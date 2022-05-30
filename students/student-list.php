<?php
session_start();
require '../libs/students.php';
require_once("../libs/connection.php");

disconnect_db();
?>
<?php
	
	include("../permission.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách sinh vien</title>
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
        <?php include 'C:\xampp\htdocs\duancntt3\component\admin-sidebar.php';?>
        <div class="wrapper">
            <h1>Danh sách sinh viên</h1>
                <div align="center">
                <form action="student-list.php" method="get" class="search-box">
                    <input type="text" name="search" class="search-input" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome"/>
                    <input type="submit" name="ok" value="search" class="search-btn" /> 
                </form>
            </div>
            <a href="student-add.php" class="student-add"><i class="fa-solid fa-circle-plus"></i></i>Thêm sinh viên</a>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Mã Sinh Viên</th>
                        <th>Họ Tên</th>
                        <th>Giới Tính</th>
                        <th>Ngày Sinh</th>
                        <th>Lớp</th>
                        <th>Major</th>
                        <th>ID Tài Khoản</th>
                        <th>Mật Khẩu</th>
                        <th>CMND</th>
                        <th>Email</th>
                        <th>SDT</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <?php
            if (isset($_GET['search']) && $_GET['search'] != '') 
            {
                $sql = 'select * FROM `sinhvien` s inner join `user` u on s.user_id = u.id inner join major m on s.MaCn = m.MaCn where s.MaSv like "%'.$_GET['search'].'%" or s.HoTen like "%'.$_GET['search'].'%" or s.GioiTinh like "%'.$_GET['search'].'%" or s.MaCn like "%'.$_GET['search'].'%" or m.TenCn like "%'.$_GET['search'].'%"
                or s.NgaySinh like "%'.$_GET['search'].'%" or u.email like "%'.$_GET['search'].'%" or s.MaLop like "%'.$_GET['search'].'%" or u.SDT like "%'.$_GET['search'].'%" or u.CMND like "%'.$_GET['search'].'%"'
                ;
            } 
                else {
                    $sql = 'select s.MaSv, s.HoTen, s.GioiTinh, s.NgaySinh, s.MaLop, s.MaCn, m.TenCn, s.user_id, u.password, u.CMND, u.email, u.SDT FROM `sinhvien` s inner join `user` u on s.user_id = u.id inner join major m on s.MaCn = m. MaCn' ;
                    }
                $students = executeResult($sql);
                $index = 1;
                foreach ($students as $item){ ?>
                <tr>
                    <td><?php echo $item['MaSv']; ?></td>
                    <td><?php echo $item['HoTen']; ?></td>
                    <td><?php echo $item['GioiTinh']; ?></td>
                    <td><?php echo $item['NgaySinh']; ?></td>
                    <td><?php echo $item['MaLop']; ?></td>
                    <td><?php echo $item['TenCn']; ?></td>
                    <td><?php echo $item['user_id']; ?></td>
                    <td><?php echo $item['password']; ?></td>
                    <td><?php echo $item['CMND']; ?></td>
                    <td><?php echo $item['email']; ?></td>
                    <td><?php echo $item['SDT']; ?></td>
                    <td>
                        <form method="post" action="student-delete.php">
                            <input onclick="window.location = 'student-edit.php?id=<?php echo $item['user_id']; ?>'" type="button" value="Sửa" class="fix button"/>
                            <input type="hidden" name="id" value="<?php echo $item['user_id']; ?>"/>
                            <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa" class="delete button"/>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <script src="../scripts/dropdown.js"></script>
    </body>
</html>
