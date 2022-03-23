<?php        
include "config.php";   
include "engine/functions.php"; 
$action = $_GET['action'];
$id = $_GET['id'];
if($action == 'edit' && selectGood($connect, $id)){
    $res = selectGood($connect, $id);
    $data = mysqli_fetch_assoc($res);
}
?>
<h2><?=  $action == 'edit'? 'Edit goods' :'Add goods' ?></h2>
<div class="content__form">
    <form action="engine/adminAction.php?action=<?=$action?>" method="post" enctype="multipart/form-data"class="form">
        <label for="file-title" class="form__label">
            <span>Goods title</span>
            <input type="text" name="title" id="file-title" class="form__input" value="<?= $action == 'edit'? $data['title']:''?>" required placeholder="title">
        </label>     
        <label for="file-price" class="form__label">
            <span>Goods price</span>
            <input type="number" step="any" name="price" id="file-price" class="form__input" value="<?= $action == 'edit'? $data['price']:''?>" required placeholder="price">
        </label>  
        <label for="file-shortInfo" class="form__label">
            <span>Short description of goods</span>
            <textarea name="shortInfo" id="file-shortInfo" class="form__input form__textarea" required placeholder="shortInfo"><?= $action == 'edit'? $data['shortInfo']:''?></textarea>
        </label>       
        <label for="file-fullInfo" class="form__label">
            <span>Full description of goods</span>
            <textarea name="fullInfo" rows = "10" id="file-fullInfo" class="form__input  form__textarea" required placeholder="fullInfo"><?= $action == 'edit'? $data['fullInfo']:''?></textarea>
        </label>       
        <label class="form__input form__input_file" for="file-upload">
            <svg class="input__attach" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path class="path_2" d="M16.5 6v11.5c0 2.21-1.79 4-4 4s-4-1.79-4-4V5c0-1.38 1.12-2.5 2.5-2.5s2.5 1.12 2.5 2.5v10.5c0 .55-.45 1-1 1s-1-.45-1-1V6H10v9.5c0 1.38 1.12 2.5 2.5 2.5s2.5-1.12 2.5-2.5V5c0-2.21-1.79-4-4-4S7 2.79 7 5v12.5c0 3.04 2.46 5.5 5.5 5.5s5.5-2.46 5.5-5.5V6h-1.5z"fill="#4a4a4a"/></svg>
            <span class="input_photo">Add photo</span>
        </label>    
        <input type="file" name="photo" id="file-upload" accept="image/*" >
        <input type="hidden" name="id" value="<?=$action == 'edit'? $data['id']:''?>">
        <input type="submit" value="Save" class="form__button">
        <a href="<?= $_SERVER['HTTP_REFERER']?>" class="item__link">Back</a>
    </form> 
    <?php
    if($action == 'edit'){?>
    <img src="images/big_photo/<?= $data['img']?>" class="form__photo">
    <?php
    }
    ?>
</div>
<script src="js/editGood.js"></script>