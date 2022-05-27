<?php
require '../libs/students.php';
require_once("../libs/connection.php");

disconnect_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách giáo viên</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../styles/sidebar.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php include 'C:\xampp\htdocs\duancntt3\component\sidebar.php';?>
        <h1>Danh sách giáo viên</h1>
	        <div align="center">
            <form action="giaovien-list.php" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        <a href="giaovien-add.php">Thêm sinh viên</a> <br/> <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Mã giao vien</td>
                <td>Họ tên</td>
                <td>Giới tính</td>
                <td>Ngày sinh</td>
                <td>Chu nhiem</td>
                <td>chuyen nganh</td>
                <td>ID tai khoan</td>
                <td>mat khau</td>
                <td>CMND</td>
                <td>email</td>
                <td>SDT</td>
                <td>Options</td>
            </tr>

            <?php
        if (isset($_GET['search']) && $_GET['search'] != '') 
        {
            $sql = 'select * FROM `giaovien` g inner join `user` u on g.user_id = u.id where g.MaSv like "%'.$_GET['search'].'%" or g.HoTen like "%'.$_GET['search'].'%" or g.GioiTinh like "%'.$_GET['search'].'%" or g.MaCn like "%'.$_GET['search'].'%"
            or g.NgaySinh like "%'.$_GET['search'].'%" or u.email like "%'.$_GET['search'].'%" or g.MaLop like "%'.$_GET['search'].'%" or u.SDT like "%'.$_GET['search'].'%" or u.CMND like "%'.$_GET['search'].'%"'
            ;
        } 
            else {
                   $sql = 'select g.MaGv, g.HoTen, g.GioiTinh, g.NgaySinh, g.ChuNhiem, g.MaCn, g.user_id, u.password, u.CMND, u.email, u.SDT FROM `giaovien` g inner join `user` u on g.user_id = u.id';
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
                <td><?php echo $item['MaCn']; ?></td>
                <td><?php echo $item['user_id']; ?></td>
                <td><?php echo $item['password']; ?></td>
                <td><?php echo $item['CMND']; ?></td>
                <td><?php echo $item['email']; ?></td>
                <td><?php echo $item['SDT']; ?></td>
                <td>
                    <form method="post" action="giaovien-delete.php">
                        <input onclick="window.location = 'giaovien-edit.php?id=<?php echo $item['user_id']; ?>'" type="button" value="Sửa"/>
                        <input type="hidden" name="id" value="<?php echo $item['user_id']; ?>"/>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
