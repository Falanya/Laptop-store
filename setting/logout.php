<?php
include './connect.php';

//Lấy tên người dùng đang đăng xuất
$user_name = $_SESSION['user']['user_name'];

//Thay đổi trạng thái của người dùng thành offline
$sqlUpdateOnlineUsers = "UPDATE users SET is_online = 0 WHERE user_name = '$user_name'";
$conn->query($sqlUpdateOnlineUsers);

//Cập nhật thời gian hoạt động gần nhất của người dùng
$sqlUpdateLastActivity = "UPDATE users SET last_activity = NOW() WHERE user_name = '$user_name'";
$conn->query($sqlUpdateLastActivity);
$data = true;

//Hủy session theo tên
unset($_SESSION['user']);

header('location: ../home.php');

?>
