<?php
session_start();
include "../config.php";
include "../engine/functions.php";

$action = $_GET['action'];
$salt = "sldfjsklfdj23lfd0,.sd";

if($action == "login"){    
    $email = $_POST['email'] ? checkData($connect, $_POST['email']) : "";
    $pass = $_POST['pass'] ? checkData($connect, $_POST['pass']) : "";
    $passToCheck = $salt.md5($pass).$salt;
    
    $res = login($connect, $email, $pass, $passToCheck);
    echo $res;
}elseif($action == "signup"){
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $email = $_POST['email'] ? checkData($connect, $_POST['email']) : "";
    }else{
        echo "Incorrect email";
        exit;
    }
    
    $pass = $_POST['pass'] ? checkData($connect, $_POST['pass']) : "";
    $nickname = $_POST['nickname'] ? checkData($connect, $_POST['nickname']) : "";

    $res = signup($connect, $nickname, $email, $pass, $passToCheck);
    echo $res;
}elseif($action == "logout"){
    $_SESSION = [];
    session_destroy();
    header("Location: ../index.php?page=login");
}

?>