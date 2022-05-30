<?php
session_start();
require '../libs/students.php';
require_once("../libs/connection.php");
 
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
            <h1>Sửa khóa học</h1>
            <form method="post" action="course-edit.php?id=<?php echo $data['id']; ?>" class="table-wrapper">
                <table class="verticle-table">
                    <tr>
                        <th>Mã Môn</th>
                        <td>
                            <input type="text" name="mamon" value="<?php echo $data['MaMon']; ?>"/>

                        </td>
                    </tr>
                    <tr>
                        <th>Học kì</th>
                        <td>
                        <input type="text" name="hocki" value="<?php echo $data['HocKi']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Phòng học</th>
                        <td>
                            <input type="text" name="phonghoc" value="<?php echo $data['PhongHoc']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Mã giáo viên</th>
                        <td>
                            <input type="text" name="magv" value="<?php echo $data['MaGv']; ?>"/>
                
                        </td>
                    </tr>
                    <tr>
                        <th>Thứ</th>
                        <td>
                            <input type="text" name="thu" value="<?php echo $data['Thu']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Ca học</th>
                        <td>
                            <input type="text" name="ca" value="<?php echo $data['Ca']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày Thi</th>
                        <td>
                            <input type="date" name="ngaythi" value="<?php echo $data['NgayThi']; ?>"/>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                <input type="submit" name="edit_course" value="Lưu" class="save button"/>
            </form>
        </div>
        <script src="../scripts/dropdown.js"></script>
    </body>
</html>