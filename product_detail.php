<?php
include './setting/connect.php';
//$user = [];
//$user = (isset($_SESSION['user']) ? $_SESSION['user'] : []);
//$user = $_SESSION['user'];

$product_id = $_GET['id']; // Lấy ID sản phẩm từ URL

// Truy vấn cơ sở dữ liệu để lấy thông tin sản phẩm
$sql = "SELECT * FROM product WHERE id = '$product_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $product_name = $row["name"];
    $product_image = $row["image"];
    $product_price = $row["price"];
    $product_sale_price = $row["sale_price"];
    $product_cpu = $row["cpu"];
    $product_ram = $row["ram"];
    $product_o_cung = $row["o_cung"];
    $product_card_do_hoa = $row["card_do_hoa"];
    $product_trong_luong = $row["trong_luong"];
    $product_mau_sac = $row["mau_sac"];
    $product_kich_thuoc = $row["kich_thuoc"];

    // Hiển thị thông tin sản phẩm
    // echo "<h1>$product_name</h1>";
    // echo "<p>Giá: $product_price</p>";
    // Hiển thị các thông tin khác của sản phẩm...
} else {
    echo "Không tìm thấy sản phẩm.";
}

?>

<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product_name ?></title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive_home.css">
</head>

<body>
    <?php include './header.php' ?>

    <?php foreach ($result as $product) : ?>
        <div class="product_details" style="margin: 100px;">
            <div class="product_details_frame">
                <div class="chia_doi_content">
                    <div class="product_details_left">
                        <img src="./img/<?php echo $product['image'] ?>">
                        <div class="product_details_name">
                            <h3><?php echo $product['name'] ?></h3>
                            <div class="cost_laptop">
                                <h2 style="color: red;"><?php echo $product['price'] ?>.000₫</h2>
                                <h4 style="color: grey; text-decoration: line-through;"><?php echo $product['sale_price'] ?>.000₫</h4>
                            </div>
                        </div>
                    </div>
                    <div class="product_details_right">
                        <div class="product_details_content">
                            <h3>Thông số kỹ thuật</h3>
                            <table>
                                <tbody style="box-sizing: border-box;">
                                    <tr>
                                        <td class="product_details_info_1">CPU</td>
                                        <td class="product_details_info_2"><?php echo $product['cpu'] ?>.</td>
                                    </tr>
                                    <tr>
                                        <td class="product_details_info_1">RAM</td>
                                        <td class="product_details_info_2"><?php echo $product['ram'] ?>.</td>
                                    </tr>
                                    <tr>
                                        <td class="product_details_info_1">Ổ cứng</td>
                                        <td class="product_details_info_2"><?php echo $product['o_cung'] ?>.</td>
                                    </tr>
                                    <tr>
                                        <td class="product_details_info_1">Card đồ họa</td>
                                        <td class="product_details_info_2"><?php echo $product['card_do_hoa'] ?>.</td>
                                    </tr>
                                    <tr>
                                        <td class="product_details_info_1">Trọng lượng</td>
                                        <td class="product_details_info_2"><?php echo $product['trong_luong'] ?>.</td>
                                    </tr>
                                    <tr>
                                        <td class="product_details_info_1">Màu sắc</td>
                                        <td class="product_details_info_2"><?php echo $product['mau_sac'] ?>.</td>
                                    </tr>
                                    <tr>
                                        <td class="product_details_info_1">Kích thước</td>
                                        <td class="product_details_info_2"><?php echo $product['kich_thuoc'] ?>.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product_details_orders">
                            <!--<button type="submit"><a href="#">Mua ngay</a></button>-->
                            <?php if ($product['status'] == 1) { ?>
                                <button type="submit"><a href="./cart.php?id=<?php echo $product['id'] ?>">Thêm vào giỏ hàng</a></button>
                            <?php } else { ?>
                                <button type="submit"><a>Sản phẩm hết hàng</a></button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php include './footer.php' ?>
</body>

</html>