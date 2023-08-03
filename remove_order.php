<?php
include './setting/connect.php';

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // Xóa các bản ghi trong bảng orders_detail liên quan đến đơn hàng có id là $order_id
    $sql_orders_detail = "DELETE FROM orders_detail WHERE id_order = '$order_id'";
    if ($conn->query($sql_orders_detail) === TRUE) {

        // Xóa bản ghi trong bảng orders có id là $order_id sau khi đã xóa các bản ghi liên quan trong bảng orders_detail
        $sql_orders = "DELETE FROM orders WHERE id = '$order_id'";
        if ($conn->query($sql_orders) === TRUE) {
            header('location: admin.php?type=manager_orders');
            exit();
        } else {
            $error_delete1 = "Lỗi khi xóa đơn hàng";
        }
    } else {
        $error_delete1 = "Lỗi khi xóa chi tiết đơn hàng";
    }
} else {
    $error_delete2 = "Không tìm thấy đơn hàng để xóa";
    header('location: admin.php?type=manager_orders');
}
?>
