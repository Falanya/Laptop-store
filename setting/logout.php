<?php
include './connect.php';

//Lấy tên người dùng đang đăng xuất
$user_name = $_SESSION['user']['user_name'];

//Thay đổi trạng thái của người dùng thành offline
$sqlUpdateOnlineUsers = "UPDATE users SET is_online = 0 WHERE user_name = '$user_name'";
$conn->query($sqlUpdateOnlineUsers);

//Hủy session theo tên
unset($_SESSION['user']);

header('location: ../home.php');

// if(isset($_SESSION['user'])) {
//     $user = $_SESSION['user'];

//     //Lấy thời gian hiện tại
//     $current_time = time();

//     //Kiểm tra thời gian không hoạt động
//     $inactive_time = 0.1 * 60;

//     //Kiểm tra nếu người dùng không đăng nhập trong thời gian quy định thì chuyển về offline
//     if(($current_time - strtotime($user['last_activity'])) > $inactive_time) {

//         $user_name = $user['user_name'];
//         $sqlUpdateOnlineUsers = "UPDATE users SET is_online = 0 WHERE user_name = '$user_name'";
//         $conn->query($sqlUpdateOnlineUsers);

//         unset($_SESSION['user']);
//         header('location: home.php');
//         exit();
//     }

//     //Cập nhật thời gian hoạt động gần nhất của người dùng
//     $sqlUpdateLastActivity = "UPDATE users SET last_activity = NOW() WHERE user_name = '$user_name'";
//     $conn->query($sqlUpdateLastActivity);
// }
?>
