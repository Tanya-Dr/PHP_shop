<?php
switch($_GET['page']){
    case 'review':
        include "pages/review.php";
        break;
    case 'admin':
        include "pages/admin/admin.php";
        break;
    case 'login':
        include "pages/login.php";
        break;
    case 'signup':
        include "pages/signup.php";
        break;
    case 'profile':
        include "pages/profile.php";
        break;
    case 'cart':
        include "pages/cart.php";
        break;
    case 'product':
        include "pages/product.php";
        break;
    case 'addGood':
        include "pages/admin/editGood.php";
        break;
    case 'editGood':
        include "pages/admin/editGood.php";
        break;
    case 'adminGoods':
        include "pages/admin/adminGoods.php";
        break;
    case 'adminOrders':
        include "pages/admin/adminOrders.php";
        break;
    case 'users':
        include "pages/admin/users.php";
        break;
    case 'order':
        include "pages/order.php";
        break;
    case 'orderHistory':
        include "pages/orderHistory.php";
        break;
    default:
        include "pages/gallery.php";
}
?>