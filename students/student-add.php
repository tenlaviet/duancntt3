<?php

require '../libs/students.php';
require_once("../libs/connection.php");
// Nếu người dùng submit form
if (!empty($_POST['add_student']))
{
    // Lay data
    $data['MaSv']= isset($_POST['masv']) ? $_POST['masv'] : '';
    $data['HoTen']= isset($_POST['name']) ? $_POST['name'] : '';
    $data['GioiTinh']         = isset($_POST['sex']) ? $_POST['sex'] : '';
    $data['NgaySinh']    = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $data['CMND']        = isset($_POST['cmnd']) ? $_POST['cmnd'] : '';
    $data['MaLop']         = isset($_POST['groupid']) ? $_POST['groupid'] : '';
    $data['MaCn']    = isset($_POST['major']) ? $_POST['major'] : '';
    $data['email']    = isset($_POST['email']) ? $_POST['email'] : '';
    $data['SDT']         = isset($_POST['sdt']) ? $_POST['sdt'] : '';
    $data['user_id']    = isset($_POST['userid']) ? $_POST['userid'] : '';
    $data['password']    = isset($_POST['password']) ? $_POST['password'] : '';  
    $data['permission']    = isset($_POST['permission']) ? $_POST['permission'] : ''; 		

    
	$masv = $data['MaSv'];
    $email = $data['email'];
    $CMND = $data['CMND'];

  			

    // Validate thong tin
 		// Kiểm tra thông tin trùng lặp
    $errors = array();
    if (empty($data['MaSv'])){
        $errors['MaSv'] = 'Chưa nhập Mã sinh viên';
    }	
    if (empty($data['HoTen'])){
        $errors['HoTen'] = 'Chưa nhập tên sinh viên';
    }
     
    if (empty($data['GioiTinh'])){
	$errors['GioiTinh'] = 'Chưa nhập giới tính';

	}
    if (empty($data['CMND'])){
	$errors['CMND'] = 'Chưa nhập CMND';

	}
    if (empty($data['email'])){
    $errors['email'] = 'Chưa nhập email';

    }
    // kiem tra trung ma sinh vien
	$sql="select * from sinhvien where MaSv='$masv'";
	$kt=mysqli_query($conn, $sql);	
	if (mysqli_num_rows($kt) > 0){
	$errors['MaSv1'] = 'trung du lieu';
	}
    // kiem tra trung email
    $sql2="select * from giaovien where email ='$email';";
    $kt2=mysqli_query($conn, $sql2);
    $sql3="select * from sinhvien where email ='$email';";
    $kt3=mysqli_query($conn, $sql3);
    if (mysqli_num_rows($kt2) > 0 or mysqli_num_rows($kt3) > 0){
    $errors['MaSv2'] = 'trung du lieu';
    }
    // kiem tra trung CMND
    $sql4="select * from giaovien where CMND ='$CMND';";
    $kt4=mysqli_query($conn, $sql4);
    $sql5="select * from sinhvien where CMND ='$CMND';";
    $kt5=mysqli_query($conn, $sql5);
    if (mysqli_num_rows($kt4) > 0 or mysqli_num_rows($kt5) > 0){
    $errors['MaSv3'] = 'trung du lieu';
    }
	if (!$errors){
        add_student($data['user_id'], $data['MaSv'], $data['password'], $data['HoTen'], $data['GioiTinh'], $data['NgaySinh'], $data['email'], $data['CMND'], $data['SDT'], 
            $data['MaLop'], $data['MaCn'] , $data['permission']);
        //Trở về trang danh sách
	


        header("location: student-list.php");


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
        <h1>Thêm sinh vien </h1>
        <a href="student-list.php">Trở về</a> <br/> <br/>
        <form method="post" action="student-add.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                 <tr>
                    <td>user id</td>
                    <td>
                        <input type="text" name="userid" value=""/>
                    </td>
                </tr>               
                <tr>
                    <td>Mã sinh viên</td>
                    <td>
                        <input type="text" name="masv" value=""/>
                        <?php if (!empty($errors['MaSv'])) echo $errors['MaSv'];?>
			             <?php if (!empty($errors['MaSv1'])) echo $errors['MaSv1'];?>
                    </td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>
                        <input type="text" name="password" value=""/>
                    </td>
                </tr>                

                <tr>
                    <td>Họ tên</td>
                    <td>
                        <input type="text" name="name" value=""/>
                        <?php if (!empty($errors['HoTen'])) echo $errors['HoTen']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Giới tính</td>
                    <td>
                        <select name="sex">
                            <option value="Nam">Nam</option>
                            <option value="Nữ"<?php if (!empty($data['GioiTinh']) && $data['GioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Ngày sinh</td>
                    <td>
                        <input type="date" name="birthday" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>CMND</td>
                    <td>
                        <input type="text" name="cmnd" value=""/>
			             <?php if (!empty($errors['CMND'])) echo $errors['CMND']; ?>
                         <?php if (!empty($errors['MaSv3'])) echo $errors['MaSv3']; ?>

                    </td>
                </tr>
                <tr>
                    <td>Lớp</td>
                    <td>
                        <input type="text" name="groupid" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>Chuyên ngành</td>
                    <td>
                        <input type="text" name="major" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>
                        <input type="text" name="email" value=""/>
                        <?php if (!empty($errors['email'])) echo $errors['email']; ?>
                         <?php if (!empty($errors['MaSv2'])) echo $errors['MaSv2']; ?>
                    </td>
                </tr>
                <tr>
                    <td>SDT</td>
                    <td>
                        <input type="number" name="sdt" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>permission</td>
                    <td>
                        <input type="number" name="permission" value=""/>
                    </td>
                </tr>                                
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="add_student" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
