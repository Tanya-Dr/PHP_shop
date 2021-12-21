<?php
include "config.php";
include "engine/functions.php";

$res = selectAll($connect,'goods');
while($data = mysqli_fetch_assoc($res)):?>
    <div class="good">
        <a href="index.php?page=product&id=<?= $data['id']?>" class="product__link">
            <img src="images/small_photo/<?= $data['img']?>" class="product__img" alt="<?= $data['title']?>">
        </a>
        <div class="good__content">
            <p class="good__name">
                <span>Title: </span>
                <?= ucfirst($data['title'])?>
            </p>
            <p class="good__price">
                <span>Price: </span>
                <?= number_format($data['price'],2, '.', '')?>
            </p>
            <p class="good__text">
                <span>Short Info: </span><br>
                <?= $data['shortInfo']?>
            </p>
            <p class="good__text">
                <span>Full Info: </span><br>
                <?= $data['fullInfo']?>
            </p>            
        </div>
        <div class="good__btnGroup">
            <a class="item__btn good__btn" href="engine/adminAction.php?action=deleteProduct&id=<?= $data['id']?>">Delete</a>
            <a class="item__btn good__btn" href="index.php?page=editGood&action=edit&id=<?= $data['id']?>">Edit</a>
        </div>        
    </div>    
<?php
endwhile;
?> 