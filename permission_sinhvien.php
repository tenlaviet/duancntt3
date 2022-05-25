<?php
if (isset($_SESSION['user_id']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: login/dangnhap_sinhvien.php');
}else {
	if (isset($_SESSION['permission']) == true) {
		// Ngược lại nếu đã đăng nhập
		$permission = $_SESSION['permission'];
		// Kiểm tra quyền của người đó có phải là admin hay không
		if ($permission != '3') {

			echo "yêu cầu tài khoàn của sinh viên<br>";
			echo "<a href='login/dangnhap_sinhvien.php'> Click để về lại</a>";
			exit();
		}

	}
}
?>