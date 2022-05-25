<?php

require '../libs/students.php';
require_once("../libs/connection.php");
// Thực hiện xóa
$id = isset($_POST['id']) ? $_POST['id'] : '';
if ($id){
    delete_lop($id);
}

// Trở về trang danh sách
header("location: lop-list.php");