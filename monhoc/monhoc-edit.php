<?php
 
require '../libs/students.php';
require_once("../libs/connection.php");
 
// Lấy thông tin hiển thị lên để người dùng sửa
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id){
    $data = get_monhoc($id);
}
 
// Nếu không có dữ liệu tức không tìm thấy sinh viên cần sửa
if (!$data){
   header("location: monhoc-list.php");
}
 
// Nếu người dùng submit form
if (!empty($_POST['edit_monhoc']))
{
    // Lay data
    $data['TenMon']= isset($_POST['name']) ? $_POST['name'] : '';  
    // Validate thong tin
    $errors = array();
    if (empty($data['TenMon'])){
        $errors['TenMon'] = 'Vui lòng không để trống';
    }
    // Neu ko co loi thi insert
    if (!$errors){
        edit_monhoc($data['MaMon'], $data['TenMon']);
        // Trở về trang danh sách
        header("location: monhoc-list.php");
    }
}
 
disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Sửa môn học</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Thêm môn học</h1>
        <a href="monhoc-list.php">Trở về</a> <br/> <br/>
        <form method="post" action="monhoc-edit.php?id=<?php echo $data['MaMon']; ?>">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Tên môn</td>
                    <td>
                        <input type="text" name="name" value="<?php echo $data['TenMon']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $data['MaMon']; ?>"/>
                        <input type="submit" name="edit_monhoc" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>