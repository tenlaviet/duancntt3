<?php

require '../libs/students.php';
require_once("../libs/connection.php");
// Nếu người dùng submit form

$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id){
    $data = $_GET['id'];
    echo "$data";
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
        <title>Thêm sinh vien</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Thêm sinh vien</h1>
                    <form method="get" action="course-diem-list.php">
                        <input onclick="window.location = 'course-diem-list.php?id=<?php echo"$data"; ?>'" type="button" value="tro ve"/>
                    </form>
        <form method="post" action="course-diem-add.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>masv</td>
                    <td>
                        <input type="text" name="masv" value=""/>
                        <?php if (!empty($errors['MaSv'])) echo $errors['MaSv'];?>
                        
                    </td>
                </tr>
                    <td></td>
                    <td>
                        <input type="submit" name="add_course_diem" value="Lưu"/>
                        <input type="hidden" name="id" value="<?php echo $data; ?>"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
