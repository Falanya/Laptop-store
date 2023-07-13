<?php
//Hiển thị số lượng sản phẩm theo id
function total_price($cart) {
    $total_price = 0;
    foreach($cart as $key => $values ) {
        $total_price += $values['quantity'] * $values['sale_price'];
    }
    return $total_price;
}
//Hiển thị số sản phẩm theo ô số lượng
function total_item($cart) {
    $total = 0;
    foreach($cart as $key => $values) {
        $total += $values['quantity'];
    }
    return $total;
}
?>