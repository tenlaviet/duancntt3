<?php
session_start();
require '../libs/students.php';
require_once("../libs/connection.php");
// Nếu người dùng submit form

$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id){
    $data = $_GET['id'];
    // echo "$data";
}

if (!empty($_POST['add_course_diem']))
{
    // Lay data
    $masv= isset($_POST['masv']) ? $_POST['masv'] : '';
        $errors = array();
 
    if (empty($masv)){
        $errors['MaSv'] = 'Vui lòng điền thông tin';
    }       
    if (!$errors){
        add_bangdiem($masv,$_POST['id']);
        
    

    //Trở về trang danh sách
        
        header('location:course-diem-list.php?id='.$_POST['id'].'');



    }
}



disconnect_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Thêm sinh Viên</title>
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
            <h1>Thêm sinh viên</h1>
            <form method="post" action="course-diem-add.php" class="table-wrapper">
                <table class="verticle-table">
                    <tr>
                        <th>Mã Sinh Viên</th>
                        <td>
                            <input type="text" name="masv" value=""/>
                            <?php if (!empty($errors['MaSv'])) echo $errors['MaSv'];?>
                            
                        </td>
                    </tr>
                </table>
                <input type="submit" name="add_course_diem" value="Lưu" class="save button"/>
               <input type="hidden" name="id" value="<?php echo $data; ?>"/>
            </form>
        </div>
        <script src="../scripts/dropdown.js"></script>
    </body>
</html>
