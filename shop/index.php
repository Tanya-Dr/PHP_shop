<?php
session_start();
if(!$_SESSION['id'] && ($_GET['page'] == 'profile')){
    header("Location: index.php?page=login");
}
if(!$_SESSION['id'] && ($_GET['page'] == 'order')){
    header("Location: index.php?page=cart");
}
if($_SESSION['id'] && (($_GET['page'] == 'login') || ($_GET['page'] == 'signup'))){
    header("Location: index.php?page=profile");
}
$adminPage = ['admin','addGood','editGood','adminGoods','users','adminOrders'];
if($_SESSION['admin'] < 1 && in_array($_GET['page'],$adminPage)){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;900&display=swap" rel="stylesheet"> 
</head>
<body>
    <div class="wrapper">
        <div class="top">
            <?php
            include "blocks/header.php";
            ?>
            <div class="content center">
                <?php
                include "blocks/content.php";
                ?>
            </div>
        </div>
        <div class="bottom">
                <?php
                include "blocks/footer.php";
                ?>
        </div>
    </div>
</body>
</html>