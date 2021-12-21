<?php
include "config.php";
include "engine/functions.php";

$res = selectAll($connect, 'users');
?>
<h2>Users</h2>
<div class="users">
    <div class="users__row">
        <p class="users__text users__heading">EMAIL</p>
        <p class="users__text users__heading">NAME</p>
        <p class="users__text users__text_last users__heading">ADMIN</p>
    </div> 
    <?php
    while($data = mysqli_fetch_assoc($res)):?>
        <div class="users__row">
            <p class="users__text"><?= $data['email'] ?></p>
            <p class="users__text"><?= $data['nickname'] ?></p>
            <div class="users__text users__text_last">
                <input class="card__number" type="number" data-id="<?= $data['id']?>" value = <?= $data['admin'] ?> min="0" max="2" onchange="changeAccess()">
            </div>
        </div>    
    <?php
    endwhile;
    ?> 
</div>
<p id = "userChange"><p>
<a href="<?= $_SERVER['HTTP_REFERER']?>" class="item__link">Back</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/users.js"></script>