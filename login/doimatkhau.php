	<html>
	<head>
		<title>Form đăng ký thành viên</title>
	</head>
	<body>
		<?php
		session_start();

		
		require '../libs/students.php';
		
		

	?>
	<?php
	$data = get_user($_SESSION['username']);
	
	if (!empty($_POST['luu']))
{
	$mkht= isset($_POST['mkht']) ? $_POST['mkht'] : '';
	$mkm= isset($_POST['mkm']) ? $_POST['mkm'] : '';
	$nl= isset($_POST['nl']) ? $_POST['nl'] : ''; 
    // Validate thong tin
    $errors = array();
    if ($mkht != $data['password']){
        $errors['khongtrung'] = 'khong giong mat khau hien tai';
    } 
 
    if (empty($mkm)){
        $errors['mkm'] = 'dien thieu thong tin';
    }
     

    if ($nl != $mkm){
    $errors['khongtrung2'] = 'ban nhap sai';
    } 

     
    // Neu ko co loi thi insert
    if (!$errors){
    	echo $data['username'];
    	echo $mkm;
        change_password($data['username'],$mkm);
        //change_password('12','1234');

        header("location: ../students/student-profile.php");
    }
}
	?>
	<form action="doimatkhau.php" method="post">
		<table>
			<tr>
				<td colspan="2">Form doi mat khau</td>
			</tr>
			<tr>
				<td>Mật khẩu hiện tại</td>
				<td>
					<input type="password" id="mkht" name="mkht" value="">
					<?php if (!empty($errors['mkht']))
					{ 
						echo $errors['mkht'];
					}?>
					<?php if (!empty($errors['khongtrung'])) echo $errors['khongtrung'];?>
				</td>

			</tr>	
			<tr>
				<td>Mật khẩu mới</td>
				<td><input type="password" id="mkm" name="mkm" value="">
				<?php if (!empty($errors['mkm'])) echo $errors['mkm'];?>
				</td>
			</tr>
			<tr>
				<td>Nhập lại mật khẩu mới</td>
				<td><input type="password" id="nl" name="nl" value="">
				<?php if (!empty($errors['khongtrung2']))
					{ 
						echo $errors['khongtrung2'];
					}?>
				</td>
			</tr>

			<tr>
				<td colspan="2" align="center"><input type="submit" name="luu" value="luu thay doi"></td>
			</tr>

		</table>

	</form>
	</body>
	</html>