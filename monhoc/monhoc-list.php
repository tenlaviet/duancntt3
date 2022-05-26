<?php
require '../libs/students.php';
require_once("../libs/connection.php");

disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách môn học</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../styles/sidebar.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php include 'C:\xampp\htdocs\duancntt3\component\sidebar.php';?>
        <h1>Danh sách môn học</h1>
	        <div align="center">
            <form action="monhoc-list.php" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        <a href="monhoc-add.php">Thêm sinh viên</a> <br/> <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Mã môn</td>
                <td>Tên môn</td>
            </tr>

            <?php
		if (isset($_GET['search']) && $_GET['search'] != '') 
		{
			$sql = 'select * from monhoc where MaMon like "%'.$_GET['search'].'%" or TenMon like "%'.$_GET['search'].'%"'
			;
		} 
			else {
				$sql = 'select * from monhoc';
			     }
			$monhoc = executeResult($sql);
			$index = 1;
			foreach ($monhoc as $item){ ?>
            <tr>
                <td><?php echo $item['MaMon']; ?></td>
                <td><?php echo $item['TenMon']; ?></td>
                <td>
                    <form method="post" action="monhoc-delete.php">
                        <input onclick="window.location = 'monhoc-edit.php?id=<?php echo $item['MaMon']; ?>'" type="button" value="Sửa"/>
                        <input type="hidden" name="id" value="<?php echo $item['MaMon']; ?>"/>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
