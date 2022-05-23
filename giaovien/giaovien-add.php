<?php

require './libs/students.php';
require_once("connection.php");
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
  			//$name = $_POST["name"];
			//$sex = $_POST["sex"];
  			//$birthday = $_POST["birthday"];
			//$cmnd = $_POST["cmnd"];
  			//$chunhiem = $_POST["chunhiem"];
  			//$major = $_POST["major"];
			//$email = $_POST["email"];
    
	$MaGv = $data['MaGv'];

  			

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
    if (empty($data['MaCn'])){
    $errors['MaCn'] = 'Vui lòng điền thông tin';
	}
    if (empty($data['CMND'])){
	$errors['CMND'] = 'Vui lòng điền thông tin';

	}
    //if (empty($password)){
	//$errors['matkhau'] = 'Chưa nhập Mật Khẩu';
//
	//}
	$sql="select * from giaovien where MaGv='$MaGv'";
	$kt=mysqli_query($conn, $sql);	
	if (mysqli_num_rows($kt) > 0){
	$errors['MaGv1'] = 'trung du lieu';
		}
	if (!$errors){
        add_giaovien($data['MaGv'], $data['HoTen'], $data['GioiTinh'], $data['NgaySinh'], $data['CMND'], $data['ChuNhiem'], $data['MaCn'], $data['email']);
        //Trở về trang danh sách
	
   	 $sql ="INSERT INTO user(username) VALUES ('$MaGv')";
    	$query =mysqli_query($conn, $sql);

        header("location: giaovien-list.php");
	return $query;

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
    </head>
    <body>
        <h1>thêm giáo viên </h1>
        <a href="giaovien-list.php">Trở về</a> <br/> <br/>
        <form method="post" action="giaovien-add.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>ID Giáo Viên</td>
                    <td>
                        <input type="text" name="MaGv" value=""/>
                        <?php if (!empty($errors['MaGv'])) echo $errors['MaGv'];?>
                    </td>
                </tr>

                <tr>
                    <td>Tên</td>
                    <td>
                        <input type="text" name="name" value=""/>
                        <?php if (!empty($errors['HoTen'])) echo $errors['HoTen']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Giới Tính</td>
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
                    </td>
                </tr>
                <tr>
                    <td>Chủ nhiệm</td>
                    <td>
                        <input type="text" name="cn" value=""/>
                    </td>
                </tr>
                <tr>
                    <td>Chuyên ngành</td>
                    <td>
                        <input type="text" name="major" value=""/>
                        <?php if (!empty($errors['MaCn'])) echo $errors['MaCn'];?>
                    </td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>
                        <input type="text" name="email" value=""/>
                        <?php if (!empty($errors['email'])) echo $errors['email'];?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="add_giaovien" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
