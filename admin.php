<?php
include './setting/connect.php';
include './setting/permission.php';

$user = (isset($_SESSION['user']) ? $_SESSION['user'] : []);

//Kiểm tra người đã đăng nhập chưa, nếu chưa thì chuyển về login.php
if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
}

//Thống kê doanh thu
$sqlTotalprice = "SELECT SUM(total_price) as total_revenue FROM orders";
$result_total_revenue = mysqli_query($conn, $sqlTotalprice);
$row_total_revenue = mysqli_fetch_assoc($result_total_revenue);
$totalRevenue = $row_total_revenue['total_revenue'];

//Thống kê số đơn hàng hiện có
$sqlTotalOrders = "SELECT COUNT(*) AS id FROM orders";
$resultTotalOrders = $conn->query($sqlTotalOrders);
$rowTotalOrders = $resultTotalOrders->fetch_assoc();
$totalOrders = $rowTotalOrders['id'];

//Thống kê các sản phẩm hiện có
$sqlTotalProducts = "SELECT COUNT(*) AS id FROM product";
$resultTotalProducts = $conn->query($sqlTotalProducts);
$rowTotalProducts = $resultTotalProducts->fetch_assoc();
$totalProducts = $rowTotalProducts['id'];

//Thống kê số tài khoản người dùng
$sqlTotalUsers = "SELECT COUNT(*) AS id FROM users";
$resultTotalUsers = $conn->query($sqlTotalUsers);
$rowTotalUsers = $resultTotalUsers->fetch_assoc();
$totalUsers = $rowTotalUsers['id'];

//Thống kê số tài khoản người dùng đang online
$sqlOnlineUsers = "SELECT COUNT(*) AS online_users FROM users WHERE is_online = 1";
$resultOnlineUsers = $conn->query($sqlOnlineUsers);
$rowOnlineUsers = $resultOnlineUsers->fetch_assoc();
$onlineUsers = $rowOnlineUsers['online_users'];

?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINDEK</title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive_home.css">
</head>

<body>
    <div class="header_admin">
        <div class="frame_header_admin">
            <div class="logo_admin">
                <div class="frame_logo">
                    <div class="img_logo">
                        <a href="home.php"><img src="./img/logo.jpg"></a>
                    </div>
                    <h2><a href="admin.php" style="text-decoration: none; color: white;">ADMINDEK</a></h2>
                </div>
            </div>
            <div class="account_admin">
                <?php if (isset($user['user_name'])) { ?>
                    <li class="dropdown" id="dropdownn">
                        <img class="img_user" src="./img/<?php echo $user['avatar'] ?>">
                        <p class="dropdown-toggle" data-toggle="dropdown"><?php echo $user['name'] ?><b class="caret"></b></p>
                        <ul class="dropdown-menu login_menu">
                            <!--<li><a href="./login.php">Đăng kí</a></li>
                            <li><a href="./dangky.php">Đăng nhập</a></li>-->
                            <li><a href="#">Thông tin</a></li>
                            <?php if ($_SESSION['user']['role'] == 1) { ?>
                                <li><a href="admin.php">Quản lí</a></li>
                            <?php } ?>
                            <li><a href="./setting/logout.php">Đăng xuất</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="dropdown" id="dropdownn">
                        <p class="dropdown-toggle" data-toggle="dropdown">Tài khoản<b class="caret"></b></p>
                        <ul class="dropdown-menu">
                            <li><a href="./login.php">Đăng nhập</a></li>
                            <li><a href="./dangky.php">Đăng ký</a></li>
                            <!--<li><a href="logout.php">Đăng xuất</a></li>-->
                        </ul>
                    </li>
                <?php } ?>
                </ul>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var menuItems = document.querySelectorAll('#dropdownn .dropdown-menu');

                        for (var i = 0; i < menuItems.length; i++) {
                            var menuItem = menuItems[i];
                            var parentMenuItem = menuItem.parentElement;

                            parentMenuItem.addEventListener('click', function() {
                                var subMenu = this.querySelector('.dropdown-menu');

                                if (subMenu) {
                                    if (subMenu.style.display === 'none') {
                                        subMenu.style.display = 'block';
                                    } else {
                                        subMenu.style.display = 'none';
                                    }
                                }
                            });

                            parentMenuItem.addEventListener('mouseleave', function() {
                                var subMenu = this.querySelector('.dropdown-menu');

                                if (subMenu) {
                                    subMenu.addEventListener('mouseenter', function() {
                                        this.style.display = 'block';
                                    });

                                    subMenu.addEventListener('mouseleave', function() {
                                        this.style.display = 'none';
                                    });
                                }
                            });
                        }
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="content_admin">
        <div class="left_content" onscroll="syncScroll('right_content')">
            <div class="list_category">
                <ul>
                    <li><a href="admin.php?type=manager_product">Quản lí sản phẩm</a></li>
                    <li><a href="admin.php?type=manager_users">Quản lí người dùng</a></li>
                    <li><a href="admin.php?type=manager_orders">Quản lí đơn hàng</a></li>
                </ul>
            </div>
        </div>
        <div class="right_content" onscroll="syncScroll('left_content')">
            <div class="frame_statistic">
                <div class="statistic">
                    <div class="frame_total" style="background-color: red;">
                        <div class="total_profit">
                            <div class="title_total">
                                <h2>Total Profit</h2>
                                <i class="fas fa-money-bill-alt" style="color: red;"></i>
                            </div>
                            <span>
                                <h3><?php echo number_format($totalRevenue * 1000) ?>,000₫</h3>
                            </span>
                        </div>
                    </div>
                    <div class="frame_total" style="background-color: aqua;">
                        <div class="total_orders">
                            <div class="title_total">
                                <h2>Total Orders</h2>
                                <i class="fas fa-shopping-cart" style="color: aqua;"></i>
                            </div>
                            <span>
                                <h3><?php echo $totalOrders ?></h3>
                            </span>
                        </div>
                    </div>
                    <div class="frame_total" style="background-color: greenyellow;">
                        <div class="total_products">
                            <div class="title_total">
                                <h2>Total Products</h2>
                                <i class="fas fa-layer-group" style="color: greenyellow"></i>
                            </div>
                            <span>
                                <h3><?php echo $totalProducts ?></h3>
                            </span>
                        </div>
                    </div>
                    <div class="frame_total" style="background-color: yellow;">
                        <div class="total_users">
                            <div class="title_total">
                                <h2>Total Users</h2>
                                <i class="fas fa-user" style="color: yellow"></i>
                            </div>
                            <span>
                                <h3><?php echo $onlineUsers ?> / <?php echo $totalUsers ?></h3>
                            </span>
                        </div>
                    </div>
                    <!--<div>
                    <h3>Số người dùng đang trực tuyến: <?php echo $onlineUsers ?></h3>
                </div>-->
                </div>
            </div>
            <div class="content_manager">
                <?php if (isset($_GET['type'])) {
                    $type = $_GET['type'];
                    if ($type == 'manager_product') {
                        include 'manager_product.php';
                    } else if ($type == 'manager_users') {
                        include 'manager_users.php';
                    } else if ($type == 'manager_orders') {
                        include 'manager_orders.php';
                    } else if ($type == 'add_product') {
                        include 'add_product.php';
                    } else if ($type == 'fixed_product') {
                        include 'fixed_product.php';
                    }
                } ?>
            </div>
        </div>
    </div>
</body>

</html>