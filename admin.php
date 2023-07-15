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
        <div class=""></div>
    </div>
    <div class="content_admin">
        <div class="left_content">
            <div class="list_category">
                <ul>
                    <li><a href="admin.php?type=1">Thêm sản phẩm</a></li>
                    <li><a href="admin.php?type=2"></a></li>
                    <li><a href="admin.php?type=3"></a></li>
                </ul>
            </div>
        </div>
        <div class="right_content">
            <div class="content_manager">
                <?php if(isset($_GET['type'])) {
                    $type = $_GET['type'];
                    if($type==1){
                        include 'add_product.php';
                    }
                } ?>
            </div>
        </div>
    </div>
</body>

</html>