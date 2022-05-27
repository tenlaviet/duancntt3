<?php
session_start();
require '../libs/students.php';
require_once("../libs/connection.php");

disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách học</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/png" href="../img/Logo-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="../img/Logo-16x16.png" sizes="16x16" />
        <link href="../styles/sidebar.css" rel="stylesheet" type="text/css" />
        <link href="../styles/header.css" rel="stylesheet" type="text/css" />
        <script src="https://kit.fontawesome.com/19fbdee3eb.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php include 'C:\xampp\htdocs\duancntt3\component\sidebar.php';?>
        <div class="wrapper">
            <h1>Danh sách khóa học</h1>
                <div align="center">
                <form action="course-list.php" method="get" class="search-box">
                    <input type="text" name="search" class="search-input" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome"/>
                    <input type="submit" name="ok" value="search" class="search-btn" />
                </form>
            </div>
            <a href="course-add.php"class="student-add"><i class="fa-solid fa-plus"></i>Thêm sinh viên</a> <br/> <br/>
            <table width="100%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>ID</td>
                    <td>Môn</td>
                    <td>Học kì</td>
                    <td>Phòng học</td>
                    <td>Giáo Viên</td>
                    <td>Thứ</td>
                    <td>Ca học</td>
                    <td>Ngày thi</td>                                
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
                        <form method="get" action="course-diem-list.php">
                            <input onclick="window.location = 'course-diem-list.php?id=<?php echo $item['id']; ?>'" type="button" value="danhsach"/>
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>"/>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </body>
</html>
