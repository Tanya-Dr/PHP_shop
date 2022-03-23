<?php
include "config.php";
include "engine/functions.php";

$res = profile($connect);
if($data = mysqli_fetch_assoc($res)){
    $nickname = $data['nickname'];
    $email = $data['email'];
}
?>
<div class="cart center">
    <div class="cart__left">                    
        <form class="login__form">
            <h2>Your profile</h2>
            <label for="nickname" class="profile__label">
                <span>Your name</span>
                <input id="nickname" type="text" placeholder="Name" class="login__input" value="<?= $nickname ?>" readonly>
            </label>                        
            <label for="email" class="profile__label">
                <span>Your email</span>
                <input type="email" placeholder="Email" class="login__input" required id="email" value="<?= $email ?>" readonly>
            </label>    
            <a href="index.php?page=orderHistory" class="button_cart logout__button">Your orders</a>
            <a href="engine/auth.php?action=logout" class="button_cart logout__button">LOGOUT</a>            
        </form>                     
    </div>  
</div>