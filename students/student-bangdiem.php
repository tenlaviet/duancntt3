<?php
session_start();
require '../libs/students.php';

?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách cac mon</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Danh sách diem</h1>
	        <div align="center">
            <form action="student-bangdiem.php" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        <a href="student-profile.php">Trở về</a> <br/> <br/>

        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>id</td>
                <td>mamon</td>
                <td>tenmon</td>
                <td>hocki</td>
                <td>diemthi1</td>
                <td>diemquatrinh</td>
                <td>diemthi2</td>
                <td>diemtongket</td>                               
            </tr>

            <?php
            $data = get_user($_SESSION['username']);
            $username = $data['username'];
		if (isset($_GET['search']) && $_GET['search'] != '') 
		{
			
			$sql = "select b.MaKhoaHoc, b.DiemQuaTrinh, b.DiemThi1, b.DiemThi2, b.DiemTongKet, m.MaMon, m.TenMon, c.HocKi from bangdiem b inner join course c on b.MaKhoaHoc = 

            c.id inner join monhoc m on c.MaMon =m.MaMon where b.MaSv ='$username';";
		} 
			else {
				$sql = "select b.MaKhoaHoc, b.DiemQuaTrinh, b.DiemThi1, b.DiemThi2, b.DiemTongKet, m.MaMon, m.TenMon, c.HocKi from bangdiem b inner join course c on b.MaKhoaHoc = c.id inner join monhoc m on c.MaMon =m.MaMon where b.MaSv ='$username';";
			     }
			$course = executeResult($sql);
			$index = 1;
			foreach ($course as $item){ ?>
            <tr>

                <td><?php echo $item['MaKhoaHoc']; ?></td>
                <td><?php echo $item['MaMon']; ?></td>
                <td><?php echo $item['TenMon']; ?></td>
                <td><?php echo $item['HocKi']; ?></td>
                <td><?php echo $item['DiemThi1']; ?></td>
                <td><?php echo $item['DiemQuaTrinh']; ?></td>
                <td><?php echo $item['DiemThi2']; ?></td>
                <td><?php echo $item['DiemTongKet']; ?></td>

            </tr>
            <?php } ?>
        </table>
    </body>
</html>

