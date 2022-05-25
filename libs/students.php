<?php
// Biến kết nối toàn cục
global $conn;

// Hàm kết nối database
function executeResult($sql) {
    //create connection toi database
    $conn = mysqli_connect('localhost', 'root', '', 'duancntt');

    //query
    $resultset = mysqli_query($conn, $sql);
    $list      = [];
    while ($row = mysqli_fetch_array($resultset, 1)) {
        $list[] = $row;
    }

    //dong connection
    mysqli_close($conn);

    return $list;
}
function connect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Nếu chưa kết nối thì thực hiện kết nối
    if (!$conn){
        $conn = mysqli_connect('localhost', 'root', '', 'duancntt') or die ('Can\'t not connect to database');
        // Thiết lập font chữ kết nối
        mysqli_set_charset($conn, 'utf8');
    }
}

// Hàm ngắt kết nối
function disconnect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Nếu đã kêt nối thì thực hiện ngắt kết nối
    if ($conn){
        mysqli_close($conn);
    }
}
////////////////STUDENT
// Hàm lấy tất cả sinh viên
function get_all_students()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from sinhvien";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    
    // Trả kết quả về
    return $result;
}

// Hàm lấy sinh viên theo ID
function get_student($student_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from sinhvien s inner join `user` u on s.user_id = u.id where s.user_id = '$student_id'";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    
    // Trả kết quả về
    return $result;
}

// Hàm thêm sinh viên
function add_student($student_id, $student_code, $student_password, $student_name, $student_sex, $student_birthday, $student_email, $student_CMND, $student_SDT, $student_class, $student_major , $student_permission)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
$mysqli = new mysqli("localhost","root","","duancntt");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$sql = "INSERT INTO user(id, username, password, permission, CMND, SDT, email) VALUES ('$student_id','$student_code','$student_password','$student_permission','$student_CMND','$student_SDT','$student_email');";
$sql1 = "INSERT INTO sinhvien(MaSv, HoTen, GioiTinh, NgaySinh,MaLop, MaCn, user_id) VALUES ('$student_code','$student_name','$student_sex', '$student_birthday', '$student_class','$student_major','$student_id');";

// Execute multi query
$mysqli -> query($sql);
$mysqli -> query($sql1);

$mysqli -> close();
}


// Hàm sửa sinh viên
function edit_student($student_id, $student_code, $student_password, $student_name, $student_sex, $student_birthday, $student_email, $student_CMND, $student_SDT, $student_class, $student_major , $student_permission)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    

    $mysqli = new mysqli("localhost","root","","duancntt");

    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }
    
    // Chống SQL Injection
    $student_name       = addslashes($student_name);
    $student_sex        = addslashes($student_sex);
    $student_birthday   = addslashes($student_birthday);
    $student_major   = addslashes($student_major);
    $student_email   = addslashes($student_email);
    $student_class   = addslashes($student_class);
    $student_CMND   = addslashes($student_CMND);
    $student_id       = addslashes($student_id);
    $student_code   = addslashes($student_code);
    $student_SDT   = addslashes($student_SDT);
    $student_permission   = addslashes($student_permission);
    $student_password = addslashes($student_password);
   
    
    // Câu truy sửa
    $sql = "UPDATE `sinhvien` SET `MaSv`='$student_code',`HoTen`='$student_name',`GioiTinh`='$student_sex',`NgaySinh`='$student_birthday',`MaLop`='$student_class',`MaCn`='$student_major' WHERE user_id = '$student_id';";
    $sql1 = "UPDATE `user` SET `username`='$student_code',`password`='$student_password',`CMND`='$student_CMND',`SDT`='$student_SDT',`email`='$student_email',`permission`='$student_permission' WHERE id= '$student_id';";
   
    
    
    // Thực hiện câu truy vấn
$mysqli -> query($sql);
$mysqli -> query($sql1);

$mysqli -> close();
}


// Hàm xóa sinh viên
function delete_student($student_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy sửa
    $sql = "
    DELETE FROM `user` WHERE   id = '$student_id';

    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}

////////////////////////MonHoc

function get_all_monhoc()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from monhoc";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    
    // Trả kết quả về
    return $result;
}
function add_monhoc($monhoc_code, $monhoc_name)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Chống SQL Injection

    $monhoc_code = addslashes($monhoc_code);
    $monhoc_name = addslashes($monhoc_name);


    // Câu truy vấn thêm
    $sql ="
            INSERT INTO monhoc(MaMon, TenMon) VALUES ('$monhoc_code', '$monhoc_name');";
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    

    return $query;
}


function get_monhoc($monhoc_code)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from monhoc where MaMon = '$monhoc_code'";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    
    // Trả kết quả về
    return $result;
}
function delete_monhoc($monhoc_code)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy sửa
    $sql = "
    DELETE FROM `monhoc` WHERE MaMon = '$monhoc_code';

    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}

