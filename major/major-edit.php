<?php
 session_start();
require '../libs/students.php';
require_once("../libs/connection.php");
 
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
        $errors['TenCn'] = 'Vui lòng không để trống';
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
        <title>Sửa chuyên ngành</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="preconnect" href="https://fonts.googleapis.com" />
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
            <h1>Sửa chuyên ngành</h1>
            <form method="post" action="major-edit.php?id=<?php echo $data['MaCn']; ?>" class="table-wrapper">
                <table class="verticle-table">
                    <tr>
                        <th>Tên chuyên ngành</th>
                        <td>
                            <input type="text" name="name" value="<?php echo $data['TenCn']; ?>"/>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="id" value="<?php echo $data['MaCn']; ?>"/>
                <input type="submit" name="edit_major" value="Lưu" class="save button"/>
            </form>
        </div>
        <script src="../scripts/dropdown.js"></script>
    </body>
</html>