<?php
include './connect.php';
//Hủy session theo tên
unset($_SESSION['user']);
//Xóa tất tần tật session
header('location: ../home.php');
?>
