<?php
    include "header.php";
?>

<?php
    $cart = new cart();

    if(isset($_GET['users_id'])) $users_id = $_GET['users_id'];
    else $users_id = 1;

    $get_cart_by_users = $cart->get_cart_by_users($users_id);

    $total_cost=0;

    $order = new order();

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $name_receiver = $_POST['name_receiver'];
        $phoneNumber_receiver = $_POST['phoneNumber_receiver'];
        $address_receiver = $_POST['address_receiver'];

        $order_totalMoney = 0;

        while($tmp = $get_cart_by_users->fetch_assoc()){
            $order_totalMoney += ($tmp['product_quantity']*$tmp['product_cost']);
        }

        $order_time = getdate()['year'].'-'.getdate()['mon'].'-'.getdate()['mday'].' '.getdate()['hours'].':'.getdate()['minutes'].':'.getdate()['seconds'];
        $order_status = 'Đang chờ duyệt';

        $insert_order = $order->insert_order($users_id, $name_receiver, $address_receiver, $phoneNumber_receiver, $order_totalMoney, $order_time, $order_status);
        
        $delete_cart = $cart->delete_all_cart($users_id);

        header('Location: order.php?users_id='.$users_id);
    }
?>

<section class="delivery">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="cart-top-item">
                    <a href="cart.php?users_id=<?php echo $users_id ?>" class="fas fa-shopping-cart"> </a>
                </div>
                <div class="sign cart-top-item">
                    <a href="delivery.php?users_id=<?php echo $users_id ?>" class="fas fa-map-marker-alt"></a>
                </div>
                <div class="cart-top-item">
                    <a href="order.php?users_id=<?php echo $users_id ?>" class="fas fa-money-check-alt"></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="delivery-content row">
            <div class="delivery-content-left">
                <div class="delivery-content-left-input">
                    <form action="" method="POST">
                        <p>Điền thông tin giao hàng</p>
                        <div class="delivery-content-left-input-text">
                            <input type="text" required name="name_receiver" placeholder="Nhập họ tên người nhận">
                            <input type="text" required name="phoneNumber_receiver" placeholder="Nhập số điện thoại người nhận">
                            <input type="text" required name="address_receiver" placeholder="Nhập địa chỉ người nhận">
                        </div>
                        <div class="delivery-content-left-input-button">
                            <div class="return-button"><a href="cart.php?users_id=<?php echo $users_id ?>">Trở lại trang giỏ hàng</a></div>
                            <button type="submit" class="delivery-button">Giao hàng</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="delivery-content-right">
                <table>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>

                    <?php
                        if($get_cart_by_users){
                            while($res = $get_cart_by_users->fetch_assoc()){
                                $total_cost += ($res['product_quantity']*$res['product_cost']);
                    ?>
                    
                    <tr>
                        <td><p> <?php echo $res['product_name'] ?> </p></td>
                        <td><p> <?php echo $res['product_quantity'] ?> </p></td>
                        <td><p> <?php echo formatCost($res['product_quantity']*$res['product_cost']) ?> <sup>đ</sup></p></td>
                    </tr>

                    <?php
                            }
                        }
                    ?>

                    <tr>
                        <td>Tổng</td>
                        <td></td>
                        <td><p> <?php echo formatCost($total_cost) ?> <sup>đ</sup></p></td>
                    </tr>                    
                </table>
                <p class="delivery-content-right-text">*Vui lòng thanh toán khi nhận hàng</p>
            </div>
        </div>
    </div>
</section>

<?php
    include "footer.php";
?>