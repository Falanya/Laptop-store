<?php
include './setting/connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$action = (isset($_GET['action'])) ? $_GET['action'] : 'add';

$quantity = (isset($_GET['quantity'])) ? $_GET['quantity'] : 1;

if($quantity <= 0){
    $quantity = 1;
}
//session_destroy();
//echo $action;
//die();
//die();
// var_dump($action);
// die();

$query = mysqli_query($conn, "SELECT * FROM product WHERE id= $id");

if ($query) {
    $product = mysqli_fetch_assoc($query);
}

$item = [
    'id' => $product['id'],
    'name' => $product['name'],
    'image' => $product['image'],
    //'price' => $product['price'],
    'sale_price' => $product['sale_price'],
    'quantity' => $quantity,
];

if ($action == 'add') {
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$id] = $item;
    }
}
if($action == 'update'){
    $_SESSION['cart'][$id]['quantity'] = $quantity;
}
if($action == 'delete'){
    unset($_SESSION['cart'][$id]);
}

$duongdan = ($action == 'delete') ? 'view-cart.php' : $_SERVER['HTTP_REFERER'];
header("location: $duongdan");
exit;
//echo "<pre>";
//print_r($_SESSION['cart']);

//Thêm mới vào giỏ hàng

//Cập nhật giỏ hàng

//Xóa sản phẩm khỏi giỏ hàng
?>