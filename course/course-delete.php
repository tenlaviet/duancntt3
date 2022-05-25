<?php

require '../libs/students.php';
<<<<<<< HEAD
=======
require_once("../libs/connection.php");
>>>>>>> 9001369c661014b453e4639b5fd2818d183ea217

// Thực hiện xóa
$id = isset($_POST['id']) ? $_POST['id'] : '';
if ($id){
    delete_course($id);
}

// Trở về trang danh sách
header("location: course-list.php");