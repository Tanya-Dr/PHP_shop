<?php
session_start();
include "../config.php";
include "functions.php";

$action = $_GET['action'];

if($action == "addProduct"){
    $title = checkData($connect, $_POST['title']);
    $price = (double)checkData($connect, $_POST['price']);
    $shortInfo = checkData($connect, $_POST['shortInfo']);
    $fullInfo = checkData($connect, $_POST['fullInfo']);
    $img = $_FILES['photo']['name'];
    $size = $_FILES['photo']['size'];
    $photoName = ($size != 0) ? $_FILES['photo']['name'] : "";
    $photoTmpName = ($size != 0) ? $_FILES['photo']['tmp_name'] : "";

    $res = addProduct($connect, $title, $price, $shortInfo, $fullInfo, $size, $img, $photoName, $photoTmpName);

    if($res == "success"){
        header("Location: ../index.php?page=adminGoods");
    }

}elseif($action == "edit"){
    $id = (int)$_POST['id'];
    $title = checkData($connect, $_POST['title']);
    $price = (double)checkData($connect, $_POST['price']);
    $shortInfo = checkData($connect, $_POST['shortInfo']);
    $fullInfo = checkData($connect, $_POST['fullInfo']);
    $img = $_FILES['photo']['name'];
    $size = $_FILES['photo']['size'];
    $photoName = ($size != 0) ? $_FILES['photo']['name'] : "";
    $photoTmpName = ($size != 0) ? $_FILES['photo']['tmp_name'] : "";

    $res = editProduct($connect, $id, $title, $price, $shortInfo, $fullInfo, $size, $img, $photoName, $photoTmpName);

    if($res == "success"){
        header("Location: ../index.php?page=adminGoods");
    }

}elseif($action == "deleteProduct"){
    $id = checkData($connect, $_GET['id']);

    $res = deleteProduct($connect, $id);

    if($res == "success"){
        header("Location: ../index.php?page=adminGoods");
    }
}elseif($action == "changeAccess"){
    $id =  checkData($connect, $_POST['id']);
    $admin =  checkData($connect, $_POST['admin']);
    $res = changeAccess($connect, $admin, $id);
    echo $res;
}elseif($action == "changeStatus"){
    $status = checkData($connect, $_POST['status']);
    $idOrder = checkData($connect, $_POST['idOrder']);
    $res = changeStatus($connect, $status, $idOrder);
    echo $res;
}
?>