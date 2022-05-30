	<html>
	<head>
		<title>Form đăng ký thành viên</title>
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
        $errors['khongtrung'] = 'không giống mật khẩu hiện tại';
    } 
 
    if (empty($mkm)){
        $errors['mkm'] = 'điền thiếu thông tin';
    }
     

    if ($nl != $mkm){
    $errors['khongtrung2'] = 'bạn nhập sai';
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
		<?php include 'C:\xampp\htdocs\duancntt3\component\sidebar.php';?>
		<div class="wrapper">
			<form action="doimatkhau.php" method="post" class="table-wrapper">
				<h1>Đổi Mật Khẩu</h1>
				<table class="verticle-table">
					<tr>
						<th>Mật khẩu hiện tại</th>
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
					<th>Mật khẩu mới</th>
					<td><input type="password" id="mkm" name="mkm" value="">
					<?php if (!empty($errors['mkm'])) echo $errors['mkm'];?>
					</td>
				</tr>
				<tr>
					<th>Nhập lại mật khẩu mới</th>
					<td><input type="password" id="nl" name="nl" value="">
					<?php if (!empty($errors['khongtrung2']))
						{ 
							echo $errors['khongtrung2'];
						}?>
					</td>
				</tr>		
				</table>
				<input type="submit" name="luu" value="Lưu" class="save button"></td>
			</form>
		</div>
		<script src="../scripts/dropdown.js"></script>
	</body>
</html>