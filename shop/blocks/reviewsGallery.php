<?php
$res = selectReviews($connect);

while($data = mysqli_fetch_assoc($res)):?>
    <div class="review__item">
        <h3 class="review__header"><?= $data['name']?></h3>
        <p class="review__text"><?= $data['text']?></p>
        <p class="review__date"><?= $data['date']?></p>
    </div>    
<?php
endwhile;
?>