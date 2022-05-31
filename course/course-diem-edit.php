<?php
session_start();
require '../permission.php';
require '../libs/students.php';
require_once("../libs/connection.php");
 
// Lấy thông tin hiển thị lên để người dùng sửa
// echo $_GET['id1'];
// echo $_GET['id2'];
$id1 = isset($_GET['id1']) ? $_GET['id1'] : '';
$id2 = isset($_GET['id2']) ? $_GET['id2'] : '';
if ($id1){
    if($id2)
    {
        $data = get_course_student($id1,$id2);
        // echo $data['MaKhoaHoc'];
        // echo $data['MaSv'];

    }
}
if (!$data){
   header("location: course-list.php");
}
 
// Nếu không có dữ liệu tức không tìm thấy sinh viên cần sửa

 

 
// Nếu người dùng submit form
if (!empty($_POST['edit_diem_student']))
{
    // Lay data
    




    $data['DiemThi1']        = isset($_POST['diemthi1']) ? $_POST['diemthi1'] : '';
    $data['DiemThi2']         = isset($_POST['diemthi2']) ? $_POST['diemthi2'] : '';
    $data['DiemQuaTrinh']    = isset($_POST['diemquatrinh']) ? $_POST['diemquatrinh'] : '';
    $data['DiemTongKet']    = isset($_POST['diemtongket']) ? $_POST['diemtongket'] : '';
    // Lay data 
    // Validate thong tin
    $mkh     =$data['MaKhoaHoc'];
    $masv    =$data['MaSv'];
    $errors = array();

     
    // Neu ko co loi thi insert
    if (!$errors){
        edit_bangdiem($_POST['id1'], $_POST['id2'], $data['DiemThi1'], $data['DiemThi2'], $data['DiemQuaTrinh'], $data['DiemTongKet']);
        // Trở về trang danh sách
        header('location:course-diem-list.php?id='.$_POST['id1'].'');
    }
}

 
disconnect_db();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Sửa khóa học</title>
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
        <h1>Sửa điểm </h1>
            <form method="get" action="course-diem-list.php">
            </form>
            <form method="post" action="course-diem-edit.php" class="table-wrapper">
                <table class="verticle-table">
                    
                    <tr>
                        <th>1</th>
                        <td>
                            <input type="number" name="diemthi1" value="<?php echo $data['DiemThi1']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>qt</th>
                        <td>
                        <input type="number" name="diemquatrinh" value="<?php echo $data['DiemQuaTrinh']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>
                            <input type="number" name="diemthi2" value="<?php echo $data['DiemThi2']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>tk</th>
                        <td>
                            <input type="number" name="diemtongket" value="<?php echo $data['DiemTongKet']; ?>"/>
                
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="id1" value="<?php echo $data['MaKhoaHoc']; ?>"/>
                <input type="hidden" name="id2" value="<?php echo $data['MaSv']; ?>"/>
                <input type="submit" name="edit_diem_student" value="Lưu" class="save button"/>
            </form>
        </div>
        <script src="../scripts/dropdown.js"></script>
    </body>
</html>