<?php
//include './setting/connect.php';

if (isset($_GET['id'])) {
    $id_product = $_GET['id'];

    $sql = "SELECT product.*, hang.name AS 'name_hang' FROM product JOIN hang ON product.id_hang = hang.id WHERE product.id = $id_product";
    $result = mysqli_query($conn, $sql);
    $hangg = mysqli_query($conn, "SELECT * FROM hang");

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        $error_fixed1 = "Không tìm thấy sản phẩm";
        header('location: admin.php?type=manager_product');
        exit();
    }
} else {
    $error_fixed2 = "Không tìm thấy ID sản phẩm";
    header('location: admin.php?type=manager_product');
    exit();
}

if (isset($_POST['name'])) {
    $updated_name = $_POST['name'];
    $updated_quantity = $_POST['quantity'];
    $updated_price = $_POST['price'];
    $updated_sale_price = $_POST['sale_price'];
    $updated_id_hang = $_POST['id_hang'];
    $updated_cpu = $_POST['cpu'];
    $updated_ram = $_POST['ram'];
    $updated_o_cung = $_POST['o_cung'];
    $updated_card_do_hoa = $_POST['card_do_hoa'];
    $updated_trong_luong = $_POST['trong_luong'];
    $updated_mau_sac = $_POST['mau_sac'];
    $updated_kich_thuoc = $_POST['kich_thuoc'];

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        // Người dùng đã chọn hình ảnh mới, tiến hành upload và cập nhật đường dẫn mới
        $file = $_FILES['image'];
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_error = $file['error'];

        if ($file_error === 0) {
            // Hình ảnh hợp lệ, tiến hành upload và cập nhật đường dẫn mới
            $upload_dir = 'img/';
            $uploaded_file = $upload_dir . $file_name;

            if (move_uploaded_file($file_tmp_name, $uploaded_file)) {
                // Cập nhật đường dẫn mới vào cơ sở dữ liệu
                $update_sql = "UPDATE product SET name = '$updated_name', image = '$uploaded_file', quantity = '$updated_quantity', 
                price = '$updated_price', sale_price = '$updated_sale_price', id_hang = '$updated_id_hang', cpu = '$updated_cpu', 
                ram = '$updated_ram', o_cung = '$updated_o_cung', card_do_hoa = '$updated_card_do_hoa', trong_luong = '$updated_trong_luong', 
                mau_sac = '$updated_mau_sac', kich_thuoc = '$updated_kich_thuoc' WHERE id = '$id_product'";
                $fixed_sql = mysqli_query($conn, $update_sql);

                if ($fixed_sql) {
                    $update_success = "Đã cập nhật sản phẩm";
                    header('Location: admin.php?type=manager_product');
                    exit();
                } else {
                    $update_error = "Lỗi khi cập nhật sản phẩm";
                }
            } else {
                $update_error = "Lỗi khi upload hình ảnh";
            }
        } else {
            $update_error = "Có lỗi xảy ra khi tải lên hình ảnh";
        }
    } else {
        // Không có hình ảnh mới được chọn, chỉ cập nhật các thông tin khác
        $update_sql = "UPDATE product SET name = '$updated_name', quantity = '$updated_quantity', 
        price = '$updated_price', sale_price = '$updated_sale_price', id_hang = '$updated_id_hang', cpu = '$updated_cpu', 
        ram = '$updated_ram', o_cung = '$updated_o_cung', card_do_hoa = '$updated_card_do_hoa', trong_luong = '$updated_trong_luong', 
        mau_sac = '$updated_mau_sac', kich_thuoc = '$updated_kich_thuoc' WHERE id = '$id_product'";
        $fixed_sql = mysqli_query($conn, $update_sql);

        if ($fixed_sql) {
            $update_success = "Đã cập nhật sản phẩm";
            //header('Location: admin.php?type=manager_product');
            exit();
        } else {
            $update_error = "Lỗi khi cập nhật sản phẩm";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="icon" href="./img/logo.jpg">
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive_home.css">
</head>

<body>
    <div class="header_add_product">
        <div class="title_add_product">
            <h3>Thêm sản phẩm</h3>
        </div>
        <div class="operation_add_product">
            <button><a href="admin.php?type=manager_product">Danh sách sản phẩm</a></button>
        </div>
        <div class="frame_form_add_product">
            <form class="" action="" method="POST" role="form" enctype="multipart/form-data">
                <div class="form_add_product">
                    <div>
                        <div class="form-group">
                            <label for="">Tên sản phẩm:</label>
                            <input value="<?php echo $product['name']; ?>" type="text" class="form-control" id="" name="name" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group img_product">
                            <label for="">Ảnh sản phẩm:</label>
                            <input type="file" class="form-control" id="" name="image" placeholder="Ảnh sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Số lượng:</label>
                            <input value="<?php echo $product['quantity']; ?>" type="text" class="form-control" id="" name="quantity" placeholder="Nhập số lượng sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Tên hãng:</label>
                            <select name="id_hang" id="input" class="form-control" required="required">
                                <option value=""><?php echo $product['name_hang']; ?></option>
                                <?php foreach ($hangg as $cet) : ?>
                                    <option value="<?php echo $cet['id'] ?>"><?php echo $cet['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">CPU:</label>
                            <textarea type="text" class="form-control content_product" id="" name="cpu" placeholder="CPU của sản phẩm"><?php echo $product['cpu']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Ram:</label>
                            <textarea type="text" class="form-control content_product" id="" name="ram" placeholder="Ram của sản phẩm"><?php echo $product['ram']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Ổ cứng:</label>
                            <textarea type="text" class="form-control content_product" id="" name="o_cung" placeholder="Ổ cứng của sản phẩm"><?php echo $product['o_cung']; ?></textarea>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label for="">Card đồ họa:</label>
                            <textarea type="text" class="form-control content_product" id="" name="card_do_hoa" placeholder="Card đồ họa của sản phẩm"><?php echo $product['card_do_hoa']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Trọng lượng:</label>
                            <input value="<?php echo $product['trong_luong']; ?>" type="text" class="form-control" id="" name="trong_luong" placeholder="Trọng lượng của sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Màu sắc:</label>
                            <input value="<?php echo $product['mau_sac']; ?>" type="text" class="form-control" id="" name="mau_sac" placeholder="Màu sắc của sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Kích thước:</label>
                            <input value="<?php echo $product['kich_thuoc']; ?>" type="text" class="form-control" id="" name="kich_thuoc" placeholder="Kích thước của sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Giá sản phẩm:</label>
                            <input value="<?php echo $product['price']; ?>" type="text" class="form-control" id="" name="price" placeholder="Nhập giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Giá khuyến mãi:</label>
                            <input value="<?php echo $product['sale_price']; ?>" type="text" class="form-control" id="" name="sale_price" placeholder="Nhập giá khuyến mãi">
                        </div>
                    </div>
                </div>
                <button type="submit">Sửa sản phẩm</button>
            </form>
        </div>
    </div>
</body>

</html>