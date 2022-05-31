<?php
if (isset($_SESSION['user_id']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: login/dangnhap.php');
}else {
	if (isset($_SESSION["permission"]) == true) {
		// Ngược lại nếu đã đăng nhập
		$permission = $_SESSION["permission"];
		// Kiểm tra quyền của người đó có phải là admin hay không


		if($permission == '3')
		{
			echo "Bạn không đủ quyền truy cập vào trang này<br>";
			echo "<a href='http://localhost/duancntt3/login/dangnhap.php'> Click để về lại trang chủ</a>";
			exit();
		}
	}
}
?>