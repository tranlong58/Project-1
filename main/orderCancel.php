<?php
    include "header.php";
?>

<?php
    $cart = new cart();

    if(isset($_GET['users_id'])) $users_id = $_GET['users_id'];
    else $users_id = 1;

    $order_id = $_GET['order_id'];

    $order = new order();
    $get_order = $order->get_order($users_id);

    $cancel_order = $order->cancel_order($users_id, $order_id); 
?>

<section class="order">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="cart-top-item">
                    <a href="cart.php?users_id=<?php echo $users_id ?>" class="fas fa-shopping-cart"> </a>
                </div>
                <div class="cart-top-item">
                    <a href="delivery.php?users_id=<?php echo $users_id ?>" class="fas fa-map-marker-alt"></a>
                </div>
                <div class="sign cart-top-item">
                    <a href="order.php?users_id=<?php echo $users_id ?>" class="fas fa-money-check-alt"></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="order-content">
            <div class="order-content-top">
                <h1>Danh sách đơn hàng của bạn</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Tên người nhận</th>
                        <th>SĐT người nhận</th>
                        <th>Địa chỉ người nhận</th>
                        <th>Chi tiết đơn hàng</th>
                        <th>Thành tiền</th>
                        <th>Thời gian đặt hàng</th>
                        <th>Trạng thái đơn hàng</th>
                        <th>Tùy biến</th>
                    </tr>
                    
                    <?php
                        if($get_order){
                            $i=0;
                            while($res = $get_order->fetch_assoc()){
                                $i++;
                                $get_order_detail = $order->get_order_detail($users_id, $res['order_time']);
                    ?>
                    
                            <tr>
                                <td><p> <?php echo $i?> </p></td>
                                <td><p> <?php echo $res['name_receiver'] ?> </p></td>
                                <td><p> <?php echo $res['phoneNumber_receiver'] ?> </p></td>
                                <td style="width: 250px"><p> <?php echo $res['address_receiver'] ?> </p></td>
                                <td style="width: 350px; font-size: 18px;  text-align: left" class="order-detail">
                                    <?php 
                                        while($res1 = $get_order_detail->fetch_assoc()){

                                    ?>
                                        <p> <?php echo $res1['product_name'].': '.$res1['product_number'].' sản phẩm' ?> </p>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td style="width: 150px"><p> <?php echo formatCost($res['order_totalMoney']) ?> <sup>đ</sup> </p></td>
                                <td><p> <?php echo $res['order_time'] ?> </p></td>
                                <td><p> <?php echo $res['order_status'] ?> </p></td>
                                <td style="width: 100px"><a href="orderCancel.php?users_id=<?php echo $users_id ?>&order_id=<?php echo $order->get_order_id($users_id, $res['order_time']) ?>">Hủy đơn</a></td>
                            </tr>

                    <?php
                            }
                        }
                    ?>
                </table>
            </div>                 
        </div>
    </div>
</section>

<?php
    include "footer.php";
?>