<?php

require '../libs/students.php';
// Nếu người dùng submit form
if (!empty($_POST['add_lop']))
{
    // Lay data
    $data['MaLop']= isset($_POST['malop']) ? $_POST['malop'] : '';
    $data['MaCn']= isset($_POST['macn']) ? $_POST['macn'] : '';
    $data['KhoaDaoTao']= isset($_POST['name']) ? $_POST['name'] : '';

	$macn = $data['MaCn'];
	$malop =$data['MaLop'];

  			

    // Validate thong tin

    $errors = array();
    if (empty($data['MaCn'])){
        $errors['MaCn'] = 'Vui lòng không để trống';
    }	
    if (empty($data['MaLop'])){
        $errors['MaLop'] = 'Vui lòng không để trống';
    }

    if (empty($data['KhoaDaoTao'])){
        $errors['KhoaDaoTao'] = 'Vui lòng không để trống';
    }


	$sql="select * from lop where MaLop='$malop'";
	$kt=mysqli_query($conn, $sql);	
	if (mysqli_num_rows($kt) > 0){
	$errors['malop'] = 'trung du lieu';
		}
	if (!$errors){
        add_lop($data['MaLop'], $data['MaCn'], $data['KhoaDaoTao']);
        
	

	//Trở về trang danh sách
        header("location: lop-list.php");


	}
}


disconnect_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Thêm lớp</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Thêm lớp</h1>
        <a href="lop-list.php">Trở về</a> <br/> <br/>
        <form method="post" action="lop-add.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Mã lớp</td>
                    <td>
                        <input type="text" name="malop" value=""/>
                        <?php if (!empty($errors['MaLop'])) echo $errors['MaLop'];?>
                    </td>
                </tr>
                <tr>
                    <td>Mã chuyên ngành</td>
                    <td>
                        <input type="text" name="macn" value=""/>
                        <?php if (!empty($errors['MaCn'])) echo $errors['MaCn'];?>
                    </td>
                </tr>

                <tr>
                    <td>Khóa đào tạo</td>
                    <td>
                        <input type="text" name="name" value=""/>
                        <?php if (!empty($errors['KhoaDaoTao'])) echo $errors['KhoaDaoTao']; ?>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="add_lop" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
