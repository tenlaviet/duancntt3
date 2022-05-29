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
    $CMND = $data['CMND'];
    $email = $data['email'];
    $SDT = $data['SDT'];
     $user_id = $data['user_id'];

  			

    // Validate thong tin
 		// Kiểm tra thông tin trùng lặp
    $errors = array();
    if (empty($data['MaSv'])){
        $errors['MaSv'] = 'Vui lòng điền thông tin';
    }   
    if (empty($data['HoTen'])){
        $errors['HoTen'] = 'Vui lòng điền thông tin';
    }
     
    if (empty($data['GioiTinh'])){
    $errors['GioiTinh'] = 'Vui lòng điền thông tin';
    }
    if (empty($data['NgaySinh'])){
    $errors['NgaySinh'] = 'Vui lòng điền thông tin';
    }

    if (empty($data['MaCn'])){
    $errors['MaCn'] = 'Vui lòng điền thông tin';
    }
    if (empty($data['CMND'])){
    $errors['CMND'] = 'Vui lòng điền thông tin';

    }
    if (empty($data['SDT'])){
    $errors['SDT'] = 'Vui lòng điền thông tin';

    }

    if (empty($data['email'])){
    $errors['email'] = 'Vui lòng điền thông tin';
    }
    

    if (empty($data['password'])){
    $errors['password'] = 'Chưa nhập Mật Khẩu';

    }
    if (empty($data['user_id'])){
    $errors['user_id'] = 'Vui lòng điền thông tin';

    }
    // kiem tra trung ma sinh vien
    $sql="select * from sinhvien where MaSv='$masv'";
    $kt=mysqli_query($conn, $sql);  
    if (mysqli_num_rows($kt) > 0){
    $errors['MaSv1'] = 'Trùng dữ liệu';
    mysqli_free_result($kt);
        }
    $sql="select * from user where SDT='$SDT' and SDT !=''";
    $kt=mysqli_query($conn, $sql);  
    if (mysqli_num_rows($kt) > 0){
    $errors['SDT1'] = 'Trùng dữ liệu';
    mysqli_free_result($kt);
        }
    $sql="select * from user where email='$email' and email !=''";
    $kt=mysqli_query($conn, $sql);  
    if (mysqli_num_rows($kt) > 0){
    $errors['email1'] = 'Trùng dữ liệu';
    mysqli_free_result($kt);
        }
    $sql="select * from user where CMND='$CMND' and CMND !=''";
    $kt=mysqli_query($conn, $sql);  
    if (mysqli_num_rows($kt) > 0){
    $errors['CMND1'] = 'Trùng dữ liệu';
    mysqli_free_result($kt);
        }
    $sql="select * from user where id='$user_id' and id !=''";
    $kt=mysqli_query($conn, $sql);  
    if (mysqli_num_rows($kt) > 0){
    $errors['user_id1'] = 'Trùng dữ liệu';
    mysqli_free_result($kt);
        }
	if (!$errors){
        add_student($user_id, $data['MaSv'], $data['password'], $data['HoTen'], $data['GioiTinh'], $data['NgaySinh'], $data['email'], $data['CMND'], $data['SDT'], 
            $data['MaLop'], $data['MaCn'] , '3');
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
                    <td>User ID</td>
                    <td>
                        <input type="text" name="userid" value=""/>

                        <?php if (!empty($errors['user_id']))
                        { echo $errors['user_id'];}
                        if (!empty($errors['user_id1']))
                        {
                            echo $errors['user_id1'];
                        }
                        ?>
                    </td>
                </tr>                
                <tr>
                    <td>Mã sinh viên</td>
                    <td>
                        <input type="text" name="masv" value=""/>

                        <?php if (!empty($errors['MaSv']))
                        { echo $errors['MaSv'];}
                        if (!empty($errors['MaSv1']))
                        {
                            echo $errors['MaSv1'];
                        }
                        ?>
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
                    <td>CMND</td>
                    <td>
                        <input type="text" name="cmnd" value=""/>
                                                 <?php if (!empty($errors['CMND']))
                        { echo $errors['CMND'];}
                        if (!empty($errors['CMND1']))
                        {
                            echo $errors['CMND1'];
                        }?>
                    </td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>
                        <input type="text" name="email" value=""/>
                                                <?php if (!empty($errors['email']))
                        { echo $errors['email'];}
                        if (!empty($errors['email1']))
                        {
                            echo $errors['email1'];
                        }?>
                    </td>
                </tr>
                <tr>
                    <td>SDT</td>
                    <td>
                        <input type="number" name="sdt" value=""/>
                                                <?php if (!empty($errors['SDT']))
                        { echo $errors['SDT'];}
                        if (!empty($errors['SDT1']))
                        {
                            echo $errors['SDT1'];
                        }?>

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
