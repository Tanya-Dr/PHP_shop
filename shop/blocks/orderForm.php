<form class="order__form">
    <h3 class="form__heading">ORDER DETAILS</h3>
    <input type="text" placeholder="Address" class="login__input" required id="address">
    <input type="tel" class="login__input" required id="tel" placeholder="+7 (900) 123-45-67" pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}">
    <p class="form__heading">Delivery:</p>
    <div class="order__delivery">
        <label class="order__radio">
            <input class="order__input" type="radio" name="delivery" checked value=200>
            <span class="order__span"></span> Pickup (price: 200)
        </label>
        <label class="order__radio">
            <input class="order__input" type="radio" name="delivery" value=300>
            <span class="order__span"></span> Courier (price: 300)
        </label>
    </div>   
    <input type="hidden" id="total" value="<?= $totalSum?>">
    <h3 class="cart__heading">TOTAL&emsp;&nbsp;<span class="cart__heading_select order__total"></span></h3> 
    <p class="form__err"></p>
    <?php
    if(!$blockForm):?>
        <button class="login__button" type="submit">
        CHECKOUT
        </button>
    <?php
    endif;
    ?>    
    <a href="index.php?page=cart" class="item__link">BACK TO CART</a>
</form> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/order.js"></script>