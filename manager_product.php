<?php
// Kiểm tra xem có gửi form tìm kiếm hay không
if (isset($_POST['searchss'])) {
    $search_query = $_POST['searchss'];

    // Sửa câu truy vấn SQL để bao gồm điều kiện tìm kiếm
    $sql = "SELECT product.*, hang.name AS 'name_hang' FROM product JOIN hang ON product.id_hang = hang.id WHERE product.name LIKE '%$search_query%'";
} else {
    // Nếu không có form tìm kiếm được gửi, sử dụng câu truy vấn gốc để hiển thị tất cả sản phẩm
    $sql = "SELECT product.*, hang.name AS 'name_hang' FROM product JOIN hang ON product.id_hang = hang.id";
}

// Thực hiện truy vấn SQL để lấy tổng số bản ghi của bảng sản phẩm
$result = mysqli_query($conn, $sql);
$total_table = mysqli_num_rows($result);

// Thiết lập số bản ghi trên một trang
$limit = 20;

// Lấy trang hiện tại
$cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);

// Tính số trang
$page = ceil($total_table / $limit);

// Giới hạn trang hiện tại nằm trong phạm vi hợp lệ
$cr_page = max(1, min($page, $cr_page));

// Tính start
$start = ($cr_page - 1) * $limit;

// Sử dụng limit trong câu truy vấn
$sql .= " ORDER BY product.id DESC LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive_home.css">
</head>

<body>
    <div class="manager_product_frame">
        <div class="title_manager_product">
            <h3>Quản lí sản phẩm</h3>
        </div>
        <div class="operation_product">
            <div class="button_add_product">
                <button><a href="admin.php?type=add_product">Thêm sản phẩm</a></button>
            </div>
            <div class="frame_search_product">
                <div class="search_product">
                    <form action="" id="search_box" method="POST" role="form">
                        <input class="search_text" id="search_text" name="searchss" type="text" placeholder="Search...">
                        <button class="search_submit" id="search_submit" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="manager_product">
            <table>
                <thead>
                    <tr>
                        <th>ID sản phẩm</th>
                        <th>Tên sản phẩm </th>
                        <th>Hãng</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <!--<th></th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $pro) : ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $pro['id'] ?></td>
                            <td style="text-align: center;"><?php echo $pro['name'] ?></td>
                            <td style="text-align: center;"><?php echo $pro['name_hang'] ?></td>
                            <td style="text-align: center;"><?php echo $pro['quantity'] ?></td>
                            <?php if ($pro['status'] == 1) { ?>
                                <td style="text-align: center;">Còn hàng</td>
                            <?php } else { ?>
                                <td style="text-align: center;">Hết hàng</td>
                            <?php } ?>
                            <td class="button_fdd">
                                <button class="button_fixed"><a href="admin.php?type=fixed_product&id=<?php echo $pro['id'] ?>">Sửa</a></button>
                                <button class="button_delete"><a href="remove_product.php?id=<?php echo $pro['id'] ?>">Xóa</a></button>
                                <button class="button_details"><a href="product_detail.php?id=<?php echo $pro['id'] ?>">Chi tiết</a></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="page_number">
                <div class="number">
                    <ul>
                        <?php if ($cr_page - 1 > 0) { ?>
                            <li class="number1"><a href="admin.php?type=manager_product&page=<?php echo $cr_page - 1 ?>"><i class="fas fa-chevron-left"></i></a></li>
                        <?php } ?>
                        <!--<li class="number1"><a href="#">2</a></li>
                    <li class="number1"><a href="#">3</a></li>
                    <li class="number1"><a href="#">4</a></li>-->
                        <?php for ($i = 1; $i <= $page; $i++) { ?>
                            <li class="number1 <?php echo (($cr_page == $i) ? 'active' : '') ?>"><a href="admin.php?type=manager_product&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php } ?>
                        <?php if ($cr_page + 1 <= $page) { ?>
                            <li class="number1"><a href="admin.php?type=manager_product&page=<?php echo $cr_page + 1 ?>"><i class="fas fa-chevron-right"></i></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>