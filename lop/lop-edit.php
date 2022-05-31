<?php
 
require '../libs/students.php';
require_once("../libs/connection.php"); 
// Lấy thông tin hiển thị lên để người dùng sửa
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id){
    $data = get_lop($id);
}
 
// Nếu không có dữ liệu tức không tìm thấy sinh viên cần sửa
if (!$data){
   header("location: lop-list.php");
}
 
// Nếu người dùng submit form
if (!empty($_POST['edit_lop']))
{
    // Lay data
    //$data['MaLop']= isset($_POST['malop']) ? $_POST['malop'] : '';
    $data['KhoaDaoTao']= isset($_POST['name']) ? $_POST['name'] : '';
    $data['MaCn']= isset($_POST['macn']) ? $_POST['macn'] : '';
    $malop = isset($_POST['malop1']) ? $_POST['malop1'] : '';  
    
    // Validate thong tin
    $errors = array();
    if (empty($data['MaLop'])){
        $errors['MaLop'] = 'Vui lòng không để trống';
    }	

    if (empty($data['KhoaDaoTao'])){
        $errors['KhoaDaoTao'] = 'Vui lòng không để trống';
    }




	if (!$errors){
        edit_lop($data['MaLop'], $malop, $data['MaCn'], $data['KhoaDaoTao']);
        
	

	//Trở về trang danh sách
        header("location: lop-list.php");


	}
}
 
disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Sửa lớp</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Sửa lớp</h1>
        <a href="lop-list.php">Trở về</a> <br/> <br/>
        <form method="post" action="lop-edit.php?id=<?php echo $data['MaLop']; ?>">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Mã lớp</td>
                    <td>
                        <input type="text" name="malop1" value="<?php echo $data['MaLop']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Mã chuyên ngành</td>
                    <td>
                        <input type="text" name="macn" value="<?php echo $data['MaCn']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Khóa đào tạo</td>
                    <td>
                        <input type="text" name="name" value="<?php echo $data['KhoaDaoTao']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $data['MaLop']; ?>"/>
                        <input type="submit" name="edit_lop" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>