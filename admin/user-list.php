<?php
session_start();
require '../libs/students.php';
require_once("../libs/connection.php");

disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách user</title>
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
        <?php include 'C:\xampp\htdocs\duancntt3\component\sidebar.php';?>
        <div class="wrapper">
            <h1>Danh sách user</h1>
                <div align="center">
                <form action="user-list.php" method="get" class="search-box">
                    <input type="text" name="search" class="search-input" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome"/>
                    <input type="submit" name="ok" value="search" class="search-btn" />
                </form>
            </div>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>CMND</th>
                        <th>SDT</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <?php
            if (isset($_GET['search']) && $_GET['search'] != '') 
            {
                $sql = 'select * from user where id like "%'.$_GET['search'].'%" or username like "%'.$_GET['search'].'%" or CMND like "%'.$_GET['search'].'%" or SDT like "%'.$_GET['search'].'%" or Email like "%'.$_GET['search'].'%" or Permission like "%'.$_GET['search'].'%"'
                ;
            } 
                else {
                    $sql = 'select * from user';
                    }
                $user = executeResult($sql);
                $index = 1;
                foreach ($user as $item){ ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['username']; ?></td>
                    <td><?php echo $item['CMND']; ?></td>
                    <td><?php echo $item['SDT']; ?></td>
                    <td><?php echo $item['email']; ?></td>
                    <td><?php echo $item['permission']; ?></td>
                    <td>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </body>
</html>
