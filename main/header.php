<?php
    include "database.php";
    include "class/cartegory_class.php";
    include "class/product_class.php";
    include "class/cart_class.php";
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

    date_default_timezone_set('Asia/Ho_Chi_Minh'); 
?>

<?php 
    $cartegory = new cartegory();
    $show_cartegory = $cartegory->show_cartegory();

    if(isset($_GET['users_id'])) $users_id = $_GET['users_id'];
    else $users_id = 1;

    $user = new users();
    $get_user = $user->get_users_by_id($users_id);
    $res1 = $get_user->fetch_assoc();
    
    $role_id = $res1['role_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d40d0f4de3.js" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="style.css">
    <title>LStore</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/logo.png">
        </div>
        <div class="menu">
            <?php
                if($show_cartegory){
                    while($res = $show_cartegory->fetch_assoc()){
            ?>
            
            <li> <a href="cartegory.php?users_id=<?php echo $users_id ?>&cartegory_id=<?php echo $res['cartegory_id']?>"> <?php echo $res['cartegory_name'] ?> </a> </li>

            <?php
                    }
                }
            ?>
        </div>
        <div class="other">
            <?php
                if($role_id == 1) {
            ?>

            <li> <a href="../admin/cartegory.php" class="fa-sharp fa-solid fa-house fa-2x"></a> </li>
            <li> <a href="cart.php?users_id=<?php echo $users_id ?>" class="fa fa-cart-shopping fa-2x"></a> </li>
            <li> <a href="login.php" class="fa fa-right-to-bracket fa-2x"></a> </li>

            <?php
                }
                else {
            ?>

            <li> <a href="cart.php?users_id=<?php echo $users_id ?>" class="fa fa-cart-shopping fa-2x"></a> </li>
            <li> <a href="login.php" class="fa fa-right-to-bracket fa-2x"></a> </li>
            
            <?php
                }
            ?>
        </div>
    </header>