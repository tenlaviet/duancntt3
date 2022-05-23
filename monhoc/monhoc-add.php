<?php

require './libs/students.php';
require_once("connection.php");
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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Thêm môn học</h1>
        <a href="monhoc-list.php">Trở về</a> <br/> <br/>
        <form method="post" action="monhoc-add.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Mã môn</td>
                    <td>
                        <input type="text" name="mamon" value=""/>
                        <?php if (!empty($errors['MaMon'])) echo $errors['MaMon'];?>
			            <?php if (!empty($errors['mamon'])) echo $errors['mamon'];?>
                    </td>
                </tr>

                <tr>
                    <td>Tên môn</td>
                    <td>
                        <input type="text" name="name" value=""/>
                        <?php if (!empty($errors['TenMon'])) echo $errors['TenMon']; ?>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="add_monhoc" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
