<?php
 session_start();
 require '../permission.php';
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
    $mamon1= isset($_POST['mamon1']) ? $_POST['mamon1'] : '';   
    // Validate thong tin
    $errors = array();
    if (empty($data['TenMon'])){
        $errors['TenMon'] = 'Vui lòng không để trống';
    }
    // Neu ko co loi thi insert
    if (!$errors){
        edit_monhoc($data['MaMon'], $mamon1, $data['TenMon']);
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
            <h1>Thêm môn học</h1>
            <form method="post" action="monhoc-edit.php?id=<?php echo $data['MaMon']; ?>" class="table-wrapper">
                <table class="verticle-table">
                    <tr>
                        <th>Mã môn</th>
                        <td>
                            <input type="text" name="mamon1" value="<?php echo $data['MaMon']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Tên môn</th>
                        <td>
                            <input type="text" name="name" value="<?php echo $data['TenMon']; ?>"/>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="id" value="<?php echo $data['MaMon']; ?>"/>
                <input type="submit" name="edit_monhoc" value="Lưu" class="save button"/>
            </form>
        </div>
        <script src="../scripts/dropdown.js"></script>
    </body>
</html>