<?php
    include "header.php";
    include "slider.php";
?>

<?php 
    $order = new order();
    $show_order = $order->show_order();
?>
        <div class="admin-content-right">
            <div class="admin-content-right-cartegory-list">
                <h1>Danh sách đơn hàng</h1>
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
                        if($show_order){
                            $i=0;
                            while($res = $show_order->fetch_assoc()){
                                $i++;
                                $get_order_detail = $order->get_order_detail($res['users_id'], $res['order_time']);
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
                                <td style="width: 150px"><p> <?php echo formatCost($res['order_totalMoney']) ?></p></td>
                                <td><p> <?php echo $res['order_time'] ?> </p></td>
                                <td><p> <?php echo $res['order_status'] ?> </p></td>
                                <td style="width: 100px"><a href="orderUpdate.php?users_id=<?php echo $res['users_id'] ?>&order_id=<?php echo $order->get_order_id($res['users_id'], $res['order_time']) ?>">Cập nhật trạng thái</a></td>
                            </tr>

                    <?php
                            }
                        }
                    ?>
                </table>
            </div>
            <!-- <div class="admin-content-right-cartegory-add">
                <h1>Cập nhật trạng thái đơn hàng</h1>
                <form action="" method="POST">
                    <input type="text" placeholder="Nhập trạng thái đơn hàng">
                    <button type="submit">Xác nhận</button>
                </form>
            </div> -->
        </div>
    </section>
</body>
</html>