<?php
require '../libs/students.php';
require_once("../libs/connection.php");
disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách lớp</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Danh sách lớp</h1>
	        <div align="center">
            <form action="lop-list.php" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        <a href="lop-add.php">Thêm sinh viên</a> <br/> <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Mã lớp</td>
                <td>Mã chuyên ngành</td>
		        <td>Khóa đào tạo</td>
            </tr>

            <?php
		if (isset($_GET['search']) && $_GET['search'] != '') 
		{
			
			$sql = 'select * from lop where MaLop like "%'.$_GET['search'].'%" or MaCn like "%'.$_GET['search'].'%" or KhoaDaoTao like "%'.$_GET['search'].'%"'
			;
		} 
			else {
				$sql = 'select * from lop';
			     }
			$lop = executeResult($sql);
			$index = 1;
			foreach ($lop as $item){ ?>
            <tr>
                <td><?php echo $item['MaLop']; ?></td>
                <td><?php echo $item['MaCn']; ?></td>
                <td><?php echo $item['KhoaDaoTao']; ?></td>

                <td>
                    <form method="post" action="lop-delete.php">
                        <input onclick="window.location = 'lop-edit.php?id=<?php echo $item['MaLop']; ?>'" type="button" value="Sửa"/>
                        <input type="hidden" name="id" value="<?php echo $item['MaLop']; ?>"/>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
