<?php
//include './setting/connect.php';

$sql = "SELECT product.*, hang.name AS 'name_hang' FROM product JOIN hang ON product.id_hang = hang.id";
$result = mysqli_query($conn, $sql);

$user = (isset($_SESSION['user']) ? $_SESSION['user'] : []);


?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="./Css/product.css">
    <link rel="stylesheet" href="./Css/responsive.css">
</head>

<body>
    <div class="header">
        <div class="header_product_frame">
            <div class="home">
                <a href="./home.php"><img src="./img/logo.jpg" alt="Home"></a>
            </div>
            <div class="add_product">
                <h3><a href="./add_product.php">Thêm sản phẩm</a></h3>
            </div>
            <div class="product" style="background-color: black;">
                <h3><a href="./product.php">Danh sách</a></h3>
            </div>
            <div class="fixed_product">
                <h3><a href="./fixed_product.php">Sửa sản phẩm</a></h3>
            </div>
        </div>
    </div>
    <div class="manager_frame">
        <h3>Danh sách sản phẩm</h3>
        <div class="manager_product">
            <table>
                <thead>
                    <tr>
                        <th>ID sản phẩm</th>
                        <th>Tên sản phẩm </th>
                        <th>Hãng</th>
                        <th>Thông số</th>
                        <th>Giá</th>
                        <th>Giá khuyến mãi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $pro) : ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $pro['id'] ?></td>
                            <td><?php echo $pro['name'] ?></td>
                            <td><?php echo $pro['name_hang'] ?></td>
                            <td>
                                <ul>
                                    <li>CPU: <?php echo $pro['cpu'] ?>.</li>
                                    <br>
                                    <li>RAM: <?php echo $pro['ram'] ?>.</li>
                                    <br>
                                    <li>Ổ cứng: <?php echo $pro['o_cung'] ?>.</li>
                                    <br>
                                    <li>Card đồ họa: <?php echo $pro['card_do_hoa'] ?>.</li>
                                    <br>
                                    <li>Trọng lượng: <?php echo $pro['trong_luong'] ?>.</li>
                                    <br>
                                    <li>Màu sắc: <?php echo $pro['mau_sac'] ?>.</li>
                                    <br>
                                    <li>Kích thước: <?php echo $pro['kich_thuoc'] ?>.</li>
                                </ul>
                            </td>
                            <td><?php echo $pro['price'] ?>.000₫</td>
                            <td><?php echo $pro['sale_price'] ?>.000₫</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>