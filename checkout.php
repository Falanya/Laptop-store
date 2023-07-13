<?php
include './setting/connect.php';
include './cart-function.php';

$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
$user = (isset($_SESSION['user']) ? $_SESSION['user'] : []);

if(isset($_POST['name'])){
    $id_user = $user['id'];
    $note = $_POST['note'];
    $sdt = $_POST['sdt'];
    $address = $_POST['address'];

    $query = mysqli_query($conn, "INSERT INTO orders(id_users,note,address,sdt) VALUES ('$id_user','$note','$address','$sdt')");

    if($query){
        $id_order = mysqli_insert_id($conn);
        foreach($cart as $values){
            mysqli_query($conn,"INSERT INTO orders_detail(id_order,id_product,quantity,price) VALUES ('$id_order','$values[id]','$values[quantity]','$values[sale_price]')");
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
            <div>
                <div>
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Họ và tên</label>
                            <input name="name" value="<?php echo $user['name'] ?>" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input name="email" value="<?php echo $user['email'] ?>" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số điện thoại</label>
                            <input name="sdt" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ nhận hàng</label>
                            <input name="address" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Note</label>
                            <textarea name="note" id="input" class="form-control" rows="3" required="required"></textarea>
                        </div>
                    </form>
                </div>
                <div>
                    <div class="header_checkout">
                        <h2>Thông tin đơn hàng</h2>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart as $key => $values) : ?>
                                <tr>
                                    <td><img src="./img/<?php echo $values['image'] ?>" width="150px" height="150px"></td>
                                    <td><?php echo $values['name'] ?></td>
                                    <td><?php echo $values['quantity'] ?></td>
                                    <td><?php echo $values['sale_price'] ?>.000 VNĐ</td>
                                    <td><?php echo number_format($values['sale_price'] * $values['quantity'] * 1000) ?>,000 VNĐ</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td>Tổng tiền</td>
                                <td colspan="6" class="text-center big-info"><?php echo number_format(total_price($cart) * 1000) ?>,000 VNĐ</td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <div>
                            <button>Chốt đơn</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php } else { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Vui lòng đăng nhập để đặt hàng</strong> <a href="./login.php?action=checkout">Login</a>
        </div>
    <?php } ?>
    <?php include './footer.php'; ?>
</body>

</html>