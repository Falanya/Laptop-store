<?php
include './setting/connect.php';

$user = (isset($_SESSION['user']) ? $_SESSION['user'] : []);


?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
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
                    <h2>ADMINDEK</h2>
                </div>
            </div>
            <div class="account_admin">
                <?php if (isset($user['user_name'])) { ?>
                    <li class="dropdown" id="dropdownn">
                        <img class="img_user" src="./img/<?php echo $user['avatar'] ?>">
                        <p class="dropdown-toggle" data-toggle="dropdown"><?php echo $user['name'] ?><b class="caret"></b></p>
                        <ul class="dropdown-menu">
                            <!--<li><a href="./login.php">Đăng kí</a></li>
                            <li><a href="./dangky.php">Đăng nhập</a></li>-->
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
        <div class="left_content">
            <div class="list_category">
                <ul>
                    <li><a href="admin.php?type=1">Quản lí sản phẩm</a></li>
                    <li><a href="admin.php?type=2">Quản lí người dùng</a></li>
                    <li><a href="admin.php?type=3">Quản lí đơn hàng</a></li>
                </ul>
            </div>
        </div>
        <div class="right_content">
            <div class="content_manager">
                <?php if (isset($_GET['type'])) {
                    $type = $_GET['type'];
                    if ($type == 1) {
                        include 'manager_product.php';
                    } else if ($type == 2) {
                        include 'manager_users.php';
                    } else if ($type == 3) {
                        include 'manager_check.php';
                    }
                } ?>
            </div>
        </div>
    </div>
</body>

</html>