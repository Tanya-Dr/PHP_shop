<?php
session_start();
include "../config.php";
include "../engine/functions.php";

$action = $_GET['action'];

if($action == "addToCart"){
    if(!$_SESSION['id']){
        echo "Login to shop";
    }else{
        $id = checkData($connect, $_POST['id']);

        $res = addToCart($connect, $id);
        echo $res;
    } 
}elseif($action == "changeCart"){
    $id = checkData($connect, $_POST['id']);
    $count = checkData($connect, $_POST['count']);

    changeCart($connect, $id, $count);
}elseif($action == "deleteFromCart"){
    $id = checkData($connect, $_POST['id']);
    
    deleteFromCart($connect, $id);
}elseif($action == "clearCart"){
    clearCart($connect);
}
?>