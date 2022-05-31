<?php
session_start();
require '../permission.php';
require '../libs/students.php';
require_once("../libs/connection.php");
disconnect_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Danh Sách Lớp</title>
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
            <h1>Danh Sách Lớp</h1>
                <div align="center">
                <form action="lop-list.php" method="get" class="search-box">
                    <input type="text" name="search" class="search-input" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome"/>
                    <input type="submit" name="ok" value="search" class="search-btn"/>
                </form>
            </div>
            <a href="lop-add.php"class="student-add"><i class="fa-solid fa-circle-plus"></i>Thêm Lớp</a>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Mã Lớp</th>
                        <th>Mã Chuyên Ngành</th>
                        <th>Khóa Đào Tạo</th>
                        <th>Options</th>
                    </tr>
                </thead>
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
                            <input onclick="window.location = 'lop-edit.php?id=<?php echo $item['MaLop']; ?>'" type="button" value="Sửa" class="fix button"/>
                            <input type="hidden" name="id" value="<?php echo $item['MaLop']; ?>"/>
                            <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa" class="delete button"/>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <script src="../scripts/dropdown.js"></script>
    </body>
</html>
