<?php
include './setting/connect.php';

if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
}

if (isset($_POST['user_name'])) {
    $user_name = $_POST['user_name'];
    $name = $_POST['name'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $query = mysqli_query($conn, "UPDATE users SET name = '$name', sdt = '$sdt', email = '$email', address = '$address' WHERE user_name = '$user_name'");
    if ($query) {
        $profile_success = "Đã thay đổi thông tin";
        //Cập nhật thông tin mới của người dùng vào phiên SESSION
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['sdt'] = $sdt;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['address'] = $address;
        header('location: home.php');
    } else {
        $profile_error = "Lỗi thay đổi thông tin";
    }
}

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
                                <li style="background-color: #ececec;">
                                    <i class="fas fa-user"></i>
                                    <a href="profile_users.php?v=<?php echo $user['name'] ?>">Thông tin</a>
                                </li>
                                <li>
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
                        <h2>Thông tin tài khoản</h2>
                        <form method="POST">
                            <div class="frame_form">
                                <div class="form-group title_form">
                                    <p><label class="title_info" for="">Tài khoản:</label></p>
                                    <p><label class="title_info" for="">Họ tên:</label></p>
                                    <p><label class="title_info" for="">Số điện thoại:</label></p>
                                    <p><label class="title_info" for="">Email:</label></p>
                                    <p><label class="title_info" for="">Địa chỉ:</label></p>
                                </div>
                                <div class="form-group info_form">
                                    <input value="<?php echo $user['user_name']; ?>" type="text" class="form-control" id="" name="user_name" placeholder="Nhập tài khoản người dùng cần sửa" readonly>
                                    <input value="<?php echo $user['name']; ?>" type="text" class="form-control" id="" name="name" placeholder="Nhập tên người dùng cần sửa">
                                    <input value="<?php echo $user['sdt']; ?>" type="text" class="form-control" id="" name="sdt" placeholder="Nhập số điện thoại cần sửa">
                                    <input value="<?php echo $user['email']; ?>" type="text" class="form-control" id="" name="email" placeholder="Nhập email cần sửa">
                                    <input value="<?php echo $user['address']; ?>" type="text" class="form-control" id="" name="address" placeholder="Nhập địa chỉ cần sửa">
                                </div>
                            </div>
                            <div class="button_profile">
                                <button style="cursor: pointer;" type="submit" name="submit">Lưu thông tin</button>
                            </div>
                        </form>
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