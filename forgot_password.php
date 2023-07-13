<?php
include './setting/connect.php';

?>

<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive.css">
</head>

<body>
    <div class="background_forgot_password">
        <div class="forgot_password_frame">
            <form class="form_forgot_password" method="POST" action="">
                <h3 style="font-size: 30px; margin-bottom: 20px; text-align: center;">Quên mật khẩu</h3>
                <div class="form-group">
                    <label>Tên người dùng</label>
                    <input id="" name="user_name" placeholder="Điền tên người dùng nè :3">
                </div>
                <div class="form-group">
                    <label>Mật khẩu đã quên</label>
                    <input id="" name="password" placeholder="Điền mật khẩu bạn đã quên :33">
                </div>
                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <input id="" name="new_password" placeholder="Điền mật khẩu mới nha">
                </div>
                <div class="form-group">
                    <label>Xác nhận mật khẩu mới</label>
                    <input id="" name="Rnew_password" placeholder="Xác nhận mật khẩu mới nè UwU">
                </div>
                <button type="submit" id="">Đổi mật khẩu</button>
                <div class="list_forgot_password">
                    <ul>
                        <li><a href="./home.php">Trang chủ</a></li>
                        <li><a href="./login.php">Đăng nhập</a></li>
                        <li><a href="./dangky.php">Đăng ký</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</body>

</html>