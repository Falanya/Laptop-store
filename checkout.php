<?php
include './setting/connect.php';
include './cart-function.php';

$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
$user = (isset($_SESSION['user']) ? $_SESSION['user'] : []);


if (isset($_POST['name'])) {
    $id_user = $user['id'];
    $note = $_POST['note'];
    $sdt = $_POST['sdt'];
    $address = $_POST['address'];

    $total_price = total_price($cart);

    $query = mysqli_query($conn, "INSERT INTO orders(id_users,total_price,note,address,sdt) VALUES ('$id_user','$total_price','$note','$address','$sdt')");

    if ($query) {
        $id_order = mysqli_insert_id($conn);
        foreach ($cart as $values) {
            mysqli_query($conn, "INSERT INTO orders_detail(id_order,id_product,quantity,price) VALUES ('$id_order','$values[id]','$values[quantity]','$values[sale_price]')");
        }
        unset($_SESSION['cart']);
        header('location: home.php');
    }
}

?>

<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive_home.css">
</head>

<body>
    <?php include './header.php'; ?>
    <?php if (isset($_SESSION['user'])) { ?>
        <form method="POST">
            <div class="header_checkout">
                <div class="info_user">
                    <div class="introduce_info">
                        <h2>Thông tin của bạn</h2>
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Họ và tên</label>
                            <input name="name" value="<?php echo $user['name'] ?>" type="text" class="form-control" placeholder="Nhập tên của bạn" required="required">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input name="email" value="<?php echo $user['email'] ?>" type="text" class="form-control" placeholder="Nhập email của bạn" required="required">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số điện thoại</label>
                            <input name="sdt" type="text" class="form-control" placeholder="Nhập số điện thoại của bạn" required="required">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ nhận hàng</label>
                            <input name="address" type="text" class="form-control" placeholder="Nhập địa chỉ của bạn" required="required">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Note</label>
                            <textarea name="note" id="input" class="form-control" rows="3" placeholder="Muốn shop chú ý gì thì cứ ghi ạ (Không bắt buộc điền)"></textarea>
                        </div>
                    </form>
                </div>
                <div class="info_order">
                    <div class="introduce_order">
                        <h2>Thông tin đơn hàng</h2>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart as $key => $values) : ?>
                                <tr>
                                    <td class="name_product"><?php echo $values['name'] ?></td>
                                    <td><?php echo $values['quantity'] ?></td>
                                    <td><?php echo number_format($values['sale_price'] * $values['quantity'] * 1000) ?>,000₫</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="total_product">
                        <p>Tổng tiền <?php echo number_format(total_price($cart) * 1000) ?>,000₫</p>
                    </div>
                    <div>
                        <button class="submit_checkout">Đặt hàng</button>
                    </div>

                </div>
            </div>
        </form>
    <?php } else { ?>
        <div class="require_login">
            <div class="frame_require_login">
                <strong>Vui lòng đăng nhập để đặt hàng</strong> <a style="text-decoration: none;font-weight: 600; font-size: 17px;" href="./login.php?action=checkout">Đăng nhập</a>
            </div>
        </div>
    <?php } ?>
    <?php include './footer.php'; ?>
</body>

</html>