<?php

require '../libs/students.php';
require_once("../libs/connection.php");

// Thực hiện xóa
$id = isset($_POST['id']) ? $_POST['id'] : '';
if ($id){
    delete_major($id);
}

// Trở về trang danh sách
header("location: major-list.php");