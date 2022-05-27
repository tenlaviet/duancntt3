<?php
require '../libs/students.php';

if(isset($_GET['id']))
{
    $danhsachid = $_GET['id'];
    echo "$danhsachid";
}
else
{
    $danhsachid = $a;
    echo "$danhsachid";

}
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
            <form action="course-diem-list.php" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        <a href="course-list.php">Trở về</a> <br/> <br/>
        <form method="get" action="course-diem-add">
        <input onclick="window.location = 'course-diem-add.php?id=<?php echo $danhsachid; ?>'" type="button" value="them"/>
        </form>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                
                <td>MaSv</td>
                <td>diemthi1</td>
                <td>diemquatrinh</td>
                <td>diemthi2</td>
                <td>diemtongket</td>                               
            </tr>

            <?php
		if (isset($_GET['search']) && $_GET['search'] != '') 
		{
			
			$sql = "select MaSv, DiemThi1,DiemQuaTrinh,DiemThi2,DiemTongKet from bangdiem where MaKhoaHoc = '$danhsachid'"
			;
		} 
			else {
				$sql = "select MaSv, DiemThi1,DiemQuaTrinh,DiemThi2,DiemTongKet from bangdiem where MaKhoaHoc= '$danhsachid'";
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

                        <input type="hidden" name="id" value="<?php echo $item['MaSv']; ?>"/>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>
                    </form>
                    <form method="get" action="course-diem-edit.php">
                    <input onclick="window.location = 'course-diem-edit.php?id1=<?php echo $danhsachid; ?>&id2=<?php echo $item['MaSv']; ?>'" type="button" value="S"/>
                    
                     <input type="hidden" id="id1" name="id1" value="<?php echo $danhsachid; ?>">
                      <input type="hidden" id="id2" name="id2" value="<?php echo $item['MaSv']; ?>">
                    </form>

                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>

