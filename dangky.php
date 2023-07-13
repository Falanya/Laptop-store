<?php
include './setting/connect.php';

//Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['user'])) {
    //Người dùng đã đăng nhập, chuyển hướng đến trang home
    header('location: home.php');
    exit();
}

$err = [];
if (isset($_POST['user_name'])) {
    $user_name = $_POST['user_name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rPassword = $_POST['rPassword'];
    $address = $_POST['address'];
    $sdt = $_POST['sdt'];

    if ($password != $rPassword) {
        $err['rPassword'] = 'Phải nhập lại mật khẩu cho đúng nha';
    }
    //var_dump(empty($err));
    if (empty($err)) {
        //password_hash(string, PASSWORD_DEFAULT);
        $pass = password_hash($password, PASSWORD_DEFAULT);
        //var_dump($pass);
        //die();
        $avatarDefault = "boNhat.jpg";
        $sql = "INSERT INTO users(user_name,name,email,password,address,sdt,avatar) VALUES ('$user_name','$name','$email','$pass','$address','$sdt','$avatarDefault')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            header('location: login.php');
        }
    }
    //die();

}
?>

<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive.css">
</head>

<body>
    <div class="dangky_admin_page">
        <div class="dangky_admin_header">
            <div class="form_dangky">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <h3 style="font-size: 30px; margin-bottom: 5px; text-align: center;">Đăng ký</h3>
                    <div class="form-group">
                        <label>Tên người dùng (Tối đa 20 kí tự nha)</label>
                        <input type="text" id="" name="user_name" placeholder="Nhập tên người dùng nè ehe" required="required">
                    </div>
                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input type="text" id="" name="name" placeholder="Tên của bạn là gì nè? :3" required="required">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu (Tối đa 20 kí tự nha)</label>
                        <input type="password" id="" name="password" placeholder="Nhập mật khẩu nè UwU" required="required">
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input type="password" id="" name="rPassword" placeholder="Nhập lại mật khẩu cho chắc nè :3" required="required">
                        <div class="has-error">
                            <span> <?php echo (isset($err['rPassword'])) ? $err['rPassword'] : '' ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="" name="email" placeholder="Email cho đầy đủ nè :3" required="required">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" id="" name="sdt" placeholder="Thêm số điện thoại nữa nha :3" required="required">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" id="" name="address" placeholder="Hứa không để lộ địa chỉ ehe ( ͡° ͜ʖ ͡°)" required="required">
                    </div>
                    <button name="dangnhap" type="submit">Đăng ký</button>
                    <div class="list_dangky">
                        <ul>
                            <li><a href="./home.php">Trang chủ</a></li>
                            <li><a href="./login.php">Đăng nhập</a></li>
                            <li><a href="./forgot_password.php">Quên mật khẩu</a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>