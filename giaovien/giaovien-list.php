<?php
session_start();
require '../permission.php';
require '../libs/students.php';
require_once("../libs/connection.php");

disconnect_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Danh Sách Giáo Viên</title>
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
            <h1>Danh Sách Giáo Viên</h1>
                <div align="center">
                <form action="giaovien-list.php" method="get" class="search-box">
                    <input type="text" name="search" class="search-input" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome"/>
                    <input type="submit" name="ok" value="search" class="search-btn" />
                </form>
            </div>
            <a href="giaovien-add.php" class="student-add"><i class="fa-solid fa-circle-plus"></i>Thêm giáo viên</a>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Mã Giáo Viên</th>
                        <th>Họ Tên</th>
                        <th>Giới Tính</th>
                        <th>Ngày Sinh</th>
                        <th>Chủ Nhiệm</th>
                        <th>Chuyên Ngành</th>
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
                $sql = 'select * FROM `giaovien` g inner join `user` u on g.user_id = u.id inner join major m on g.MaCn = m.MaCn where g.MaGv like "%'.$_GET['search'].'%" or g.HoTen like "%'.$_GET['search'].'%" or g.GioiTinh like "%'.$_GET['search'].'%" or g.MaCn like "%'.$_GET['search'].'%" or m.TenCn like "%'.$_GET['search'].'%"
                or g.NgaySinh like "%'.$_GET['search'].'%" or u.email like "%'.$_GET['search'].'%" or g.ChuNhiem like "%'.$_GET['search'].'%" or u.SDT like "%'.$_GET['search'].'%" or u.CMND like "%'.$_GET['search'].'%"'
                ;
            } 
                else {
                    $sql = 'select g.MaGv, g.HoTen, g.GioiTinh, g.NgaySinh, g.ChuNhiem, m.TenCn, g.user_id, u.password, u.CMND, u.email, u.SDT FROM `giaovien` g inner join `user` u on g.user_id = u.id inner join major m on g.MaCn = m.MaCn' ;
                    }
                $giaovien = executeResult($sql);
                $index = 1;
                foreach ($giaovien as $item){ ?>
                <tr>
                    <td><?php echo $item['MaGv']; ?></td>
                    <td><?php echo $item['HoTen']; ?></td>
                    <td><?php echo $item['GioiTinh']; ?></td>
                    <td><?php echo $item['NgaySinh']; ?></td>
                    <td><?php echo $item['ChuNhiem']; ?></td>
                    <td><?php echo $item['TenCn']; ?></td>
                    <td><?php echo $item['user_id']; ?></td>
                    <td><?php echo $item['password']; ?></td>
                    <td><?php echo $item['CMND']; ?></td>
                    <td><?php echo $item['email']; ?></td>
                    <td><?php echo $item['SDT']; ?></td>
                    <td>
                        <form method="post" action="giaovien-delete.php">
                            <input onclick="window.location = 'giaovien-edit.php?id=<?php echo $item['user_id']; ?>'" type="button" value="Sửa" class="fix button"/>
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
