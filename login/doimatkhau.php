	<html>
	<head>
		<title>Form đăng ký thành viên</title>
	</head>
	<body>
		<?php
		require_once("connection.php");
		if (isset($_POST["btn_submit"])) {
  			//lấy thông tin từ các form bằng phương thức POST
  			$username = $_POST["username"];
  			$password = $_POST["pass"];
  			$id = $_POST["id"];

  			//Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
			  if ($username == "" || $password == "" || $id == "") {
				   echo "bạn vui lòng nhập đầy đủ thông tin";
  			}else{
  					// Kiểm tra tài khoản đã tồn tại chưa
  					$sql="select * from user where username='$username'";
					$kt=mysqli_query($conn, $sql);

					if(mysqli_num_rows($kt)  > 0){
						echo "Tài khoản đã tồn tại";
					}else{
						//thực hiện việc lưu trữ dữ liệu vào db
	    				$sql = "INSERT INTO user(id, username, password) VALUES ('$id', '$username', '$password')";
					$query1 = mysqli_query($conn,$sql);
					$sql= "INSERT INTO sinhvien(user_id, MaSv) VALUES ('$id', '$username')";
					    // thực thi câu $sql với biến conn lấy từ file connection.php
   						$query2 = mysqli_query($conn,$sql);
				   		echo "chúc mừng bạn đã đăng ký thành công";
					}
									    
					
			  }
	}
	?>
	<form action="formdangky.php" method="post">
		<table>
			<tr>
				<td colspan="2">Form dang ky</td>
			</tr>
			<tr>
				<td>ID :</td>
				<td><input type="number" id="aidi" name="id"></td>
			</tr>	
			<tr>
				<td>Username :</td>
				<td><input type="text" id="username" name="username"></td>
			</tr>
			<tr>
				<td>Password :</td>
				<td><input type="password" id="pass" name="pass"></td>
			</tr>

			<tr>
				<td colspan="2" align="center"><input type="submit" name="btn_submit" value="Dang ky"></td>
			</tr>

		</table>

	</form>
	</body>
	</html>