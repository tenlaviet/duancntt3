<?php
require '../libs/students.php';
require_once("../libs/connection.php");

disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách lop</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Danh sách lop</h1>
	        <div align="center">
            <form action="course-diem.php" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        <a href="course-diem-add.php">them sinh vien</a> <br/> <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>ID</td>
                <td>MaSv</td>
                <td>diemthi1</td>
                <td>diemquatrinh</td>
                <td>diemthi2</td>
                <td>diemtongket</td>                               
            </tr>

            <?php
		if (isset($_GET['search']) && $_GET['search'] != '') 
		{
			
			$sql = 'select MaSv, DiemThi1,DiemQuaTrinh,DiemThi2,DiemTongKet from bangdiem where MaKhoaHoc =id and MaSv like "%'.$_GET['search'].'%"'
			;
		} 
			else {
				$sql = 'select MaSv, DiemThi1,DiemQuaTrinh,DiemThi2,DiemTongKet from bangdiem where MaKhoaHoc= id';
			     }
			$course = executeResult($sql);
			$index = 1;
			foreach ($course as $item){ ?>
            <tr>
                <td><?php echo $item['MaSv']; ?></td>
                <td><?php echo $item['DiemThi1']; ?></td>
                <td><?php echo $item['DiemQuaTrinh']; ?></td>
                <td><?php echo $item['DiemThi2']; ?></td>
                <td><?php echo $item['DiemTongKet']; ?></td>
                <td>
                    <form method="post" action="course-diem-delete.php">
                        <input onclick="window.location = 'course-diem-edit.php?id=<?php echo $item['MaSv']; ?>'" type="button" value="Sửa"/>
                        <input type="hidden" name="id" value="<?php echo $item['MaSv']; ?>"/>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                    </form>
                    <form method="post" action="course-diem">
                        <input onclick="window.location='course-diem.php?id=<?php echo $item['id']; ?>'" type ="button" value="sua diem"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
