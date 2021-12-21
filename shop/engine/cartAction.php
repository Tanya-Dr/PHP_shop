<?php
session_start();
include "../config.php";
include "../engine/functions.php";

$action = $_GET['action'];

if($action == "addToCart"){
    if(!$_SESSION['id']){
        echo "Login to shop";
    }else{
        $id = $_POST['id'];

        $res = addToCart($connect, $id);
        echo $res;
    } 
}elseif($action == "changeCart"){
    $id = $_POST['id'];
    $count = $_POST['count'];

    changeCart($connect, $id, $count);
}elseif($action == "deleteFromCart"){
    $id = $_POST['id'];
    
    deleteFromCart($connect, $id);
}elseif($action == "clearCart"){
    clearCart($connect);
}
?>