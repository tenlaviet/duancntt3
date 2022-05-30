<?php
session_start();
require '../libs/students.php';
 
// Lấy thông tin hiển thị lên để người dùng sửa
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id){
    $data = get_giaovien($id);

}
// Nếu không có dữ liệu tức không tìm thấy sinh viên cần sửa
if (!$data){
   header("location: giaovien-list.php");
}
 
// Nếu người dùng submit form
if (!empty($_POST['edit_giaovien']))
{
    // Lay data
    


    $data['MaGv'] = isset($_POST['magv']) ? $_POST['magv'] : '';
    $data['HoTen']= isset($_POST['name']) ? $_POST['name'] : '';
    $data['GioiTinh']         = isset($_POST['sex']) ? $_POST['sex'] : '';
    $data['NgaySinh']    = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $data['CMND']        = isset($_POST['cmnd']) ? $_POST['cmnd'] : '';
    $data['ChuNhiem']         = isset($_POST['cn']) ? $_POST['cn'] : '';
    $data['MaCn']    = isset($_POST['major']) ? $_POST['major'] : '';
    $data['email']    = isset($_POST['email']) ? $_POST['email'] : '';
    $data['SDT']         = isset($_POST['sdt']) ? $_POST['sdt'] : '';
    $data['id']    = isset($_POST['userid']) ? $_POST['userid'] : '';
    $data['password']    = isset($_POST['password']) ? $_POST['password'] : '';  
    $data['permission']    = isset($_POST['permission']) ? $_POST['permission'] : '';     
    // Validate thong tin
    $errors = array();
    if (empty($data['HoTen'])){
        $errors['HoTen'] = 'Vui lòng không để trống';
    }
     
    if (empty($data['GioiTinh'])){
        $errors['GioiTinh'] = 'Vui lòng không để trống';
    }
    if (empty($data['NgaySinh'])){
        $errors['NgaySinh'] = 'Vui lòng không để trống';
    }
     
    if (empty($data['CMND'])){
        $errors['CMND'] = 'Vui lòng không để trống';
    }
    if (empty($data['MaCn'])){
        $errors['MaCn'] = 'Vui lòng không để trống';
    }
    if (empty($data['email'])){
        $errors['email'] = 'Vui lòng không để trống';
    }
     
    // Neu ko co loi thi insert
    if (!$errors){
        edit_giaovien($data['id'], $data['MaGv'], $data['password'], $data['HoTen'], $data['GioiTinh'], $data['NgaySinh'], $data['email'], $data['CMND'], $data['SDT'], $data['ChuNhiem'], $data['MaCn'], $data['permission']);
        // Trở về trang danh sách
        header("location: giaovien-list.php");
    }
}
 
disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Sửa giáo viên</title>
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
            <h1>Sửa giáo viên</h1>
            <form method="post" action="giaovien-edit.php?id=<?php echo $data['MaGv']; ?>" class="table-wrapper">
                <table class="verticle-table">
                    <tr>
                        <th>Mã giao vien</th>
                        <td>
                            <input type="text" name="magv" value="<?php echo $data['MaGv']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>password</th>
                        <td>
                            <input type="text" name="password" value="<?php echo $data['password']?>"/>
                        </td>
                    </tr>                
                    
                    <tr>
                        <th>Họ tên</th>
                        <td>
                            <input type="text" name="name" value="<?php echo $data['HoTen'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Giới tính</th>
                        <td>
                            <select name="sex">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày sinh</th>
                        <td>
                            <input type="date" name="birthday" value="<?php echo $data['NgaySinh']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>CMND</th>
                        <td>
                            <input type="text" name="cmnd" value="<?php echo $data['CMND']?>"/>
                        </td>
                    </tr>
                    <tr>
                    <th>Chủ Nhiệm</th>
                        <td>
                            <input type="text" name="cn" value="<?php echo $data['ChuNhiem']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Chuyên Ngành</th>
                        <td>
                            <input type="text" name="major" value="<?php echo $data['MaCn']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>
                            <input type="text" name="email" value="<?php echo $data['email']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>SDT</th>
                        <td>
                            <input type="number" name="sdt" value="<?php echo $data['SDT']?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>permission</th>
                        <td>
                            <input type="number" name="permission" value="<?php echo $data['permission']; ?>"/>
                        </td>
                    </tr> 
                </table>
                <input type="hidden" name="userid" value="<?php echo $data['user_id']; ?>"/>
                <input type="submit" name="edit_giaovien" value="Lưu" class="save button"/>
            </form>
        </div>
        <script src="../scripts/dropdown.js"></script>
    </body>
</html>