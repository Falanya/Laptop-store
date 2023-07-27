<?php
include './setting/connect.php';

if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
}

$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);

//Tính số bản ghi của bảng product
$total_table = mysqli_num_rows($result);

//Thiết lập số bảng ghi trên một trang
$limit = 7;

//Lấy trang hiện tại
$cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);

//Tính số trang
$page = ceil($total_table / $limit);

//Tính start
$start = ($cr_page - 1) * $limit;

$user_name = $_SESSION['user']['name'];

$user_id = $_SESSION['user']['id'];
$orders = mysqli_query($conn, "SELECT o.*, GROUP_CONCAT(CONCAT(p.name, ' (x', od.quantity, ')')) AS product_names FROM orders AS o
JOIN orders_detail AS od ON o.id = od.id_order
JOIN product AS p ON od.id_product = p.id
WHERE o.id_users = $user_id
GROUP BY o.id
ORDER BY o.id DESC
LIMIT $start, $limit");

?>

<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive_home.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <?php if (isset($_SESSION['user'])) { ?>
        <div class="frame_profile_users">
            <div class="profile_users">
                <div class="profile_users_left">
                    <div class="frame_p_u_l">
                        <div class="account_name">
                            <img src="./img/<?php echo $user['avatar'] ?>">
                            <p><?php echo $user['name'] ?></p>
                        </div>
                        <div class="title_account">
                            <ul>
                                <li>
                                    <i class="fas fa-user"></i>
                                    <a href="profile_users.php?v=<?php echo $user['name'] ?>">Thông tin</a>
                                </li>
                                <li>
                                    <i class="fas fa-lock"></i>
                                    <a href="changer_password.php?v=<?php echo $user['name'] ?>">Đổi mật khẩu</a>
                                </li>
                                <li style="background-color: #ececec;">
                                    <i class="fas fa-shopping-bag"></i>
                                    <a href="orders_users.php?v=<?php echo $user['name'] ?>">Quản lý đơn hàng</a>
                                </li>
                                <li>
                                    <i class="fas fa-sign-out-alt"></i>
                                    <a href="./setting/logout.php">Đăng xuất</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="profile_users_right">
                    <div class="frame_p_u_r">
                        <h2>Quản lý đơn hàng</h2>
                        <div class="content_orders">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID đơn</th>
                                        <th>Các sản phẩm</th>
                                        <th>Tổng tiền</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $ord) : ?>
                                        <tr>
                                            <td class="id_ord_u"><?php echo $ord['id'] ?></td>
                                            <td class="content_ord_u" style="text-align: left;"><?php echo $ord['product_names'] ?></td>
                                            <td><?php echo number_format($ord['total_price'] * 1000) ?>,000₫</td>
                                            <td class="address_ord_u" style="text-align: left;"><?php echo $ord['address'] ?></td>
                                            <td><?php echo $ord['sdt'] ?></td>
                                            <td><?php echo $ord['time_order'] ?></td>
                                            <?php if ($ord['status'] == 1) { ?>
                                                <td>Đã duyệt</td>
                                            <?php } else { ?>
                                                <td>Chưa duyệt</td>
                                            <?php } ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="page_number">
                                <div class="number">
                                    <ul>
                                        <?php if ($cr_page > 1) { ?>
                                            <li class="number1"><a href="orders_users.php?v=<?php echo $user_name ?>&page=<?php echo $cr_page - 1 ?>"><i class="fas fa-chevron-left"></i></a></li>
                                        <?php } ?>
                                        <?php for ($i = 1; $i <= $page; $i++) { ?>
                                            <li class="number1 <?php echo (($cr_page == $i) ? 'active' : '') ?>"><a href="orders_users.php?v=<?php echo $user_name ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        <?php } ?>
                                        <?php if ($cr_page < $page) { ?>
                                            <li class="number1"><a href="orders_users.php?v=<?php echo $user_name ?>&page=<?php echo $cr_page + 1 ?>"><i class="fas fa-chevron-right"></i></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="frame_not_login">
            <div class="profile_not_login">
                <h2>Vui lòng bấm vào đây để <a href="login.php">Đăng nhập</a></h2>
            </div>
        </div>
    <?php } ?>

    <?php include 'footer.php'; ?>
</body>

</html>