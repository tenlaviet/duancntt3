<?php

require '../libs/students.php';
require_once("../libs/connection.php");

// Thực hiện xóa
$id = isset($_POST['id']) ? $_POST['id'] : '';
if ($id){
    delete_student($id);
}

// Trở về trang danh sách
header("location: student-list.php");