<?php
require './libs/students.php';

disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách chuyên ngành</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Danh sách chuyên ngành</h1>
	        <div align="center">
            <form action="major-list.php" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        <a href="major-add.php">Thêm sinh viên</a> <br/> <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Mã chuyên ngành</td>
                <td>Họ tên</td>
            </tr>

            <?php
		if (isset($_GET['search']) && $_GET['search'] != '') 
		{
			
			$sql = 'select * from major where MaCn like "%'.$_GET['search'].'%" or TenCn like "%'.$_GET['search'].'%"'
			;
		} 
			else {
				$sql = 'select * from major';
			     }
			$major = executeResult($sql);
			$index = 1;
			foreach ($major as $item){ ?>
            <tr>
                <td><?php echo $item['MaCn']; ?></td>
                <td><?php echo $item['TenCn']; ?></td>
                <td>
                    <form method="post" action="major-delete.php">
                        <input onclick="window.location = 'major-edit.php?id=<?php echo $item['MaCn']; ?>'" type="button" value="Sửa"/>
                        <input type="hidden" name="id" value="<?php echo $item['MaCn']; ?>"/>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
