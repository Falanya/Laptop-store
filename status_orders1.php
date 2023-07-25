<?php
include './setting/connect.php';
// Lấy dữ liệu từ URL
$order_id = $_GET["id"];
//$status = $_GET["status"];

// Cập nhật trạng thái trong bảng orders
$sql_update = "UPDATE orders SET status = 1 WHERE id = $order_id";
$conn->query($sql_update);

// Điều hướng ngược trở lại trang chủ
header("Location: admin.php?type=manager_orders");
exit();
?>
