<?php

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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Thêm chuyên ngành</h1>
        <a href="major-list.php">Trở về</a> <br/> <br/>
        <form method="post" action="major-add.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Mã chuyên ngành</td>
                    <td>
                        <input type="text" name="macn" value=""/>
                        <?php if (!empty($errors['macn'])) echo $errors['macn'];?>
                    </td>
                </tr>

                <tr>
                    <td>Tên ngành</td>
                    <td>
                        <input type="text" name="name" value=""/>
                        <?php if (!empty($errors['TenCn'])) echo $errors['TenCn']; ?>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="add_major" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
