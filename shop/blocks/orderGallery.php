<?php
include "config.php";
include "engine/functions.php";

$res = selectCart($connect);
$totalSum = 0;

if(mysqli_num_rows($res) == 0):?>
    <h1 class="cart__left_heading">Your cart is empty</h1>
<?php
$blockForm = true;
endif;
while($data = mysqli_fetch_assoc($res)):?>    
    <div class="card order__card">
        <a href="index.php?page=product&id=<?= $data['idGood']?>" class="card__link_img">
            <img src="images/small_photo/<?= $data['img']?>" alt="<?= $data['title']?>" class="card__img">
        </a>                    
        <div class="card__description order__description">
            <div class="card__link_text">
                <a href="index.php?page=product&id=<?= $data['idGood']?>" class="card__name order__name"><?= ucfirst($data['title'])?></a>
            </div>
            <div class="card__content order__content">
                <p class="card__text">Price: <span class="card__text_select"><?= $data['price'] * $data['quantity']?></span></p>
                <p class="card__text">Color: <span class="card__text_select">Red</span></p>
                <p class="card__text">Size: <span class="card__text_select">XL</span></p>
                <div class="card__quantity">
                    <p class="card__text">Quantity: <span class="card__text_select"><?= $data['quantity']?></span></p>
                </div>                            
            </div>                        
        </div>
    </div>
<?php
    $totalSum += $data['price'] * $data['quantity'];
endwhile;
?> 