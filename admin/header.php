<?php
    include "database.php";
    include "class/cartegory_class.php";
    include "class/product_class.php";
    include "class/order_class.php";
    include "class/users_class.php";

    function formatCost($cost){
        $res='';
        $i=0;
        while($cost > 0){
            if($i==3){
                $i=0;
                $res=','.$res;
            }    
            $i++;
            $tmp=$cost%10;
            $res=$tmp.$res;
            $cost=($cost-$tmp)/10;
        }
        return $res;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d40d0f4de3.js" crossorigin="anonymous"></script>    
    <title>Admin page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../main/img/logo.png">
        </div>
        
        <div class="heading">
            <h1>Admin</h1>
        </div>

        <div class="other">
            <li> <a href="../main/cartegory.php?users_id=1&cartegory_id=15" class="fa-sharp fa-solid fa-user fa-2x"></a> </li>
            <!-- <li> <a href="../main/cart.php?users_id=1" class="fa fa-cart-shopping fa-2x"></a> </li> -->
            <li> <a href="../main/login.php" class="fa fa-right-to-bracket fa-2x"></a> </li>
        </div>
    </header>