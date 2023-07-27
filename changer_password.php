<?php
include './setting/connect.php';

if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
}

$success_changer = false;

if (isset($_POST['submit'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Kiểm tra xem mật khẩu mới và xác nhận mật khẩu có trùng khớp không
    if ($newPassword !== $confirmPassword) {
        $error_changer1['confirm_password'] = "Mật khẩu mới không trùng khớp. Vui lòng nhập lại";
    } else {
        // Kiểm tra xem mật khẩu hiện tại của người dùng có đúng không
        $userId = $_SESSION['user']['id'];
        $sql = "SELECT password FROM users WHERE id = $userId";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            if (password_verify($currentPassword, $hashedPassword)) {
                // Nếu mật khẩu hiện tại đúng, tiến hành cập nhật mật khẩu mới trong cơ sở dữ liệu
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Mã hóa mật khẩu mới thành chuỗi 255 kí tự

                $sql = "UPDATE users SET password = '$hashedNewPassword' WHERE id = $userId";

                if ($conn->query($sql) === TRUE) {
                    $success_changer = true;
                } else {
                    echo "Lỗi khi đổi mật khẩu: " . $conn->error;
                }
            } else {
                $error_changer2['current_password'] = "Mật khẩu hiện tại không đúng. Vui lòng kiểm tra lại";
            }
        } else {
            echo "Không tìm thấy người dùng.";
        }
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
                                <li>
                                    <i class="fas fa-user"></i>
                                    <a href="profile_users.php?v=<?php echo $user['name'] ?>">Thông tin</a>
                                </li>
                                <li style="background-color: #ececec;">
                                    <i class="fas fa-lock"></i>
                                    <a href="changer_password.php?v=<?php echo $user['name'] ?>">Đổi mật khẩu</a>
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
                                    <p><label class="title_info" for="">Mật khẩu hiện tại:</label></p>
                                    <p><label class="title_info" for="">Mật khẩu mới:</label></p>
                                    <p><label class="title_info" for="">Nhập lại mật khẩu mới:</label></p>
                                </div>
                                <div class="form-group info_form">
                                    <input type="text" class="form-control" id="" name="current_password" placeholder="Nhập mật khẩu hiện tại" required>
                                    <input type="text" class="form-control" id="" name="new_password" placeholder="Nhập mật khẩu mới" required>
                                    <input type="text" class="form-control" id="" name="confirm_password" placeholder="Nhập lại mật khẩu mới" required>
                                </div>
                            </div>
                            <div class="button_profile">
                                <button style="cursor: pointer;" type="submit" name="submit">Đổi mật khẩu</button>
                            </div>
                        </form>
                        <div class="notification_changer_password" style="display: flex; justify-content: center; align-items: center;">
                            <?php if ($success_changer) { ?>
                                <p style="color: tomato;">Thay đổi mật khẩu thành công</p>
                            <?php } ?>
                            <p style="color: tomato;"><?php echo (isset($error_changer2['current_password'])) ? $error_changer2['current_password'] : '' ?></p>
                            <p style="color: tomato;"><?php echo (isset($error_changer1['confirm_password'])) ? $error_changer1['confirm_password'] : '' ?></p>
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