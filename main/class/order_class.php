<?php
    class order {
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function insert_order($users_id, $name_receiver, $address_receiver, $phoneNumber_receiver, $order_totalMoney, $order_time, $order_status){
            $query = "INSERT INTO tbl_order(
                users_id,
                name_receiver,
                address_receiver,
                phoneNumber_receiver,
                order_totalMoney,
                order_time,
                order_status
                ) 
                VALUES (
                '$users_id',
                '$name_receiver',
                '$address_receiver',
                '$phoneNumber_receiver',
                '$order_totalMoney',
                '$order_time',
                '$order_status'
                )";
            $result = $this->db->insert($query);

            $query2 = "SELECT * FROM tbl_order WHERE users_id = '$users_id' AND order_time = '$order_time'";
            $res2 = $this->db->select($query2);

            $tmp2 = $res2->fetch_assoc();
            $order_id = $tmp2['order_id'];

            $cart = new cart();
            $get_cart_by_users = $cart->get_cart_by_users($users_id);
            while($tmp1 = $get_cart_by_users->fetch_assoc()){
                $product_id = $tmp1['product_id'];
                $product_number = $tmp1['product_quantity'];

                $query1 = "INSERT INTO tbl_order_detail(order_id, product_id, product_number) VALUES ('$order_id', '$product_id', '$product_number')";
                $res1 = $this->db->insert($query1);
            }

            return $result;
        }

        public function get_order($users_id){
            $query = "SELECT * FROM tbl_order WHERE users_id = '$users_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_order_detail($users_id, $order_time){
            $query = "SELECT * FROM tbl_order WHERE users_id = '$users_id' AND order_time = '$order_time'";
            $res = $this->db->select($query);

            $tmp = $res->fetch_assoc();
            $order_id = $tmp['order_id'];

            $query2 = "SELECT * FROM tbl_order_detail, tbl_product WHERE tbl_order_detail.product_id = tbl_product.product_id AND order_id = '$order_id'";
            $result = $this->db->select($query2);
            return $result;
        }

        public function get_order_id($users_id, $order_time){
            $query = "SELECT * FROM tbl_order WHERE users_id = '$users_id' AND order_time = '$order_time'";
            $res = $this->db->select($query);

            $tmp = $res->fetch_assoc();
            $result = $tmp['order_id'];
            return $result;
        }

        public function cancel_order($users_id, $order_id){
            $query = "UPDATE tbl_order SET order_status = 'Đã hủy' WHERE order_id = '$order_id'";
            $result = $this->db->update($query);
            header('Location: order.php?users_id='.$users_id);
            return $result;
        }

        public function insert_cartegory($cartegory_name){
            $query = "INSERT INTO tbl_cartegory(cartegory_name) VALUES ('$cartegory_name')";
            $result = $this->db->insert($query);
            header('Location: cartegory.php');
            return $result;
        }

        public function show_cartegory(){
            $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_cartegory($cartegory_id){
            $query = "SELECT * FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_cartegory($cartegory_id){
            $query = "SELECT * FROM tbl_product, tbl_cartegory WHERE tbl_product.cartegory_id = '$cartegory_id' AND tbl_product.cartegory_id = tbl_cartegory.cartegory_id ORDER BY product_name ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_cartegory($cartegory_name, $cartegory_id){
            $query = "UPDATE tbl_cartegory SET cartegory_name = '$cartegory_name' WHERE cartegory_id = '$cartegory_id'";
            $result = $this->db->update($query);
            header('Location: cartegory.php');
            return $result;
        }

        public function delete_category($cartegory_id){
            $query = "DELETE FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id'";
            $result = $this->db->delete($query);
            header('Location: cartegory.php');
            return $result;
        }
    }
?>