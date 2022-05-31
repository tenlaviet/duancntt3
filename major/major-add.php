<?php
session_start();
require '../permission.php';
require '../libs/students.php';
require_once("../libs/connection.php");
// Nếu người dùng submit form
if (!empty($_POST['add_major']))
{
    // Lay data
    $data['MaCn']= isset($_POST['macn']) ? $_POST['macn'] : '';

    $data['TenCn']= isset($_POST['name']) ? $_POST['name'] : '';

	$macn = $data['MaCn'];
	$tencn =$data['TenCn'];

  			

    // Validate thong tin

    $errors = array();
    if (empty($data['MaCn'])){
        $errors['MaCn'] = 'Vui lòng không để trống';
    }	
    if (empty($data['TenCn'])){
        $errors['TenCn'] = 'Vui lòng không để trống';
    }


	$sql="select * from major where MaCn='$macn'";
	$kt=mysqli_query($conn, $sql);	
	if (mysqli_num_rows($kt) > 0){
	$errors['macn'] = 'trung du lieu';
		}
    
	if (!$errors){
        add_major($data['MaCn'], $data['TenCn']);
        
	

	//Trở về trang danh sách
        header("location: major-list.php");


	}
}


disconnect_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Thêm chuyên ngành</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="preconnect" href="https://fonts.googleapis.com" />
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
            <h1>Thêm chuyên ngành</h1>
            <form method="post" action="major-add.php" class="table-wrapper">
                <table class="verticle-table">
                    <tr>
                        <th>Mã chuyên ngành</th>
                        <td>
                            <input type="text" name="macn" value=""/>
                            <?php if (!empty($errors['macn'])) echo $errors['macn'];?>
                        </td>
                    </tr>

                    <tr>
                        <th>Tên ngành</th>
                        <td>
                            <input type="text" name="name" value=""/>
                            <?php if (!empty($errors['TenCn'])) echo $errors['TenCn']; ?>
                    <tr>
                </table>
                <input type="submit" name="add_major" value="Lưu" class="save button"/>
            </form>
        </div>
        <script src="../scripts/dropdown.js"></script>
    </body>
</html>
