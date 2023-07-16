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
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="stylesheet" href="./Css/responsive_home.css">
</head>

<body>
    <div class="manager_frame">
        <h3>Danh sách sản phẩm</h3>
        <div class="manager_product">
            <table>
                <thead>
                    <tr>
                        <th>ID sản phẩm</th>
                        <th>Tên sản phẩm </th>
                        <th>Hãng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $pro) : ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $pro['id'] ?></td>
                            <td><?php echo $pro['name'] ?></td>
                            <td><?php echo $pro['name_hang'] ?></td>
                            <td>
                                <button class="button_fixed">Sửa</button>
                                <button>Xóa</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>