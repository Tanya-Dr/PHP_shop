<?php
include "config.php";
include "engine/functions.php";

$res = selectAllOrders($connect);
?>
<h2>Orders</h2>
<table class="orders">
    <tr class="orders__row">
        <td class="orders__heading orders__text">ID</td>
        <td class="orders__heading orders__text">USER EMAIL</td>
        <td class="orders__heading orders__text">DATE</td>
        <td class="orders__heading orders__text">TOTAL SUM</td>
        <td class="orders__heading orders__text">DELIVERY PRICE</td>
        <td class="orders__heading orders__text">DELIVERY</td>
        <td class="orders__heading orders__text">ADDRESS</td>
        <td class="orders__heading orders__text">PHONE NUMBER</td>
        <td class="orders__heading orders__text">STATUS</td>      
    </tr> 
    <?php
    while($data = mysqli_fetch_assoc($res)):?>
        <tr class="orders__row">
            <td class="orders__text"><?= $data['id'] ?></td>
            <td class="orders__text"><?= $data['email'] ?></td>
            <td class="orders__text"><?= $data['dateOrder'] ?></td>
            <td class="orders__text"><?= $data['totalSum'] ?></td>
            <td class="orders__text"><?= $data['deliveryPrice'] ?></td>
            <td class="orders__text"><?= $data['deliveryPrice']==200 ? "Pick up" : "Courier" ?></td>
            <td class="orders__text"><?= $data['address'] ?></td>
            <td class="orders__text"><?= $data['phoneNumber'] ?></td>
            <td class="orders__text">
                <select data-id="<?= $data['id']?>" name="status" class="orders__select" onchange="changeStatus()">
                    <option <?= $data["statusOrder"] == 1 ? "selected" : "" ?> value=1>Pending payment</option>
                    <option <?= $data["statusOrder"] == 2 ? "selected" : "" ?> value=2>Processing</option>
                    <option <?= $data["statusOrder"] == 3 ? "selected" : "" ?> value=3>Shipped</option>
                    <option <?= $data["statusOrder"] == 4 ? "selected" : "" ?> value=4>Delivered</option>
                    <option <?= $data["statusOrder"] == 5 ? "selected" : "" ?> value=5>Failed</option>
                </select>
            </td>
        </tr>    
    <?php
    endwhile;
    ?> 
</table>
<p id = "statusChange"><p>
<a href="<?= $_SERVER['HTTP_REFERER']?>" class="item__link">Back</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/ordersChange.js"></script>