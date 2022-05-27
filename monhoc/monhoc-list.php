<?php
session_start();
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
            <h1>Danh sách môn học</h1>
                <div align="center">
                <form action="monhoc-list.php" method="get" class="search-box">
                    <input type="text" name="search" class="search-input" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome"/>
                    <input type="submit" name="ok" value="search" class="search-btn" />
                </form>
            </div>
            <a href="monhoc-add.php"class="student-add"><i class="fa-solid fa-plus"></i>Thêm sinh viên</a> <br/> <br/>
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
        </div>
    </body>
</html>
