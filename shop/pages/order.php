<?php
if(!$_SESSION['id']):?>
    <h1 class="cart__left_heading">Login to shop</h1>
    <a href="index.php?page=login" class="item__link">LOGIN</a>
<?php
exit;
endif;
?>
<h2>Your order</h2>
<div class="cart">
    <div class="order__item">
        <?php
        include "blocks/orderGallery.php";
        ?>
    </div>
    <div class="cart__right">        
        <?php
        include "blocks/orderForm.php";
        ?>                 
    </div>
</div>