<?php
include './setting/connect.php';
include './cart-function.php';

$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
$user = (isset($_SESSION['user']) ? $_SESSION['user'] : []);

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
    <div class="header_view_cart">
        <div class="center_view_cart">
            <div class="frame_view_cart">
                <div class="introduce_view_cart">
                    <h2>Kiểm tra giỏ hàng</h2>
                </div>
                <?php if (empty($cart)) : ?>
                    <h3 class="hollow_cart">Giỏ hàng của bạn đang trống</h3>
                <?php else : ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <!--<th>Mã Sản phẩm</th>-->
                                <th style="border: none;"></th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <!--<th>Thành tiền</th>-->
                                <th style="border: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart as $key => $values) : ?>
                                <tr>
                                    <!--<td><?php //echo $key++ 
                                            ?></td>-->
                                    <td><img src="./img/<?php echo $values['image'] ?>"></td>
                                    <td class="name_product"><?php echo $values['name'] ?></td>
                                    <td>
                                        <form class="form_quantity" action="./cart.php">
                                            <input hidden="" name="action" value="update">
                                            <input hidden="" name="id" value="<?php echo $values['id'] ?>">
                                            <input class="product_quantity" type="text" name="quantity" value="<?php echo $values['quantity'] ?>">
                                            <button class="update_quantity" type="submit">Cập nhật</button>
                                        </form>
                                    </td>
                                    <td><?php echo $values['sale_price'] ?>.000₫</td>
                                    <!--<td><?php echo number_format($values['sale_price'] * $values['quantity'] * 1000) ?>,000₫</td>-->
                                    <td><button class="delete_product"><a href="./cart.php?id=<?php echo $values['id'] ?>&action=delete" title="" class="btn btn-danger">Xóa</a></button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="total">
                        <p class="total_product">Tổng tiền <?php echo number_format(total_price($cart) * 1000) ?>,000₫</p>
                        <!--<td colspan="6" class="text-center big-info"><?php echo number_format(total_price($cart) * 1000) ?>,000₫</td>-->
                    </div>
                    <div>
                        <div class="checkout">
                            <h3><a href="./checkout.php">Đặt hàng</a></h3>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include './footer.php'; ?>
</body>

</html>