<?php
include './setting/connect.php';

//Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['user'])) {
    //Người dùng đã đăng nhập, chuyển hướng đến trang home
    header('location: home.php');
    exit();
}
$_SESSION['last_activity'] = time();

if (isset($_POST['user_name'])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM users WHERE user_name = '$user_name'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);
    $checkUser_name = mysqli_num_rows($query);
    if ($checkUser_name == 1) {

        $checkPassword = password_verify($password, $data['password']);

        if ($checkPassword) {
            //luu vao session
            $_SESSION['user'] = $data;
            //Đặt người đang online là 1
            $setUpdateOnlineUsers = "UPDATE users SET is_online = 1 WHERE user_name = '$user_name'";
            $conn->query($setUpdateOnlineUsers);
            //Cập nhật thời gian hoạt động gần nhất của người dùng
            $sqlUpdateLastActivity = "UPDATE users SET last_activity = NOW() WHERE user_name = '$user_name'";
            $conn->query($sqlUpdateLastActivity);
            $data = true;
            // if(isset($_GET['action'])){
            //     $action = $_GET['action'];
            //     header('location: '.$action.'.php');
            // } else {
            //     header('location: home.php');
            // }
            //Kiêm tra vai trò của người dùng
            if ($_SESSION['user']['role'] == 1) {
                header('location: admin.php');
            } else {
                header('location: home.php');
            }

            exit();
        } else {
            $errorMk['password'] = "Sai mật khẩu nha :3";
        }
    } else {
        $errorTK['user_name'] = "Tên người dùng không tồn tại nha :3";
    }
}
?>

<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive.css">
</head>

<body>
    <div class="login_admin_page">
        <div class="login_admin_header">
            <div class="form_login">
                <form action="" method="POST">
                    <h3 style="font-size: 30px; margin-bottom: 20px; text-align: center;">Đăng nhập</h3>
                    <div class="form-group">
                        <label>Tên người dùng</label>
                        <input type="text" id="" name="user_name" placeholder="Nhập tên người dùng nè UwU :3" required="required">
                        <p style="padding: 5px; text-align: center; color: tomato;"> <?php echo (isset($errorTK['user_name'])) ? $errorTK['user_name'] : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" id="" name="password" placeholder="Nhập mật khẩu cho đúng nha UwU :3" required="required">
                        <p style="padding: 5px; text-align: center; color: tomato;"> <?php echo (isset($errorMk['password'])) ? $errorMk['password'] : '' ?></p>
                    </div>
                    <button name="dangnhap" type="submit">Đăng nhập</button>
                    <div class="list_login">
                        <ul>
                            <li><a href="./home.php">Trang chủ</a></li>
                            <li><a href="./dangky.php">Đăng ký</a></li>
                            <li><a href="./forgot_password.php">Quên mật khẩu</a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>