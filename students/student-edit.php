<?php
 
require '../libs/students.php';
 
// Lấy thông tin hiển thị lên để người dùng sửa
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id){
    $data = get_student($id);

}
 
// Nếu không có dữ liệu tức không tìm thấy sinh viên cần sửa
if (!$data){
   header("location: student-list.php");
}
 
// Nếu người dùng submit form
if (!empty($_POST['edit_student']))
{
    // Lay data
    



    $data['MaSv']= isset($_POST['masv']) ? $_POST['masv'] : '';
    $data['HoTen']= isset($_POST['name']) ? $_POST['name'] : '';
    $data['GioiTinh']         = isset($_POST['sex']) ? $_POST['sex'] : '';
    $data['NgaySinh']    = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $data['CMND']        = isset($_POST['cmnd']) ? $_POST['cmnd'] : '';
    $data['MaLop']         = isset($_POST['groupid']) ? $_POST['groupid'] : '';
    $data['MaCn']    = isset($_POST['major']) ? $_POST['major'] : '';
    $data['email']    = isset($_POST['email']) ? $_POST['email'] : '';
    $data['SDT']         = isset($_POST['sdt']) ? $_POST['sdt'] : '';
    $data['id']    = isset($_POST['userid']) ? $_POST['userid'] : '';
    $data['password']    = isset($_POST['password']) ? $_POST['password'] : '';  
    $data['permission']    = isset($_POST['permission']) ? $_POST['permission'] : '';   
    $masv = $data['MaSv'];
    $email = $data['email'];
    $CMND = $data['CMND'];  
    // Validate thong tin
    $errors = array();

    if (empty($data['MaSv'])){
        $errors['MaSv'] = 'Chưa nhập Mã sinh viên';
    }   
    if (empty($data['HoTen'])){
        $errors['HoTen'] = 'Chưa nhập tên sinh viên';
    }
     
    if (empty($data['GioiTinh'])){
    $errors['GioiTinh'] = 'Chưa nhập giới tính';

    }
    if (empty($data['CMND'])){
    $errors['CMND'] = 'Chưa nhập CMND';

    }
    if (empty($data['email'])){
    $errors['email'] = 'Chưa nhập email';

    }
     
    // Neu ko co loi thi insert
    if (!$errors){
        edit_student($data['id'], $data['MaSv'], $data['password'], $data['HoTen'], $data['GioiTinh'], $data['NgaySinh'], $data['email'], $data['CMND'], $data['SDT'], $data['MaLop'], $data['MaCn'], $data['permission']);
         //Trở về trang danh sách
               // edit_student('77','A77777' , '54', 'test123', 'Nu', ' 2001-10-07', 'giday@', '111111111116', '2323236', 'TT32A1', '7480207', '4');
        header("location: student-list.php");
    }
}
 
disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Sửa sinh viên</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Sửa sinh vien </h1>
        <a href="student-list.php">Trở về</a> <br/> <br/>
        <form method="post" action="student-edit.php?id=<?php echo $data['MaSv']; ?>">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">             
                <tr>
                    <td>Mã sinh viên</td>
                    <td>
                        <input type="text" name="masv" value="<?php echo $data['MaSv']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>
                        <input type="text" name="password" value="<?php echo $data['password']?>"/>
                    </td>
                </tr>                

                <tr>
                    <td>Họ tên</td>
                    <td>
                        <input type="text" name="name" value="<?php echo $data['HoTen'] ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Giới tính</td>
                    <td>
                        <select name="sex">
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Ngày sinh</td>
                    <td>
                        <input type="date" name="birthday" value="<?php echo $data['NgaySinh']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>CMND</td>
                    <td>
                        <input type="text" name="cmnd" value="<?php echo $data['CMND']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Lớp</td>
                    <td>
                        <input type="text" name="groupid" value="<?php echo $data['MaLop']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Chuyên ngành</td>
                    <td>
                        <input type="text" name="major" value="<?php echo $data['MaCn']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>
                        <input type="text" name="email" value="<?php echo $data['email']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>SDT</td>
                    <td>
                        <input type="number" name="sdt" value="<?php echo $data['SDT']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>permission</td>
                    <td>
                        <input type="number" name="permission" value="<?php echo $data['permission']; ?>"/>
                    </td>
                </tr> 
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="userid" value="<?php echo $data['id']; ?>"/>
                        <input type="submit" name="edit_student" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>