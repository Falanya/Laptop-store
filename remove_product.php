<?php
include './setting/connect.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "DELETE FROM product WHERE id = '$product_id'";

    if ($conn->query($sql) === TRUE) {
        header('location: admin.php?type=manager_product');
        exit();
    } else {
        $error_delete1 = "Lỗi khi xóa sản phẩm";
    }
} else {
    $error_delete2 = "Không tìm thấy sản phẩm để xóa";
    header('location: admin.php?type=manager_product');
}
?>
