 <?php
    // Gọi tới biến toàn cục $conn
    global $conn;
    

    $mysqli = new mysqli("localhost","root","","duancntt");

    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }
    
    // Chống SQL Injection

    
    // Câu truy sửa
    $sql = "UPDATE `user` SET `username`='student_code',`password`='password',`CMND`='99999',`SDT`='99999',`email`='student_email',`permission`='3' WHERE id= '77';";
    $sql .= "UPDATE `sinhvien` SET `MaSv`='student_code',`HoTen`='student_name',`GioiTinh`='Nam',`NgaySinh`='2009-10-26',`MaLop`='TT32C1',`MaCn`='7480201' WHERE user_id = '77';";
    
    
    // Thực hiện câu truy vấn
$mysqli -> multi_query($sql);

$mysqli -> close();


 //UPDATE `user` SET `username`='$student_code',`password`='$student_password',`CMND`='99999',`SDT`='99999',`email`='$student_email',`permission`='3' WHERE id= '77';
//UPDATE `sinhvien` SET `MaSv`='$student_code',`HoTen`='$student_name',`GioiTinh`='Nam',`NgaySinh`='2009-10-26',`MaLop`='TT32A1',`MaCn`='7480207' WHERE user_id = '77';