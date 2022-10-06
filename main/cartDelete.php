<?php
    include "header.php";
?>

<?php
    $cart = new cart();

    if(isset($_GET['users_id'])) $users_id = $_GET['users_id'];
    else $users_id = 1;

    $product_id = $_GET['product_id'];

    $get_cart_by_users = $cart->get_cart_by_users($users_id);

    $total_quantity=0;
    $total_cost=0;

    $delete_cart = $cart->delete_cart($users_id, $product_id); 
?>

<section class="cart">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="sign cart-top-item">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="cart-top-item">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="cart-top-item">
                    <i class="fas fa-money-check-alt"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
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
                        <td><input type="number" value="<?php echo $res['product_quantity'] ?>" min="1"></td>
                        <td><p><?php echo $res['product_cost'] ?> <sup>đ</sup></p></td>
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
                        <td style="font-weight: bold"><p><?php echo $total_cost ?> <sup>đ</sup></p></td>        
                    </tr>
                </table>

                <div class="cart-content-right-button">
                    <button class="update-button"><a href="">Cập nhật giỏ hàng</a></button>
                    <button class="payout-button"><a href="delivery.php?users_id=<?php echo $users_id ?>">Mua hàng</a></button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include "footer.php";
?>