function edit_monhoc($monhoc_code, $monhoc_name)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Chống SQL Injection
    $monhoc_name       = addslashes($monhoc_name);
    $monhoc_code = addslashes($monhoc_code);
    
    
    // Câu truy sửa
    
    $sql = " 
    UPDATE `monhoc` SET `TenMon`='$monhoc_name' WHERE MaMon = '$monhoc_code'
    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}

////////////////////////////Major


function get_all_major()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from major";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    
    // Trả kết quả về
    return $result;
}
function add_major($major_code, $major_name)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Chống SQL Injection

    $major_code = addslashes($major_code);
    $major_name = addslashes($major_name);


    // Câu truy vấn thêm
    $sql ="
            INSERT INTO major(MaCn, TenCn) VALUES ('$major_code', '$major_name');";
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    

    return $query;
}


function get_major($major_code)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from major where MaCn = '$major_code'";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    
    // Trả kết quả về
    return $result;
}
function delete_major($major_code)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy sửa
    $sql = "
    DELETE FROM `major` WHERE MaCn = '$major_code';

    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}

function edit_major($major_code, $major_name)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Chống SQL Injection
    $major_name       = addslashes($major_name);
    $major_code = addslashes($major_code);
    
    
    // Câu truy sửa
    
    $sql = " 
    UPDATE `major` SET `TenCn`='$major_name' WHERE MaCn = '$major_code'
    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}

///////////////////Lop
function get_all_lop()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from lop";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    
    // Trả kết quả về
    return $result;
}
function add_lop($lop_code, $lop_cn, $lop_name)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Chống SQL Injection

    $lop_code = addslashes($lop_code);
    $lop_cn = addslashes($lop_cn);
    $lop_name = addslashes($lop_name);
    

    // Câu truy vấn thêm
    $sql ="
            INSERT INTO `lop`(`MaLop`, `MaCn`, `KhoaDaoTao`) VALUES ('$lop_code','$lop_cn','$lop_name');";
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    

    return $query;
}


function get_lop($lop_code)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from lop where MaLop = '$lop_code'";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    
    // Trả kết quả về
    return $result;
}
function delete_lop($lop_code)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy sửa
    $sql = "
    DELETE FROM `lop` WHERE MaLop = '$lop_code';

    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}
function edit_lop($lop_code, $lop_cn, $lop_name)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Chống SQL Injection
    $lop_name       = addslashes($lop_name);
    $lop_code = addslashes($lop_code);
    $lop_cn = addslashes($lop_cn);
    
    
    // Câu truy sửa
    
    $sql = " 
    UPDATE `lop` SET `MaCn`='$lop_cn',`KhoaDaoTao`='$lop_name' WHERE `MaLop` ='$lop_code'
    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}

////////////////////////GiaoVien
function get_all_giaovien()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from giaovien";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    
    // Trả kết quả về
    return $result;
}

// Hàm lấy sinh viên theo ID
/*function get_giaovien($giaovien_code)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from giaovien where MaGv = '$giaovien_code'";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    
    // Trả kết quả về
    return $result;
}*/
function get_giaovien($giaovien_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from giaovien g inner join `user` u on g.user_id = u.id where g.user_id = '$giaovien_id'";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    
    // Trả kết quả về
    return $result;
}
// Hàm thêm sinh viên
/*function add_giaovien($giaovien_code, $giaovien_name, $giaovien_sex, $giaovien_birthday, $giaovien_CMND, $giaovien_class, $giaovien_major, $giaovien_email)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Chống SQL Injection

    $giaovien_code = addslashes($giaovien_code);
    $giaovien_name = addslashes($giaovien_name);
    $giaovien_sex = addslashes($giaovien_sex);
    $giaovien_birthday = addslashes($giaovien_birthday);
    $giaovien_CMND = addslashes($giaovien_CMND);
    $giaovien_major = addslashes($giaovien_major);
    $giaovien_email = addslashes($giaovien_email);
    $giaovien_class = addslashes($giaovien_class);

    // Câu truy vấn thêm
    $sql ="
            INSERT INTO giaovien(MaGv, HoTen, GioiTinh, NgaySinh, CMND, ChuNhiem, MaCn, email) VALUES ('$giaovien_code', '$giaovien_name', '$giaovien_sex', '$giaovien_birthday', '$giaovien_CMND','$giaovien_class', '$giaovien_major', '$giaovien_email');";
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    


    return $query;
}
*/
function add_giaovien($giaovien_id, $giaovien_code, $giaovien_password, $giaovien_name, $giaovien_sex, $giaovien_birthday, $giaovien_email, $giaovien_CMND, $giaovien_SDT, $giaovien_class, $giaovien_major , $giaovien_permission)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
$mysqli = new mysqli("localhost","root","","duancntt");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$sql = "INSERT INTO user(id, username, password, permission, CMND, SDT, email) VALUES ('$giaovien_id','$giaovien_code','$giaovien_password','$giaovien_permission','$giaovien_CMND','$giaovien_SDT','$giaovien_email');";
$sql1 = "INSERT INTO giaovien(`MaGv`, `HoTen`, `GioiTinh`, `NgaySinh`, `MaCn`, `ChuNhiem`, `user_id`) VALUES ('$giaovien_code','$giaovien_name','$giaovien_sex', '$giaovien_birthday', '$giaovien_major','$giaovien_class','$giaovien_id');";

