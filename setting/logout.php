<?php
include './connect.php';

//Lấy tên người dùng đang đăng xuất
$user_name = $_SESSION['user']['user_name'];

//Thay đổi trạng thái của người dùng thành offline
$sqlUpdateOnlineUsers = "UPDATE users SET is_online = 0 WHERE user_name = '$user_name'";
$conn->query($sqlUpdateOnlineUsers);

//Hủy session theo tên
unset($_SESSION['user']);
//Xóa tất tần tật session

header('location: ../home.php');
?>
