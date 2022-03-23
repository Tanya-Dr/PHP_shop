<?php
$res = selectInfoOrders($connect);

while($dataOrder = mysqli_fetch_assoc($res)):?>    
    <div>
        <p class="card__text"><span class="order__title">Order number: </span><?=$dataOrder['idOrder']?></p>
        <p class="card__text"><span class="order__title">Total sum: </span><?=$dataOrder['totalSum']?></p>
        <p class="card__text"><span class="order__title">Delivery price:</span> <?=$dataOrder['delivery']?></p>
        <p class="card__text"><span class="order__title">Delivery address:</span> <?=$dataOrder['address']?></p>
        <p class="card__text"><span class="order__title">Order status: </span><?=$dataOrder['statusOrder']?></p>
    </div>
    <div class="order">
        <div class="order__item">
            <?php
            $result = selectOrder($connect, $dataOrder['idOrder']);
            while($data = mysqli_fetch_assoc($result)):?>
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
            endwhile;
            ?>
        </div>        
    </div>
    <hr>
<?php    
endwhile;
?> 