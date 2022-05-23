<?php
 
require './libs/students.php';
 
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
    



    $data['HoTen']= isset($_POST['name']) ? $_POST['name'] : '';
    $data['GioiTinh']         = isset($_POST['sex']) ? $_POST['sex'] : '';
    $data['NgaySinh']    = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $data['CMND']        = isset($_POST['cmnd']) ? $_POST['cmnd'] : '';
    $data['groupid']         = isset($_POST['groupid']) ? $_POST['groupid'] : '';
    $data['MaCn']    = isset($_POST['major']) ? $_POST['major'] : '';
    $data['email']    = isset($_POST['email']) ? $_POST['email'] : '';   
    // Validate thong tin
    $errors = array();
    if (empty($data['HoTen'])){
        $errors['HoTen'] = 'Vui lòng không để trống';
    }
     
    if (empty($data['GioiTinh'])){
        $errors['GioiTinh'] = 'Vui lòng không để trống';
    }
     
    // Neu ko co loi thi insert
    if (!$errors){
        edit_student($data['MaSv'], $data['HoTen'], $data['GioiTinh'], $data['NgaySinh'] , $data['groupid'], $data['MaCn'], $data['email'], $data['CMND']);
        // Trở về trang danh sách
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
        <h1>Thêm sinh vien </h1>
        <a href="student-list.php">Trở về</a> <br/> <br/>
        <form method="post" action="student-edit.php?id=<?php echo $data['MaSv']; ?>">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Họ tên</td>
                    <td>
                        <input type="text" name="name" value="<?php echo $data['HoTen']; ?>"/>

                    </td>
                </tr>
                <tr>
                    <td>Giới tính</td>
                    <td>
                        <select name="sex">
                            <option value="Nam">Nam</option>
				<option value="Nữ"<?php echo $data['GioiTinh']; ?>>Nữ</option>
                        </select>
                        
                    </td>
                </tr>
                <tr>
                    <td>Ngày sinh</td>
                    <td>
                        <input type="date" name="birthday" value="<?php echo $data['NgaySinh']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>CMND</td>
                    <td>
                        <input type="text" name="cmnd" value="<?php echo $data['CMND']; ?>"/>
			
                    </td>
                </tr>
                <tr>
                    <td>Lớp</td>
                    <td>
                        <input type="text" name="groupid" value="<?php echo $data['MaLop']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Chuyên ngành</td>
                    <td>
                        <input type="text" name="major" value="<?php echo $data['MaCn']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>
                        <input type="text" name="email" value="<?php echo $data['email']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $data['MaSv']; ?>"/>
                        <input type="submit" name="edit_student" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>