<?php
// Kiểm tra xem có gửi form tìm kiếm hay không
if (isset($_POST['searchss'])) {
    $search_query = $_POST['searchss'];

    // Sửa câu truy vấn SQL để bao gồm điều kiện tìm kiếm
    $sql = "SELECT o.*, u.name AS user_name, GROUP_CONCAT(CONCAT(' ', p.name, ' (x', od.quantity, ')')) AS product_names
            FROM orders AS o
            JOIN users AS u ON o.id_users = u.id
            JOIN orders_detail AS od ON o.id = od.id_order
            JOIN product AS p ON od.id_product = p.id
            WHERE o.id = '$search_query'
            GROUP BY o.id
            ORDER BY o.id DESC";
} else {
    // Nếu không có form tìm kiếm được gửi, sử dụng câu truy vấn gốc để hiển thị tất cả đơn hàng
    $sql = "SELECT o.*, u.name AS user_name, GROUP_CONCAT(CONCAT(' ', p.name, ' (x', od.quantity, ')')) AS product_names
            FROM orders AS o
            JOIN users AS u ON o.id_users = u.id
            JOIN orders_detail AS od ON o.id = od.id_order
            JOIN product AS p ON od.id_product = p.id
            GROUP BY o.id
            ORDER BY o.id DESC";
}

// Thực hiện truy vấn SQL để lấy tổng số bản ghi của bảng đơn hàng
$result = mysqli_query($conn, $sql);
$total_table = mysqli_num_rows($result);

// Thiết lập số bản ghi trên một trang
$limit = 10;

// Lấy trang hiện tại
$cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);

// Tính số trang
$page = ceil($total_table / $limit);

// Giới hạn trang hiện tại nằm trong phạm vi hợp lệ
$cr_page = max(1, min($page, $cr_page));

// Tính start
$start = ($cr_page - 1) * $limit;

// Sử dụng limit trong câu truy vấn
$sql .= " LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive_home.css">
</head>

<body>
    <div class="manager_orders_frame">
        <div class="title_manager_orders">
            <h3>Quản lí đơn hàng</h3>
        </div>
        <div class="operation_orders">
            <div class="frame_search_orders">
                <div class="search_orders">
                    <form action="" id="search_box" method="POST" role="form">
                        <input class="search_text" id="search_text" name="searchss" type="text" placeholder="Search...">
                        <button class="search_submit" id="search_submit" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="manager_orders">
            <table>
                <thead>
                    <tr>
                        <th>ID đơn hàng</th>
                        <th>Tên khách</th>
                        <th>Các sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Ghi chú</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                        <!--<th></th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $ord) : ?>
                        <tr>
                            <th class="id_order"><?php echo $ord['id'] ?></th>
                            <th><?php echo $ord['user_name'] ?></th>
                            <th class="content_product"><?php echo $ord['product_names'] ?></th>
                            <th><?php echo number_format($ord['total_price'] * 1000) ?>,000₫</th>
                            <th><?php echo $ord['address'] ?></th>
                            <th><?php echo $ord['sdt'] ?></th>
                            <th><?php echo $ord['note'] ?></th>
                            <th><?php echo $ord['time_order'] ?></th>
                            <?php if ($ord['status'] == 0) { ?>
                                <th>Chưa duyệt</th>
                            <?php } else { ?>
                                <th>Đã duyệt</th>
                            <?php } ?>
                            <th class="button_bd">
                                <?php if ($ord['status'] == 0) { ?>
                                    <button type="submit" class="order_browsing"><a href="status_orders1.php?id=<?php echo $ord['id'] ?>">Duyệt</a></button>
                                <?php } else { ?>
                                    <button type="submit" class="order_browsing"><a href="status_orders2.php?id=<?php echo $ord['id'] ?>">Hoàn tác</a></button>
                                <?php } ?>
                            </th>
                            <td class="button_fdd">
                                <button class="button_delete"><a href="remove_order.php?id=<?php echo $ord['id'] ?>">Xóa</a></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="page_number">
                <div class="number">
                    <ul>
                        <?php if ($cr_page - 1 > 0) { ?>
                            <li class="number1"><a href="admin.php?type=1&page=<?php echo $cr_page - 1 ?>"><i class="fas fa-chevron-left"></i></a></li>
                        <?php } ?>
                        <!--<li class="number1"><a href="#">2</a></li>
                    <li class="number1"><a href="#">3</a></li>
                    <li class="number1"><a href="#">4</a></li>-->
                        <?php for ($i = 1; $i <= $page; $i++) { ?>
                            <li class="number1 <?php echo (($cr_page == $i) ? 'active' : '') ?>"><a href="admin.php?type=1&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php } ?>
                        <?php if ($cr_page + 1 <= $page) { ?>
                            <li class="number1"><a href="admin.php?type=1&page=<?php echo $cr_page + 1 ?>"><i class="fas fa-chevron-right"></i></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>