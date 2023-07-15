<?php
//include './setting/connect.php';

$sql = "SELECT id,name,image,price,sale_price,id_hang,cpu,ram,o_cung,card_do_hoa,trong_luong,mau_sac,kich_thuoc FROM product Order By id DESC";

$result = mysqli_query($conn, $sql);
$hangg = mysqli_query($conn, "SELECT * FROM hang");
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $cpu = $_POST['cpu'];
    $ram = $_POST['ram'];
    $o_cung = $_POST['o_cung'];
    $card_do_hoa = $_POST['card_do_hoa'];
    $trong_luong = $_POST['trong_luong'];
    $mau_sac = $_POST['mau_sac'];
    $kich_thuoc = $_POST['kich_thuoc'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $id_hang = $_POST['id_hang'];

    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $file_name = $file['name'];
        move_uploaded_file($file['tmp_name'], 'img/' . $file_name);
    }
    $sqlss = "INSERT INTO product(name,image,id_hang,cpu,ram,o_cung,card_do_hoa,trong_luong,mau_sac,kich_thuoc,price,sale_price) VALUES ('$name','$file_name','$id_hang','$cpu','$ram','$o_cung','$card_do_hoa','$trong_luong','$mau_sac','$kich_thuoc','$price','$sale_price')";
    $query = mysqli_query($conn, $sqlss);
    if ($query) {
        header('location: product.php');
    } else {
        echo "Lỗi";
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
    <link rel="stylesheet" href="./Css/product.css">
    <link rel="stylesheet" href="./Css/responsive.css">
</head>

<body>
    <div class="header">
        <div class="header_product_frame">
            <div class="home">
                <a href="./home.php"><img src="./img/logo.jpg" alt="Home"></a>
            </div>
            <div class="add_product" style="background-color: black;">
                <h3><a href="./add_product.php">Thêm sản phẩm</a></h3>
            </div>
            <div class="product">
                <h3><a href="./product.php">Danh sách</a></h3>
            </div>
            <div class="fixed_product">
                <h3><a href="./fixed_product.php">Sửa sản phẩm</a></h3>
            </div>
        </div>
    </div>
    <div class="title_product">
        <h3>Thêm sản phẩm</h3>
        <div class="add_product_frame">
            <form action="" method="POST" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Tên sản phẩm:</label>
                    <input type="text" class="form-control" id="" name="name" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Ảnh sản phẩm:</label>
                    <input style="width:43.3%; background-color:antiquewhite; cursor: pointer;" type="file" class="form-control" id="" name="image" placeholder="Ảnh sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Tên hãng:</label>
                    <select name="id_hang" id="input" class="form-control" required="required">
                        <option value="">Chọn hãng đi nè :3</option>
                        <?php foreach ($hangg as $cet) : ?>
                            <option value="<?php echo $cet['id'] ?>"><?php echo $cet['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">CPU:</label>
                    <input type="text" class="form-control" id="" name="cpu" placeholder="CPU của sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Ram:</label>
                    <input type="text" class="form-control" id="" name="ram" placeholder="Ram của sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Ổ cứng:</label>
                    <input type="text" class="form-control" id="" name="o_cung" placeholder="Ổ cứng của sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Card đồ họa:</label>
                    <input type="text" class="form-control" id="" name="card_do_hoa" placeholder="Card đồ họa của sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Trọng lượng:</label>
                    <input type="text" class="form-control" id="" name="trong_luong" placeholder="Trọng lượng của sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Màu sắc:</label>
                    <input type="text" class="form-control" id="" name="mau_sac" placeholder="Màu sắc của sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Kích thước:</label>
                    <input type="text" class="form-control" id="" name="kich_thuoc" placeholder="Kích thước của sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Giá sản phẩm:</label>
                    <input type="text" class="form-control" id="" name="price" placeholder="Nhập giá sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Giá khuyến mãi:</label>
                    <input type="text" class="form-control" id="" name="sale_price" placeholder="Nhập giá khuyến mãi">
                </div>
                <button type="submit">Thêm sản phẩm</button>
            </form>
        </div>
    </div>
    <div class="unknown"></div>
</body>

</html>