<?php

$x = rand(1,10);
$y = rand(1,10);
$res = $x + $y;
$name = selectName($connect);
?>

<form class="form_review">
    <h3 class="form__heading">Review form</h3>
    <input type="text" id="fio" required value="<?=$name?>" placeholder="Your name" class="form_review__input" readonly>
    <textarea id="review" cols="30" rows="15" required placeholder="Your review" class="form_review__input"></textarea>
    <p>Calculate <?= $x?> + <?= $y?> = <input id="answer" style="width: 30px;" type="text" class="form_review__answer"></p>
    <input type="hidden" id="correct" value="<?= $res?>">
    <p class="form__err"></p>
    <button type="submit" class="form__button btn_review">Leave review</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/addReview.js"></script>