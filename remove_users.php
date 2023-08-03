<?php
//Chưa hoàn thành
include './setting/connect.php';

if (isset($_GET['id'])) {
    $users_id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = '$users_id'";

    if ($conn->query($sql) === TRUE) {
        header('location: admin.php?type=manager_users');
        exit();
    } else {
        $error_delete1 = "Lỗi khi xóa người xóa";
    }
} else {
    $error_delete2 = "Không tìm thấy người dùng để xóa";
    header('location: admin.php?type=manager_users');
}
?>
