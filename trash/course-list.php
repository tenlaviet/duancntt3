<?php
require './libs/students.php';

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
            <form action="course-list.php" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        <a href="course-add.php">Thêm sinh viên</a> <br/> <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>ID</td>
                <td>MaMon</td>
                <td>HocKi</td>
                <td>PhongHoc</td>
                <td>MaGv</td>
                <td>Thu</td>
                <td>Ca</td>
                <td>NgayThi</td>                                
            </tr>

            <?php
		if (isset($_GET['search']) && $_GET['search'] != '') 
		{
			
			$sql = 'select * from course where id like "%'.$_GET['search'].'%" or MaMon like "%'.$_GET['search'].'%" or HocKi like "%'.$_GET['search'].'%" or PhongHoc like "%'.$_GET['search'].'%" or TenMon like "%'.$_GET['search'].'%" or MaGv like "%'.$_GET['search'].'%" or Thu like "%'.$_GET['search'].'%" or Ca like "%'.$_GET['search'].'%" or NgayThi like "%'.$_GET['search'].'%"'
			;
		} 
			else {
				$sql = 'select * from course';
			     }
			$course = executeResult($sql);
			$index = 1;
			foreach ($course as $item){ ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['MaMon']; ?></td>
                <td><?php echo $item['HocKi']; ?></td>
                <td><?php echo $item['PhongHoc']; ?></td>
                <td><?php echo $item['MaGv']; ?></td>
                <td><?php echo $item['Thu']; ?></td>
                <td><?php echo $item['Ca']; ?></td>
                <td><?php echo $item['NgayThi']; ?></td>
                <td>
                    <form method="post" action="course-delete.php">
                        <input onclick="window.location = 'course-edit.php?id=<?php echo $item['id']; ?>'" type="button" value="Sửa"/>
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>"/>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
