<?php
include "config.php";
include "engine/functions.php";
?>
<div class="review">
    <h2>Review</h2>
    <?php
    if($_SESSION['id']){
        include "blocks/reviewForm.php";
    }
    ?>
    <hr>
    <div class="review__list">
        <?php
        include "blocks/reviewsGallery.php";
        ?>
    </div>
</div>