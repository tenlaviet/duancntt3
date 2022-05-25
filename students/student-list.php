<?php
require '../libs/students.php';

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
        <a href="student-add.php">Thêm sinh viên</a> <br/> <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Mã sinh viên</td>
                <td>Họ tên</td>
		        <td>Giới tính</td>
                <td>Ngày sinh</td>
		        <td>CMND</td>
                <td>Lớp</td>
		        <td>Chuyên ngành</td>
		        <td>email</td>
                <td>Options</td>
            </tr>

            <?php
		if (isset($_GET['search']) && $_GET['search'] != '') 
		{
			$sql = 'select * from sinhvien where MaSv like "%'.$_GET['search'].'%" or HoTen like "%'.$_GET['search'].'%" or GioiTinh like "%'.$_GET['search'].'%" or MaCn like "%'.$_GET['search'].'%"
			or NgaySinh like "%'.$_GET['search'].'%" or email like "%'.$_GET['search'].'%" or MaLop like "%'.$_GET['search'].'%"'
			;
		} 
			else {
				$sql = 'select * from sinhvien';
			     }
			$students = executeResult($sql);
			$index = 1;
			foreach ($students as $item){ ?>
            <tr>
                <td><?php echo $item['MaSv']; ?></td>
                <td><?php echo $item['HoTen']; ?></td>
                <td><?php echo $item['GioiTinh']; ?></td>
                <td><?php echo $item['NgaySinh']; ?></td>
		        <td><?php echo $item['CMND']; ?></td>
        		<td><?php echo $item['MaLop']; ?></td>
        		<td><?php echo $item['MaCn']; ?></td>
        		<td><?php echo $item['email']; ?></td>
                <td>
                    <form method="post" action="student-delete.php">
                        <input onclick="window.location = 'student-edit.php?id=<?php echo $item['MaSv']; ?>'" type="button" value="Sửa"/>
                        <input type="hidden" name="id" value="<?php echo $item['MaSv']; ?>"/>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
