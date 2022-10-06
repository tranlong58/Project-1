<?php
    include "header.php";
?>

<?php
    $product = new product();

    if(isset($_GET['product_id'])) $product_id = $_GET['product_id'];
    else $product_id = 15;

    if(isset($_GET['users_id'])) $users_id = $_GET['users_id'];
    else $users_id = 1;

    $get_product = $product->get_product($product_id);

    if($get_product){
        $res = $get_product->fetch_assoc();
    }

    $cart = new cart();

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $product_id = $res['product_id'];
        $product_quantity = $_POST['product_quantity'];
        $insert_cart = $cart->insert_cart($users_id, $product_id, $product_quantity);
    }
?>

<section class="product">
    <div class="container">
        <div class="product-top row">
            <p>Trang chủ</p> <span>&#10230;</span> <p> <?php echo $res['cartegory_name'] ?> </p> <span>&#10230;</span> <p> <?php echo $res['product_name'] ?> </p>
        </div>
    </div>

    <div class="container">
        <div class="product-content row">
            <div class="product-content-left">
                <img src="../admin/uploads/<?php echo $res['product_thumbnail'] ?>" alt="">
            </div>

            <div class="product-content-right">
                <div class="product-name">
                    <h1> <?php echo $res['product_name'] ?> </h1>
                    <p>Mã sản phẩm: <?php echo $res['product_id'] ?></p>
                </div>
                <div class="product-cost">
                    <p><?php echo formatCost($res['product_cost']) ?> <sup>đ</sup> </p>
                </div>
                <div class="product-count">
                    <p>Kho: <?php echo $res['product_count'] ?></p>
                </div>
                <div class="product-desc">
                    <p>Mô tả sản phẩm: <?php echo $res['product_desc'] ?></p>
                </div>

                <div class="product-quantity">
                    <b>Số lượng:</b>
                    <form action="" method="POST">
                        <input type="number" min="0" value="1" name="product_quantity">
                        <button type="submit"> <i class="fa fa-cart-plus fa-2x"></i> <p>Thêm vào giỏ hàng</p> </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include "footer.php";
?>