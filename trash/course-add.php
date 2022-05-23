<?php

require './libs/students.php';
require_once("connection.php");
// Nếu người dùng submit form
if (!empty($_POST['add_major']))
{
    // Lay data
    $data['MaCourse']= isset($_POST['macourse']) ? $_POST['macourse'] : '';
    $data['MaMon']= isset($_POST['mamon']) ? $_POST['mamon'] : '';
    $data['HocKi']         = isset($_POST['hocki']) ? $_POST['hocki'] : '';
    $data['PhongHoc']    = isset($_POST['PhongHoc']) ? $_POST['PhongHoc'] : '';
    $data['MaGv']        = isset($_POST['magv']) ? $_POST['magv'] : '';
    $data['Thu']         = isset($_POST['thu']) ? $_POST['thu'] : '';
    $data['Ca']    = isset($_POST['ca']) ? $_POST['ca'] : '';
    $data['NgayThi']    = isset($_POST['ngaythi']) ? $_POST['ngaythi'] : '';
    // Validate thong tin

    $errors = array();
    if (empty($data['MaCourse'])){
        $errors['MaCourse'] = 'Chưa nhập Mã sinh viên';
    }	
    if (empty($data['MaMon'])){
        $errors['MaMon'] = 'Chưa nhập tên sinh viên';
    }
    if (empty($data['HocKi'])){
        $errors['HocKi'] = 'Chưa nhập Mã sinh viên';
    }   
    if (empty($data['PhongHoc'])){
        $errors['PhongHoc'] = 'Chưa nhập tên sinh viên';
    }
    if (empty($data['MaGv'])){
        $errors['MaGv'] = 'Chưa nhập Mã sinh viên';
    }   
    if (empty($data['Thu'])){
        $errors['Thu'] = 'Chưa nhập tên sinh viên';
    }
    if (empty($data['Ca'])){
        $errors['Ca'] = 'Chưa nhập tên sinh viên';
    }    
	if (!$errors){
        add_course($data['MaCourse'], $data['MaMon'], $data['HocKi'], $data['PhongHoc'], $data['MaGv'], $data['Thu'], $data['Ca']);
        
	

	//Trở về trang danh sách
        header("location: course-list.php");


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
        <a href="course-list.php">Trở về</a> <br/> <br/>
        <form method="post" action="course-add.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>MaCourse</td>
                    <td>
                        <input type="text" name="macourse" value=""/>
                        <?php if (!empty($errors['macn'])) echo $errors['macn'];?>
                    </td>
                </tr>
                <tr>
                    <td>MaMon</td>
                    <td>
                        <input type="text" name="mamon" value=""/>
                        <?php if (!empty($errors['MaMon'])) echo $errors['MaMon'];?>
                    </td>
                </tr>
                <tr>
                    <td>HocKi</td>
                    <td>
                        <input type="text" name="hocki" value=""/>
                        <?php if (!empty($errors['HocKi'])) echo $errors['HocKi'];?>
                    </td>
                </tr>
                <tr>
                    <td>PhongHoc</td>
                    <td>
                        <input type="text" name="phonghoc" value=""/>
                        <?php if (!empty($errors['PhongHoc'])) echo $errors['PhongHoc']; ?>
                    </td>
                </tr>
                <tr>
                    <td>MaGv</td>
                    <td>
                        <input type="text" name="magv" value=""/>
                        <?php if (!empty($errors['MaGv']) echo $errors['MaGv'];?>
                    </td>
                </tr>
                <tr>
                    <td>Thu</td>
                    <td>
                        <input type="text" name="thu" value=""/>
                        <?php if (!empty($errors['Thu'])) echo $errors['Thu'];?>
                    </td>
                </tr>

                <tr>
                    <td>Ca</td>
                    <td>
                        <input type="text" name="ca" value=""/>
                        <?php if (!empty($errors['Ca'])) echo $errors['Ca']; ?>
                    </td>    
                </tr>
                <tr>
                    <td>NgayThi</td>
                    <td>
                        <input type="text" name="ngaythi" value=""/>
                    </td>   
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="add_course" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
