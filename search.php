<?php
include './setting/connect.php';

$limit = 50; // Số sản phẩm hiển thị trên một trang
$cr_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại

if (isset($_GET['product_name'])) {
    $search_term = $_GET['product_name'];

    // Số sản phẩm phù hợp với từ khóa tìm kiếm
    $countSql = "SELECT COUNT(*) as total FROM product WHERE name LIKE '%$search_term%'";
    $resultCount = $conn->query($countSql);
    $total_table = $resultCount->fetch_assoc()['total'];

    // Tính tổng số trang dựa trên tổng số sản phẩm và số sản phẩm trên một trang
    $page = ceil($total_table / $limit);

    // Đảm bảo trang hiện tại không vượt quá số trang tìm được
    if ($cr_page > $page) {
        $cr_page = $page;
    }

    // Đảm bảo trang hiện tại không nhỏ hơn 1
    if ($cr_page < 1) {
        $cr_page = 1;
    }

    // Tính start để phân trang
    $start = ($cr_page - 1) * $limit;

    // Truy vấn dữ liệu sản phẩm cần tìm kiếm với phân trang
    $searchSql = "SELECT * FROM product WHERE name LIKE '%$search_term%' LIMIT $start, $limit";
    $resultSearch = $conn->query($searchSql);
} else {
    $error_search = "Không tìm thấy sản phẩm cần tìm";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm - Madara Technology</title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive_home.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="search">
        <div class="search_frame">
            <form action="search.php" id="search_box" method="GET" role="form">
                <input id="search_text" name="product_name" type="text" placeholder="Nhập tên sản phẩm cần tìm...">
                <button id="search_submit" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
    <!--Area of content-->
    <div class="content">
        <div class="content_type"></div>
        <div class="content_laptop">
            <div class="content_frame">
                <div class="content_card">
                    <?php if (isset($resultSearch) && $resultSearch->num_rows > 0) : ?>
                        <?php foreach ($resultSearch as $info_product) : ?>
                            <div class="content_item">
                                <div class="in_stock">
                                    <?php if ($info_product['status'] == 1) { ?>
                                        <i class="far fa-check-circle"></i>
                                        <p>In stock</p>
                                    <?php } else { ?>
                                        <i style="color: red;" class="fas fa-times-circle"></i>
                                        <p style="color: red;">Sold out</p>
                                    <?php } ?>
                                </div>
                                <div class="img_laptop">
                                    <a href="product_detail.php?id=<?php echo $info_product['id'] ?>"><img src="./img/<?php echo $info_product['image'] ?>" alt=""></a>
                                </div>
                                <div class="click_order">
                                    <p><a href="product_detail.php?id=<?php echo $info_product['id'] ?>">Click để xem chi tiết</a></p>
                                    <button><a style="text-decoration: none; color:white;" href="./cart.php?id=<?php echo $info_product['id'] ?>">Đặt hàng</a></button>
                                </div>
                                <div class="describe_laptop">
                                    <p><?php echo $info_product['name'] ?></p>
                                </div>
                                <div class="cost_laptop">
                                    <p style=""><?php echo $info_product['price'] ?>.000₫</p>
                                    <h2><?php echo $info_product['sale_price'] ?>.000₫</h2>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p style="font-weight: 600;">Không tìm thấy sản phẩm nào phù hợp.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if (isset($resultSearch)) { ?>
            <div class="page_number">
                <div class="number">
                    <ul>
                        <?php if ($cr_page - 1 > 0) { ?>
                            <li class="number1"><a href="search.php?page=<?php echo $cr_page - 1 ?>&product_name=<?php echo isset($_GET['product_name']) ? $_GET['product_name'] : '' ?>"><i class="fas fa-chevron-left"></i></a></li>
                        <?php } ?>
                        <?php for ($i = 1; $i <= ceil($total_table / $limit); $i++) { ?>
                            <li class="number1 <?php echo (($cr_page == $i) ? 'active' : '') ?>"><a href="search.php?page=<?php echo $i ?>&product_name=<?php echo isset($_GET['product_name']) ? $_GET['product_name'] : '' ?>"><?php echo $i ?></a></li>
                        <?php } ?>
                        <?php if ($cr_page + 1 <= ceil($total_table / $limit)) { ?>
                            <li class="number1"><a href="search.php?page=<?php echo $cr_page + 1 ?>&product_name=<?php echo isset($_GET['product_name']) ? $_GET['product_name'] : '' ?>"><i class="fas fa-chevron-right"></i></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } else { ?>
            <div class="unknown"></div>
        <?php } ?>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>