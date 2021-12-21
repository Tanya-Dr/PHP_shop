<h2>Admin</h2>
<div class="admin__content">
    <a class="item__link" href="index.php?page=adminGoods">Change goods</a> 
    <a class="item__link" href="index.php?page=adminOrders">Change orders status</a> 
    <?php
    if($_SESSION['admin'] == 2):?>
    <a class="item__link" href="index.php?page=users">Change access to users</a>
    <?php
    endif;    
    ?>
</div>
