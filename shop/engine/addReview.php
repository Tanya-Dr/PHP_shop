<?php
session_start();
include "../config.php";
include "../engine/functions.php";

if($_POST['correct'] == $_POST['answer']){
    $fio = checkData($connect, $_POST['fio']);
    $text = checkData($connect, $_POST['review']);

    $res = addReview($connect, $fio, $text);
    echo $res;
}else{
    echo "Wrong answer. Please try again.";
}
?>