// Execute multi query
$mysqli -> query($sql);
$mysqli -> query($sql1);

$mysqli -> close();
}

// Hàm sửa giao vien
function edit_giaovien($giaovien_id, $giaovien_code, $giaovien_password, $giaovien_name, $giaovien_sex, $giaovien_birthday, $giaovien_email, $giaovien_CMND, $giaovien_SDT, $giaovien_class, $giaovien_major , $giaovien_permission)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    

    $mysqli = new mysqli("localhost","root","","duancntt");

    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }
    
    // Chống SQL Injection
    $giaovien_name       = addslashes($giaovien_name);
    $giaovien_sex        = addslashes($giaovien_sex);
    $giaovien_birthday   = addslashes($giaovien_birthday);
    $giaovien_major   = addslashes($giaovien_major);
    $giaovien_email   = addslashes($giaovien_email);
    $giaovien_class   = addslashes($giaovien_class);
    $giaovien_CMND   = addslashes($giaovien_CMND);
    $giaovien_id       = addslashes($giaovien_id);
    $giaovien_code   = addslashes($giaovien_code);
    $giaovien_SDT   = addslashes($giaovien_SDT);
    $giaovien_permission   = addslashes($giaovien_permission);
    $giaovien_password = addslashes($giaovien_password);
   
    
    // Câu truy sửa
    $sql = "UPDATE `giaovien` SET `MaGv`='$giaovien_code',`HoTen`='$giaovien_name',`GioiTinh`='$giaovien_sex',`NgaySinh`='$giaovien_birthday',`ChuNhiem`='$giaovien_class',`MaCn`='$giaovien_major' WHERE user_id = '$giaovien_id';";
    $sql1 = "UPDATE `user` SET `username`='$giaovien_code',`password`='$giaovien_password',`CMND`='$giaovien_CMND',`SDT`='$giaovien_SDT',`email`='$giaovien_email',`permission`='$giaovien_permission' WHERE id= '$giaovien_id';";
   
    
    
    // Thực hiện câu truy vấn
$mysqli -> query($sql);
$mysqli -> query($sql1);

$mysqli -> close();
}


// Hàm xóa sinh viên

function delete_giaovien($giaovien_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy sửa
    $sql = "
    DELETE FROM `user` WHERE   id = '$giaovien_id';

    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}

//////////////////////////COURSE
function get_all_course()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from course";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    
    // Trả kết quả về
    return $result;
}

// Hàm lấy sinh viên theo ID
function get_course($course_code)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from course where id = '$course_code'";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    
    // Trả kết quả về
    return $result;
}

// Hàm thêm sinh viên
function add_course($course_mamon, $course_hocki, $course_PhongHoc, $course_MaGv, $course_Thu, $course_Ca, $course_NgayThi)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Chống SQL Injection


    $course_mamon = addslashes($course_mamon);
    $course_hocki = addslashes($course_hocki);
    $course_PhongHoc = addslashes($course_PhongHoc);
    $course_MaGv = addslashes($course_MaGv);
    $course_Thu = addslashes($course_Thu);
    $course_Ca = addslashes($course_Ca);
    $course_NgayThi = addslashes($course_NgayThi);

    // Câu truy vấn thêm
    $sql ="
            INSERT INTO `course`(`MaMon`, `HocKi`, `PhongHoc`, `MaGv`, `Thu`, `Ca`, `NgayThi`) VALUES ('$course_mamon', '$course_hocki', '$course_PhongHoc', '$course_MaGv', '$course_Thu', '$course_Ca', '$course_NgayThi');";
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    

    return $query;
}


// Hàm sửa sinh viên
function edit_course($course_code, $course_mamon, $course_hocki, $course_PhongHoc, $course_MaGv, $course_Thu, $course_Ca, $course_NgayThi)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Chống SQL Injection
    $course_mamon = addslashes($course_mamon);
    $course_hocki = addslashes($course_hocki);
    $course_PhongHoc = addslashes($course_PhongHoc);
    $course_MaGv = addslashes($course_MaGv);
    $course_Thu = addslashes($course_Thu);
    $course_Ca = addslashes($course_Ca);
    $course_NgayThi = addslashes($course_NgayThi);

    // Câu truy sửa
    
    $sql = " 
    UPDATE `course` SET `MaMon`='$course_mamon',`HocKi`='$course_hocki',`PhongHoc`='$course_PhongHoc',`MaGv`='$course_MaGv',`Thu`='$course_Thu',`Ca`='$course_Ca',`NgayThi`='$course_NgayThi' WHERE id ='$course_code'
    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}


// Hàm xóa sinh viên
function delete_course($course_code)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy sửa
    $sql = "
    DELETE FROM `course` WHERE id = '$course_code';

    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}

function get_danhsachsinhvien($khoahoc_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from bangdiem where MaKhoaHoc = '$khoahoc_id'";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    
    // Trả kết quả về
    return $result;
}