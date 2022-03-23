<?php
include "config.php";
include "engine/functions.php";
?>
<h2>Your orders</h2>
<div class="history"> 
    <?php
    if($_SESSION['id']){
        include "blocks/historyOrdersGallery.php";
    }
    ?>  
</div>
<a href="<?= "index.php?page=login"?>" class="item__link"><?= $_SESSION['id'] ? "PROFILE" : "LOGIN"?></a>