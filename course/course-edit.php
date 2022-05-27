<?php
 
require '../libs/students.php';
<<<<<<< HEAD
=======
require_once("../libs/connection.php");
>>>>>>> 9001369c661014b453e4639b5fd2818d183ea217
 
// Lấy thông tin hiển thị lên để người dùng sửa
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id){
    $data = get_course($id);
}
 
// Nếu không có dữ liệu tức không tìm thấy sinh viên cần sửa
if (!$data){
   header("location: course-list.php");
}
 
// Nếu người dùng submit form
if (!empty($_POST['edit_course']))
{
    // Lay data
    



    $data['MaMon']= isset($_POST['mamon']) ? $_POST['mamon'] : '';
    $data['HocKi']         = isset($_POST['hocki']) ? $_POST['hocki'] : '';
    $data['PhongHoc']    = isset($_POST['phonghoc']) ? $_POST['phonghoc'] : '';
    $data['MaGv']        = isset($_POST['magv']) ? $_POST['magv'] : '';
    $data['Thu']         = isset($_POST['thu']) ? $_POST['thu'] : '';
    $data['Ca']    = isset($_POST['ca']) ? $_POST['ca'] : '';
    $data['NgayThi']    = isset($_POST['ngaythi']) ? $_POST['ngaythi'] : '';
    // Lay data 
    // Validate thong tin
    $errors = array();
    if (empty($data['MaMon'])){
        $errors['MaMon'] = 'Vui lòng không để trống';
    }
     
    if (empty($data['HocKi'])){
        $errors['HocKi'] = 'Vui lòng không để trống';
    }

    if (empty($data['PhongHoc'])){
        $errors['PhongHoc'] = 'Vui lòng không để trống';
    }
    if (empty($data['MaGv'])){
        $errors['MaGv'] = 'Vui lòng không để trống';
    }
    if (empty($data['Thu'])){
        $errors['Thu'] = 'Vui lòng không để trống';
    }
    if (empty($data['Ca'])){
        $errors['Ca'] = 'Vui lòng không để trống';
    }
    if (empty($data['NgayThi'])){
    $errors['NgayThi'] = 'Vui lòng không để trống';
    }

     
    // Neu ko co loi thi insert
    if (!$errors){
        edit_course($data['id'], $data['MaMon'], $data['HocKi'], $data['PhongHoc'], $data['MaGv'], $data['Thu'], $data['Ca'], $data['NgayThi']);
        // Trở về trang danh sách
        header("location: course-list.php");
    }
}

 
disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Sửa khóa học</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Thêm khóa học </h1>
        <a href="course-list.php">Trở về</a> <br/> <br/>
        <form method="post" action="course-edit.php?id=<?php echo $data['id']; ?>">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                
                <tr>
                    <td>Mã Môn</td>
                    <td>
                        <input type="text" name="mamon" value="<?php echo $data['MaMon']; ?>"/>

                    </td>
                </tr>
                <tr>
                    <td>Học kì</td>
                    <td>
                    <input type="text" name="hocki" value="<?php echo $data['HocKi']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Phòng học</td>
                    <td>
                        <input type="text" name="phonghoc" value="<?php echo $data['PhongHoc']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Mã giáo viên</td>
                    <td>
                        <input type="text" name="magv" value="<?php echo $data['MaGv']; ?>"/>
            
                    </td>
                </tr>
                <tr>
                    <td>Thứ</td>
                    <td>
                        <input type="text" name="thu" value="<?php echo $data['Thu']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Ca học</td>
                    <td>
                        <input type="text" name="ca" value="<?php echo $data['Ca']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Ngày Thi</td>
                    <td>
                        <input type="date" name="ngaythi" value="<?php echo $data['NgayThi']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                        <input type="submit" name="edit_course" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>