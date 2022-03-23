<?php
if(!$_SESSION['id']):?>
    <h1 class="cart__left_heading">Login to shop</h1>
    <a href="index.php?page=login" class="item__link">LOGIN</a>
<?php
exit;
endif;
?>
<h2>Your cart</h2>
<div class="cart">
    <div class="cart__left">
        <div class="cart__item">
            <?php
            include "blocks/cartGallery.php";
            ?>
        </div>
        <div class="cart__click">
            <a onclick="clearCart()" class="button_cart">clear shopping cart</a> 
            <a href="index.php" class="button_cart ">continue shopping</a>
        </div>
    </div>

    <div class="cart__right">        
        <div class="cart__price">
            <h3 class="cart__heading">TOTAL&emsp;&nbsp;<span class="cart__heading_select"><?=$totalSum?></span></h3>
            <div class="cart__line"></div>
            <a href="index.php?page=order" class="button_cart button_check">PROCEED TO CHECKOUT</a>
        </div>                    
    </div>        
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/cartAction.js"></script>