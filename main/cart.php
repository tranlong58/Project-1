<?php
    include "header.php";
?>

<?php
    $cart = new cart();

    if(isset($_GET['users_id'])) $users_id = $_GET['users_id'];
    else $users_id = 1;

    $get_cart_by_users = $cart->get_cart_by_users($users_id);

    $total_quantity=0;
    $total_cost=0;

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $get_cart = $cart->get_cart($users_id); 
        
        while($tmp = $get_cart->fetch_assoc()){
            $cart_id = $tmp['cart_id'];
            $product_quantity = $_POST[$cart_id];
            $update_cart = $cart->update_cart($cart_id, $product_quantity);
        }

        header('Location: cart.php?users_id='.$users_id);
    }
?>

<section class="cart">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="sign cart-top-item">
                    <a href="cart.php?users_id=<?php echo $users_id ?>" class="fas fa-shopping-cart"> </a>
                </div>
                <div class="cart-top-item">
                    <a href="delivery.php?users_id=<?php echo $users_id ?>" class="fas fa-map-marker-alt"></a>
                </div>
                <div class="cart-top-item">
                    <a href="order.php?users_id=<?php echo $users_id ?>" class="fas fa-money-check-alt"></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <form action="" method="POST">
            <div class="cart-content row">
                <div class="cart-content-left">
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>

                        <?php
                            if($get_cart_by_users){
                                while($res = $get_cart_by_users->fetch_assoc()){
                                    $total_quantity += $res['product_quantity'];
                                    $total_cost += ($res['product_quantity']*$res['product_cost']);
                        ?>
                        
                        <tr>
                            <td><img src="../admin/uploads/<?php echo $res['product_thumbnail'] ?>" alt=""></td>
                            <td><p><?php echo $res['product_name'] ?></p></td>
                            <td><input type="number" name="<?php echo $res['cart_id'] ?>" value="<?php echo $res['product_quantity'] ?>" min="1"></td>
                            <td><p><?php echo formatCost($res['product_cost']) ?> <sup>đ</sup></p></td>
                            <td><a href="cartDelete.php?users_id=<?php echo $users_id ?>&product_id=<?php echo $res['product_id'] ?>"><p class="remove-button">X</p></a></td>
                        </tr>

                        <?php
                                }
                            }
                        ?>
                    </table>
                </div>

                <div class="cart-content-right">
                    <table>
                        <tr>
                            <th colspan="2">Tổng tiền giỏ hàng</th>
                        </tr>
                        <tr>
                            <td><p>Tổng sản phẩm</p></td>
                            <td><p><?php echo $total_quantity ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Tổng tiền hàng</p></td>
                            <td style="font-weight: bold"><p><?php echo formatCost($total_cost) ?> <sup>đ</sup></p></td>        
                        </tr>
                    </table>

                    <div class="cart-content-right-button">
                        <button class="update-button" type="submit">Cập nhật giỏ hàng</button>
                        <button class="payout-button"><a href="delivery.php?users_id=<?php echo $users_id ?>">Mua hàng</a></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
    include "footer.php";
?>