<?php
 
require '../libs/students.php';
require_once("../libs/connection.php");
 
// Lấy thông tin hiển thị lên để người dùng sửa
echo $_GET['id1'];
echo $_GET['id2'];
$id1 = isset($_GET['id1']) ? $_GET['id1'] : '';
$id2 = isset($_GET['id2']) ? $_GET['id2'] : '';
if ($id1){
    if($id2)
    {
        $data = get_course_student($id1,$id2);
        echo $data['MaKhoaHoc'];
        echo $data['MaSv'];

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
    </head>
    <body>
        <h1>sua diem </h1>
        <form method="get" action="course-diem-list.php">
        <input onclick="window.location = 'course-diem-list.php?id=<?php echo"$id1"; ?>'" type="button" value="tro ve"/>
        </form>
        <form method="post" action="course-diem-edit.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                
                <tr>
                    <td>1</td>
                    <td>
                        <input type="number" name="diemthi1" value="<?php echo $data['DiemThi1']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>qt</td>
                    <td>
                    <input type="number" name="diemquatrinh" value="<?php echo $data['DiemQuaTrinh']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <input type="number" name="diemthi2" value="<?php echo $data['DiemThi2']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>tk</td>
                    <td>
                        <input type="number" name="diemtongket" value="<?php echo $data['DiemTongKet']; ?>"/>
            
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id1" value="<?php echo $data['MaKhoaHoc']; ?>"/>
                        <input type="hidden" name="id2" value="<?php echo $data['MaSv']; ?>"/>
                        <input type="submit" name="edit_diem_student" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>