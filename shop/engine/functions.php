<?php
session_start();
include "../config.php";

function checkData($connect, $str){
    return mysqli_real_escape_string($connect,(string)htmlspecialchars(strip_tags($str)));
}

function resize($file, $pathSmallPhoto){ 
    $info = getimagesize($file);
    // Ограничение по ширине в пикселях
    $max_width_size = 200;
    $max_height_size = 233;
    // Cоздаём исходное изображение на основе исходного файла
    if ($info['mime'] == 'image/jpeg')
        $source = imagecreatefromjpeg($file);
    elseif ($info['mime'] == 'image/png')
        $source = imagecreatefrompng($file);
    elseif ($info['mime'] == 'image/gif')
        $source = imagecreatefromgif($file);
    else
        return false;

    // Определяем ширину и высоту изображения
    $w_src = imagesx($source); 
    $h_src = imagesy($source);

    //  Если большое изображение устанавливаем ограничение по ширине.
    $w = $max_width_size;

    // Если ширина больше заданной
    if ($w_src > $w)
    {
        // Вычисление пропорций
        $ratio = $w_src/$w;
        $w_dest = @round($w_src/$ratio);
        $h_dest = min(@round($h_src/$ratio),$max_height_size);

        // Создаём пустую картинку
        $dest = @imagecreatetruecolor($w_dest, $h_dest);

        // Копируем старое изображение в новое с изменением параметров
        @imagecopyresampled($dest, $source, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

        // Вывод картинки и очистка памяти
        @imagejpeg($dest, $pathSmallPhoto, 90);

        @imagedestroy($dest);
        @imagedestroy($source);

        return $pathSmallPhoto;

    } else {
        // Вывод картинки и очистка памяти
        @imagejpeg($source, $pathSmallPhoto, 90);
        @imagedestroy($source);

        return $pathSmallPhoto;
    }
}

function selectAll($connect, $table){
    $sql = "SELECT * FROM $table";
    if($res = mysqli_query($connect,$sql)){        
        return $res;
    }else{
        return "error";
    }
}

function selectGood($connect, $id){
    $sql = "SELECT * FROM goods WHERE id=$id";
    if($res = mysqli_query($connect,$sql)){        
        return $res;
    }else{
        return "error";
    }
}

function selectCart($connect){
    $sql = "SELECT * FROM cart JOIN goods ON cart.idGood = goods.id WHERE cart.idUser={$_SESSION['id']} AND cart.idOrder = 0";
    if($res = mysqli_query($connect,$sql)){        
        return $res;
    }
}

function selectInfoOrders($connect){
    $sql = "SELECT DISTINCT cart.idOrder AS idOrder, orderStatus.status AS statusOrder, orders.totalSum AS totalSum, orders.deliveryPrice AS delivery, orders.address AS address FROM cart JOIN orders ON cart.idOrder = orders.id JOIN orderStatus ON orders.statusOrder = orderStatus.id WHERE cart.idUser={$_SESSION['id']} AND cart.idOrder > 0 ORDER BY cart.date DESC";
    if($res = mysqli_query($connect,$sql)){        
        return $res;
    }
}

function selectOrder($connect, $idOrder){
    $sql = "SELECT * FROM cart JOIN goods ON cart.idGood = goods.id WHERE cart.idUser={$_SESSION['id']} AND cart.idOrder = $idOrder";
    if($res = mysqli_query($connect,$sql)){        
        return $res;
    }
}

function selectAllOrders($connect){
    $sql = "SELECT orders.*, orderStatus.status, users.email FROM orders JOIN orderStatus ON orders.statusOrder = orderStatus.id JOIN users ON orders.idUser = users.id ORDER BY orders.dateOrder DESC";
    if($res = mysqli_query($connect,$sql)){        
        return $res;
    }
}

function selectName($connect){
    $sql = "SELECT nickname FROM users WHERE id = {$_SESSION['id']}";
    $result = mysqli_query($connect,$sql);
    if($result){
        return mysqli_fetch_assoc($result)['nickname'];
    }
}

function selectReviews($connect){
    $sql = "SELECT * FROM reviews ORDER BY 'date' DESC";
    if($res = mysqli_query($connect,$sql)){        
        return $res;
    }
}

function selectAllGoods($connect){
    $sql = "SELECT * FROM goods ORDER BY countView desc";
    if($res = mysqli_query($connect,$sql)){
        return $res;
    }
}

function updateGoods($connect, $id){
    $sqlUpdate = "UPDATE goods SET countView = countView + 1 WHERE id=$id";
    if(mysqli_query($connect,$sqlUpdate)){
        $sql = "SELECT * FROM goods WHERE id=$id";
        return mysqli_query($connect,$sql);
    }
}

function addProduct($connect, $title, $price, $shortInfo, $fullInfo, $size, $img, $photoName, $photoTmpName){
    if($size != 0){
        $sqlAdd = "INSERT INTO goods (title, price, shortInfo, fullInfo, img) VALUES ('$title', $price, '$shortInfo', '$fullInfo', '$img')";
        if(mysqli_query($connect,$sqlAdd)){
            $pathSmallPhoto = $_SERVER['DOCUMENT_ROOT']."/shop/images/small_photo/".$photoName;
            $pathBigPhoto = $_SERVER['DOCUMENT_ROOT']."/shop/images/big_photo/".$photoName;
            if(resize($photoTmpName,$pathSmallPhoto) && move_uploaded_file($photoTmpName,$pathBigPhoto)){
                return "success";
            }
        }        
    }else{
        $sqlAdd = "INSERT INTO goods (title, price, shortInfo, fullInfo) VALUES ('$title', $price, '$shortInfo', '$fullInfo')";
        if(mysqli_query($connect,$sqlAdd)){
            return "success";
        }
    }
}

function editProduct($connect, $id, $title, $price, $shortInfo, $fullInfo, $size, $img, $photoName, $photoTmpName){
    $sqlUpdate = "UPDATE goods SET title = '$title', price = $price, shortInfo = '$shortInfo', fullInfo = '$fullInfo'" .($size != 0 ? ", img = '$img'" : "") . " WHERE id=$id";  
    if($size != 0){
        $sqlUpdate = "UPDATE goods SET title = '$title', price = $price, shortInfo = '$shortInfo', fullInfo = '$fullInfo', img = '$img' WHERE id=$id";  
        if(mysqli_query($connect,$sqlUpdate)){
            $pathSmallPhoto = $_SERVER['DOCUMENT_ROOT']."/shop/images/small_photo/".$photoName;
            $pathBigPhoto = $_SERVER['DOCUMENT_ROOT']."/shop/images/big_photo/".$photoName;
            if(resize($photoTmpName,$pathSmallPhoto) && move_uploaded_file($photoTmpName,$pathBigPhoto)){
                return "success";
            }
        }        
    }else{
        $sqlUpdate = "UPDATE goods SET title = '$title', price = $price, shortInfo = '$shortInfo', fullInfo = '$fullInfo' WHERE id=$id"; 
        if(mysqli_query($connect,$sqlUpdate)){
            return "success";
        }
    }
}

function deleteProduct($connect, $id){
    $sql = "SELECT * FROM goods WHERE id=$id";
    $res = mysqli_query($connect,$sql);
    $img = mysqli_fetch_assoc($res)['img'];
    $pathSmallPhoto = $_SERVER['DOCUMENT_ROOT']."/shop/images/small_photo/".$img;
    $pathBigPhoto = $_SERVER['DOCUMENT_ROOT']."/shop/images/big_photo/".$img;
    $sqlDel = "DELETE FROM goods WHERE id=$id";
    if(mysqli_query($connect,$sqlDel)){
        if(unlink($pathSmallPhoto) && unlink($pathBigPhoto)){
            return "success";
        }            
    }
}

function addReview($connect, $name, $text){
    $date = date("Y-m-d H:i:s");
    $sqlAdd = "INSERT INTO reviews (name, text, date) VALUES ('$name', '$text', '$date')"; 
    if(mysqli_query($connect,$sqlAdd)){
        return "good";
    }else{
        return "error";
    }
}

function login($connect, $email, $pass, $passToCheck){
    $sql = "SELECT * FROM users WHERE email='$email' AND pass='$passToCheck'";
    $res = mysqli_query($connect,$sql);
    if(mysqli_num_rows($res)){
        $data = mysqli_fetch_assoc($res);
        $_SESSION['id'] = $data['id']; 
        $_SESSION['admin'] = $data['admin'];    
        return "good";
    }else{
        $sql = "SELECT * FROM users WHERE email='$email'";
        $res = mysqli_query($connect,$sql);
        if(mysqli_num_rows($res)){
            return "Incorrect password.";
        }else {
            return "Authorisation Error.";
        }        
    }
}

function signup($connect, $nickname, $email, $pass, $passToCheck){
    $sqlSearch= "SELECT id FROM users WHERE email='$email'";
    $resSearch = mysqli_query($connect,$sqlSearch);
    if(mysqli_num_rows($resSearch)){    
        return "This email is already registered";
    }
    $passToCheck = $salt.md5($pass).$salt;
    $sqlInsert = "INSERT INTO users (nickname, email, pass, admin) VALUES('$nickname','$email','$passToCheck',0)";
    $res = mysqli_query($connect,$sqlInsert);
    $sql = "SELECT * FROM users WHERE email='$email' AND pass='$passToCheck'";
    $result = mysqli_query($connect,$sql);
    if($data = mysqli_fetch_assoc($result)){
        $_SESSION['id'] = $data['id'];
        $_SESSION['admin'] = $data['admin'];  
        return "good";
    }else {
        return "Registration error.";
    }
}

function profile($connect){
    $sql = "SELECT * FROM users WHERE id='{$_SESSION['id']}'";
    if($res = mysqli_query($connect,$sql)){
        return $res;
    }
}

function addToCart($connect, $id){
    $sql = "SELECT * FROM cart WHERE idGood=$id AND idUser = {$_SESSION['id']} AND idOrder=0";
    $result = mysqli_query($connect,$sql);
    if(mysqli_num_rows($result) == 0){
        $date = date("Y-m-d H:i:s");
        $sqlAddToCart = "INSERT INTO cart (idGood,quantity,idUser,date,idOrder) VALUES ('$id',1,{$_SESSION['id']},'$date',0)";
        mysqli_query($connect,$sqlAddToCart);        
    }else{
        $query = "UPDATE cart SET quantity = quantity + 1 WHERE idGood=$id AND idUser = {$_SESSION['id']} AND idOrder=0";
        mysqli_query($connect,$query);
    } 
    return "Product added to cart";
}

function changeCart($connect, $id, $count){
    if($count>0){
        $sql= "UPDATE cart SET quantity = $count WHERE idGood = $id AND idUser = {$_SESSION['id']} AND idOrder=0";
    }else{
        $sql = "DELETE FROM cart WHERE idGood = $id AND idUser = {$_SESSION['id']} AND idOrder=0";
    }
    mysqli_query($connect,$sql);
}

function deleteFromCart($connect, $id){
    $sqlDel = "DELETE FROM cart WHERE idGood=$id AND idUser = {$_SESSION['id']} AND idOrder=0";
    mysqli_query($connect,$sqlDel);
}

function clearCart($connect){
    $sqlDel = "DELETE FROM cart WHERE idUser = {$_SESSION['id']} AND idOrder=0";mysqli_query($connect,$sqlDel);
}

function changeAccess($connect, $admin, $id){
    $sqlUpdate = "UPDATE users SET admin = $admin WHERE id = $id";
    if(mysqli_query($connect,$sqlUpdate)){
        return "Data updated successfully";
    }else{
        return "error";
    }
}

function changeStatus($connect, $status, $idOrder){
    $sqlUpdate = "UPDATE orders SET statusOrder = $status WHERE id = $idOrder";
    if(mysqli_query($connect,$sqlUpdate)){
        return "Data updated successfully";
    }else{
        return "error";
    }
}

function createOrder($connect, $total, $text, $delivery, $address, $tel){
    $date = date("Y-m-d H:i:s");
    $id = $_SESSION['id'];
    $sqlAdd = "INSERT INTO orders (statusOrder, dateOrder, totalSum, deliveryPrice, address, phoneNumber, idUser) VALUES (1, '$date', $total, $delivery, '$address', '$tel', $id)"; 
    if(mysqli_query($connect,$sqlAdd)){
        $sql = "SELECT id FROM orders WHERE dateOrder='$date' AND idUser = $id";
        $res = mysqli_query($connect,$sql);
        $data = mysqli_fetch_assoc($res);
        $sqlUpdate = "UPDATE cart SET idOrder = {$data['id']} WHERE idUser = {$_SESSION['id']} AND idOrder=0";
        if(mysqli_query($connect,$sqlUpdate)){
            return "good";
        }        
    }
    return "error";
}
?>