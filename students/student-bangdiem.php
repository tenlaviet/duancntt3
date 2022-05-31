<?php
session_start();
require '../libs/students.php';
require '../permission.php';
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh Sách Điểm</title>
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
        <?php include 'C:\xampp\htdocs\duancntt3\component\student-sidebar.php';?>
        <div class="wrapper">
            <h1>Danh Sách Điểm</h1>
                <div align="center">
                <form action="student-bangdiem.php" method="get" class="search-box">
                    <input type="text" name="search" class="search-input" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome"/>
                    <input type="submit" name="ok" value="search" class="search-btn"/>
                </form>
            </div>

            <table class="content-table">
                <thead>
                    <tr>
                        <th>ID khóa học</th>
                        <th>Mã môn</th>
                        <th>Tên môn</th>
                        <th>học kì</th>
                        <th>Điểm thi 1</th>
                        <th>Điểm quá trình</th>
                        <th>Điểm thi 2</th>
                        <th>Điểm tổng kết</th>                               
                    </tr>
                </thead>
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
        </div>
    </body>
</html>

