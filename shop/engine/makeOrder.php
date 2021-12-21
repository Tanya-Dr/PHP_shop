<?php
session_start();
include "../config.php";
include "../engine/functions.php";

$address = checkData($connect, $_POST['address']);
$tel = checkData($connect, $_POST['tel']);
$delivery = checkData($connect, $_POST['delivery']);
$total = checkData($connect, $_POST['total']);

$res = createOrder($connect, $total, $text, $delivery, $address, $tel);
echo $res;
?>