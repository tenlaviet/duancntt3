<?php

require '../libs/students.php';
require_once("../libs/connection.php");


disconnect_db();
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
            <form action="student-list.php" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        <a href="/duancntt3/trangchu.php">trang chu</a> <br/> <br/>
        <a href="student-add.php">Thêm sinh viên</a> <br/> <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Mã sinh viên</td>
                <td>Họ tên</td>
		        <td>Giới tính</td>
                <td>Ngày sinh</td>
		        <td>lop</td>
                <td>major</td>
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
			$sql = 'select * FROM `sinhvien` s inner join `user` u on s.user_id = u.id where s.MaSv like "%'.$_GET['search'].'%" or s.HoTen like "%'.$_GET['search'].'%" or s.GioiTinh like "%'.$_GET['search'].'%" or s.MaCn like "%'.$_GET['search'].'%"
			or s.NgaySinh like "%'.$_GET['search'].'%" or u.email like "%'.$_GET['search'].'%" or s.MaLop like "%'.$_GET['search'].'%" or u.SDT like "%'.$_GET['search'].'%" or u.CMND like "%'.$_GET['search'].'%"'
			;
		} 
			else {
				   $sql = 'select s.MaSv, s.HoTen, s.GioiTinh, s.NgaySinh, s.MaLop, s.MaCn, s.user_id, u.password, u.CMND, u.email, u.SDT FROM `sinhvien` s inner join `user` u on s.user_id = u.id';
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
        		<td><?php echo $item['MaCn']; ?></td>
        		<td><?php echo $item['user_id']; ?></td>
                <td><?php echo $item['password']; ?></td>
                <td><?php echo $item['CMND']; ?></td>
                <td><?php echo $item['email']; ?></td>
                <td><?php echo $item['SDT']; ?></td>
                <td>
                    <form method="post" action="student-delete.php">
                        <input onclick="window.location = 'student-edit.php?id=<?php echo $item['user_id']; ?>'" type="button" value="Sửa"/>
                        <input type="hidden" name="id" value="<?php echo $item['user_id']; ?>"/>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
