    <html>
    <head>
        <title>đăng ký thành viên</title>
    </head>
    <body>
<?php
require_once("connection.php");
    if (isset($_POST["btn_submit"])) {
        //lấy thông tin từ các form bằng phương thức POST
        $username = $_POST["username"];
        $password = $_POST["pass"];
        $permission = $_POST["permission"];
        //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
        if ($username == "" || $password == "" || $permission == "") {
            echo "bạn vui lòng nhập đầy đủ thông tin";
        }else{
            $sql = "INSERT INTO `user`(`password`, `permission`, `username`) VALUES ('$password','$permission','$username')";
            // thực thi câu $sql với biến conn lấy từ file connection.php
            mysqli_query($conn,$sql);
            echo "chúc mừng bạn đã đăng ký thành công";
        }
    }

?>

<form action="dangky.php" method="post">
        <table>
            <tr>
                <td colspan="2">Form dang ky</td>
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
                <td>Permission :</td>
                <td><input type="text" id="name" name="permission"></td>
            </tr>

            <tr>
                <td colspan="2" align="center"><input type="submit" name="btn_submit" value="Dang ky"></td>
            </tr>

        </table>

    </form>
    </body>
    </html>