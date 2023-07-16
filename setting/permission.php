<?php
//Nếu người dùng không có vai trò admin là 1 thì chuyển về home.php
if($_SESSION['user']['role'] !=1) {
    header('location: home.php');
    exit();
}

?>