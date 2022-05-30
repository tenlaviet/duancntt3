<?php
session_start();
require '../libs/students.php';
require_once("../libs/connection.php");
// Nếu người dùng submit form
if (!empty($_POST['add_giaovien']))
{
    // Lay data
    $data['MaGv']= isset($_POST['MaGv']) ? $_POST['MaGv'] : '';
    $data['HoTen']= isset($_POST['name']) ? $_POST['name'] : '';
    $data['GioiTinh']         = isset($_POST['sex']) ? $_POST['sex'] : '';
    $data['NgaySinh']    = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $data['CMND']        = isset($_POST['cmnd']) ? $_POST['cmnd'] : '';
    $data['ChuNhiem']	 = isset($_POST['cn']) ? $_POST['cn'] : '';
    $data['MaCn']    = isset($_POST['major']) ? $_POST['major'] : '';
    $data['email']    = isset($_POST['email']) ? $_POST['email'] : '';
    $data['SDT']         = isset($_POST['sdt']) ? $_POST['sdt'] : '';
    $data['user_id']    = isset($_POST['userid']) ? $_POST['userid'] : '';
    $data['password']    = isset($_POST['password']) ? $_POST['password'] : '';  
    $data['permission']    = isset($_POST['permission']) ? $_POST['permission'] : ''; 		
    
	$MaGv = $data['MaGv'];
    $CMND = $data['CMND'];
    $email = $data['email'];
    $SDT = $data['SDT'];
     $user_id = $data['user_id'];

  			

    // Validate thong tin
 		// Kiểm tra thông tin trùng lặp
    $errors = array();
    if (empty($data['MaGv'])){
        $errors['MaGv'] = 'Vui lòng điền thông tin';
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
     
    $sql="select * from user where id='$user_id'";
    $kt=mysqli_query($conn, $sql);  
    if (mysqli_num_rows($kt) > 0){
    $errors['user_id1'] = 'Trùng dữ liệu';
    mysqli_free_result($kt);
        }
	$sql="select * from giaovien where MaGv='$MaGv'";
	$kt=mysqli_query($conn, $sql);	
	if (mysqli_num_rows($kt) > 0){
	$errors['MaGv1'] = 'Trùng dữ liệu';
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
        add_giaovien($data['user_id'], $data['MaGv'], $data['password'], $data['HoTen'], $data['GioiTinh'], $data['NgaySinh'], $data['email'], $data['CMND'], $data['SDT'], $data['ChuNhiem'], $data['MaCn'] , '2');
        //Trở về trang danh sách
	
   	

        header("location: giaovien-list.php");
	

	}

}


disconnect_db();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>thêm giáo viên</title>
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
            <h1>Thêm Giáo Viên </h1>
            <form method="post" action="giaovien-add.php" class="table-wrapper">
                <table class="verticle-table">
                    <tr>
                        <th>User ID</th>
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
                        <th>Mã giáo viên</th>
                        <td>
                            <input type="text" name="MaGv" value=""/>

                            <?php if (!empty($errors['MaGv']))
                            { echo $errors['MaGv'];}
                            if (!empty($errors['MaGv1']))
                            {
                                echo $errors['MaGv1'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>password</th>
                        <td>
                            <input type="text" name="password" value=""/>
                            <?php if (!empty($errors['password'])) echo $errors['password'];?>
                        </td>
                    </tr> 
                    <tr>
                        <th>Họ và Tên</th>
                        <td>
                            <input type="text" name="name" value=""/>
                            <?php if (!empty($errors['HoTen'])) echo $errors['HoTen']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Giới Tính</th>
                        <td>
                            <select name="sex">
                                <option value="Nam">Nam</option>
                                <option value="Nữ"<?php if (!empty($data['GioiTinh']) && $data['GioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                            </select>
                            
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày sinh</th>
                        <td>
                            <input type="date" name="birthday" value=""/>
                            <?php if (!empty($errors['NgaySinh'])) echo $errors['NgaySinh']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Chủ nhiệm</th>
                        <td>
                            <input type="text" name="cn" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <th>Chuyên ngành</th>
                        <td>
                            <input type="text" name="major" value=""/>
                            
                        </td>
                    </tr>
                    <tr>
                        <th>CMND</th>
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
                        <th>email</th>
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
                        <th>SDT</th>
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
                </table>
                <input type="submit" name="add_giaovien" value="Lưu" class="save button"/>
            </form>
        </div>
        <script src="../scripts/dropdown.js"></script>
    </body>
</html>
