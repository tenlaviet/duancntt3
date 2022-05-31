<?php
session_start();
require '../permission.php';
require '../libs/students.php';

if(isset($_GET['id']))
{
    $danhsachid = $_GET['id'];
    // echo "$danhsachid";
}
else
{
    $danhsachid = $a;
    // echo "$danhsachid";

}
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách lop</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/png" href="../img/Logo-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="../img/Logo-16x16.png" sizes="16x16" />
        <link href="../styles/sidebar.css" rel="stylesheet" type="text/css" />
        <link href="../styles/header.css" rel="stylesheet" type="text/css" />
        <link href="../styles/table.css" rel="stylesheet" type="text/css" />
        <script src="https://kit.fontawesome.com/19fbdee3eb.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php include 'C:\xampp\htdocs\duancntt3\component\admin-sidebar.php';?>
        <div class="wrapper">
        <h1>Danh sách lớp</h1>
	        <div align="center">
            <form action="course-diem-list.php" method="get" class="search-box">
                <input type="text" name="search" class="search-input" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome"/>
                <input type="submit" name="ok" value="search" class="search-btn"/>
            </form>
        </div>

        <form method="get" action="course-diem-add" class="student-add">
            <i class="fa-solid fa-circle-plus"></i>
            <input onclick="window.location = 'course-diem-add.php?id=<?php echo $danhsachid; ?>'" type="button" value="Thêm"/>
        </form>

        <table class="content-table">
            <tr>
                <thead>
                    <th>Mã Sinh Viên</th>
                    <th>Điểm Thi 1</th>
                    <th>Điểm Quá Trình</th>
                    <th>Điểm Thi 2</th>
                    <th>Điểm Tổng Kết</th>
                    <th>Options</th>
                </thead>                               
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
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa" class="delete button"/>
                    </form>
                    <form method="get" action="course-diem-edit.php">
                    <input onclick="window.location = 'course-diem-edit.php?id1=<?php echo $danhsachid; ?>&id2=<?php echo $item['MaSv']; ?>'" type="button" value="Sửa" class="fix button"/>
                    
                     <input type="hidden" id="id1" name="id1" value="<?php echo $danhsachid; ?>">
                      <input type="hidden" id="id2" name="id2" value="<?php echo $item['MaSv']; ?>">
                    </form>

                </td>
            </tr>
            <?php } ?>
        </table>
        <script src="../scripts/dropdown.js"></script>
    </body>
</html>

