<?php

require './libs/students.php';

// Thực hiện xóa
$id = isset($_POST['id']) ? $_POST['id'] : '';
if ($id){
    delete_course($id);
}

// Trở về trang danh sách
header("location: course-list.php");