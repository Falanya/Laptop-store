<!--Area of header-->
<div class="header">
    <div class="header_top">
        <p>Mon-Thu: 9:00 AM - 5:30 PM</p>
        <p>Address: Tầng 12 Tòa Madara Uchiha, Uchiha Village, Konoha</p>
        <div class="header_contact">
            <p>Call: (+84) 999999999</p>
            <a href="https://www.facebook.com/profile.php?id=100093533659732"><i class="fab fa-facebook-square"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
    <div class="header_bot">
        <div class="header_icon">
            <a href="./home.php"><img src="./img/logo.jpg" alt="icon" width="50px" height="55px"></a>
        </div>
        <div class="header_menu" style="font-weight: 600;">
            <ul>
                <li><a href="#">Gaming</a></li>
                <li><a href="#">MacBook</a></li>
                <li><a href="#">Học tập, văn phòng</a></li>
            </ul>
        </div>
        <div class="deals">
            <button>Deals</button>
        </div>
        <div class="header_accout">
            <ul>
                <li><a href="#"><i class="fas fa-search"></a></i></li>
                <li>
                    <a href="./view-cart.php"><i class="fas fa-shopping-cart"></a></i>
                    <span class="number_cart"><?php echo count($cart) ?></span> <!-- thay count($cart) bằng total_item($cart) nếu muốn hiển thị số sản phẩm theo số lượng -->
                </li>
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