<?php
session_start();
require '../permission.php';
require '../libs/students.php';
require_once("../libs/connection.php");
// Nếu người dùng submit form
if (!empty($_POST['add_monhoc']))
{
    // Lay data
    $data['MaMon']= isset($_POST['mamon']) ? $_POST['mamon'] : '';

    $data['TenMon']= isset($_POST['name']) ? $_POST['name'] : '';

	$mamon = $data['MaMon'];
	$tenmon =$data['TenMon'];

  			

    // Validate thong tin

    $errors = array();
    if (empty($data['MaMon'])){
        $errors['MaMon'] = 'Vui lòng không để trống';
    }	
    if (empty($data['TenMon'])){
        $errors['TenMon'] = 'Vui lòng không để trống';
    }


	$sql="select * from monhoc where MaMon='$mamon'";
	$kt=mysqli_query($conn, $sql);	
	if (mysqli_num_rows($kt) > 0){
	$errors['mamon'] = 'trung du lieu';
		}
	if (!$errors){
        add_monhoc($data['MaMon'], $data['TenMon']);
        
	

	//Trở về trang danh sách
        header("location: monhoc-list.php");


	}
}


disconnect_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Thêm môn học</title>
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
            <h1>Thêm môn học</h1>
            <form method="post" action="monhoc-add.php" class="table-wrapper">
                <table class="verticle-table">
                    <tr>
                        <th>Mã môn</th>
                        <td>
                            <input type="text" name="mamon" value=""/>
                            <?php if (!empty($errors['MaMon'])) echo $errors['MaMon'];?>
                            <?php if (!empty($errors['mamon'])) echo $errors['mamon'];?>
                        </td>
                    </tr>

                    <tr>
                        <th>Tên môn</th>
                        <td>
                            <input type="text" name="name" value=""/>
                            <?php if (!empty($errors['TenMon'])) echo $errors['TenMon']; ?>
                    </tr>
                </table>
                <input type="submit" name="add_monhoc" value="Lưu" class="save button"/>
            </form>
        </div>
        <script src="../scripts/dropdown.js"></script>
    </body>
</html>
