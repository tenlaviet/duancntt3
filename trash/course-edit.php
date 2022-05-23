<?php
 
require './libs/students.php';
 
// Lấy thông tin hiển thị lên để người dùng sửa
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id){
    $data = get_major($id);
}
 
// Nếu không có dữ liệu tức không tìm thấy sinh viên cần sửa
if (!$data){
   header("location: major-list.php");
}
 
// Nếu người dùng submit form
if (!empty($_POST['edit_major']))
{
    // Lay data
    $data['TenCn']= isset($_POST['name']) ? $_POST['name'] : '';  
    // Validate thong tin
    $errors = array();
    if (empty($data['TenCn'])){
        $errors['TenCn'] = 'Chưa nhập tên môn';
    }
    // Neu ko co loi thi insert
    if (!$errors){
        edit_major($data['MaCn'], $data['TenCn']);
        // Trở về trang danh sách
        header("location: major-list.php");
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
        <a href="major-list.php">Trở về</a> <br/> <br/>
        <form method="post" action="major-edit.php?id=<?php echo $data['MaCn']; ?>">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="name" value="<?php echo $data['TenCn']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $data['MaCn']; ?>"/>
                        <input type="submit" name="edit_major" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>