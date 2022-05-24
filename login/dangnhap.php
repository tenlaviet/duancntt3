<?php
session_start();
?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="icon" type="image/png" href="../img/Logo-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../img/Logo-16x16.png" sizes="16x16" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet" />
    <link href="../styles/login.css" rel="stylesheet" type="text/css" />
    <title>Trang đăng nhập</title>
</head>

<body>
    <?php
	//Gọi file connection.php ở bài trước
	require_once("../libs/connection.php");
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST["btn_submit"])) {
		// lấy thông tin người dùng
		$username = $_POST["username"];
		$password = $_POST["password"];
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password =="") {
			echo "username hoặc password bạn không được để trống!";
		}else{
			$sql = "select * from user where username = '$username' and password = '$password' ";
			$query = mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($query);
			if ($num_rows==0) {
				echo "tên đăng nhập hoặc mật khẩu không đúng !";
			}else{
				// Lấy ra thông tin người dùng và lưu vào session
				while ( $data = mysqli_fetch_array($query) ) {
	    		$_SESSION["user_id"] = $data["id"];
				$_SESSION['username'] = $data["username"];
				$_SESSION["permission"] = $data["permission"];
                // Thực thi hành động sau khi lưu thông tin vào session
                }
                header('Location: ../trangchu.php');
			}
		}
	}
?>
    <div class="login">
        <div class="login-wrapper">
            <form method="POST" action="dangnhap.php">
                <img src="../img/logo.png" alt="" class="logo">
                <fieldset>
                    <legend>Đăng Nhập</legend>
                    <table class="login-field">
                        <tr>
                            <td><input type="text" placeholder="Username" name="username" class="username input"
                                    size="30"></td>
                        </tr>
                        <tr>
                            <td><input type="password" placeholder="Password" name="password" class="password input"
                                    size="30"></td>
                        </tr>
                        <tr>
                            <th> <input name="btn_submit" class="btn_login" type="submit" value="Đăng nhập"></th>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>