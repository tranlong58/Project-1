<?php
    include "header.php";
?>

<?php
    // $cartegory = new cartegory();

    if(isset($_GET['cartegory_id'])) $cartegory_id = $_GET['cartegory_id'];
    else $cartegory_id = 15;

    if(isset($_GET['users_id'])) $users_id = $_GET['users_id'];
    else $users_id = 1;

    $get_cartegory = $cartegory->get_cartegory($cartegory_id);

    if($get_cartegory){
        $res_cart = $get_cartegory->fetch_assoc();
    }

    $get_product_by_cartegory = $cartegory->get_product_by_cartegory($cartegory_id);
?>

<section class="cartegory">
    <div class="container">
        <div class="cartegory-top row">
            <p>Trang chủ</p> <span>&#10230;</span> <p><?php echo $res_cart['cartegory_name'] ?></p>
        </div>
    </div>
    <div class="container">
        <div class="cartegory-content row">
            <?php
                if($get_product_by_cartegory){
                    while($res = $get_product_by_cartegory->fetch_assoc()){
            ?>
            <a href="product.php?users_id=<?php echo $users_id ?>&product_id=<?php echo $res['product_id']?>">
                <div class="cartegory-content-item">
                    <img src="../admin/uploads/<?php echo $res['product_thumbnail'] ?>" alt="">
                    <h1> <?php echo $res['product_name'] ?></h1>
                    <p> <?php echo formatCost($res['product_cost']) ?> <sup>đ</sup></p>
                </div>
            </a>

            <?php
                    }
                }
            ?>

        </div>
    </div>
</section>

<?php
    include "footer.php";
?>
