<?php
    class cart {
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function insert_cart($users_id, $product_id, $product_quantity){
            $query1 = "SELECT * FROM tbl_cart WHERE users_id='$users_id' AND product_id='$product_id'";
            $res = $this->db->select($query1);

            if($res) $num = mysqli_num_rows($res);
            else $num=0;

            if($num == 0) {
                $query = "INSERT INTO tbl_cart(users_id, product_id, product_quantity ) VALUES ('$users_id', '$product_id', '$product_quantity')";
                $result = $this->db->insert($query);
                header('Location: product.php?users_id='.$users_id.'&product_id='.$product_id);
                return $result;
            }
            else {
                $query = "UPDATE tbl_cart SET product_quantity = product_quantity + '$product_quantity' WHERE users_id='$users_id' AND product_id='$product_id'";
                $result = $this->db->update($query);
                header('Location: product.php?users_id='.$users_id.'&product_id='.$product_id);
                return $result;
            }

        }

        public function numRow(){
            $query = "SELECT * FROM tbl_cart WHERE users_id=2 AND product_id=15";
            $res = $this->db->select($query);

            if($res) $num = mysqli_num_rows($res);
            else $num=0;

            return $num;
        }

        // public function insert_order($users_id, $name_receiver, $address_receiver, $phoneNumber_receiver, $order_totalMoney, $order_time, $order_status){
        //     $query = "INSERT INTO tbl_order(
        //         users_id,
        //         name_receiver,
        //         address_receiver,
        //         phoneNumber_receiver,
        //         order_totalMoney,
        //         order_time,
        //         order_status
        //         ) 
        //         VALUES (
        //         '$users_id',
        //         '$name_receiver',
        //         '$address_receiver',
        //         '$phoneNumber_receiver',
        //         '$order_totalMoney',
        //         '$order_time',
        //         '$order_status'
        //         )";
        //     $result = $this->db->insert($query);
        //     return $result;
        // }

        public function delete_all_cart($users_id) {
            $query = "DELETE FROM tbl_cart WHERE users_id = '$users_id'";
            $result = $this->db->delete($query);
            return $result;
        }

        public function show_cartegory(){
            $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_cart_by_users($users_id){
            $query = "SELECT * FROM tbl_cart, tbl_product WHERE tbl_cart.product_id=tbl_product.product_id AND users_id = '$users_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_cartegory($cartegory_id){
            $query = "SELECT * FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_cart($users_id){
            $query = "SELECT * FROM tbl_cart WHERE users_id = '$users_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_cart($cart_id, $product_quantity){
            $query = "UPDATE tbl_cart SET product_quantity = '$product_quantity' WHERE cart_id = '$cart_id'";
            $result = $this->db->update($query);
            return $result;
        }

        public function get_product_by_cartegory($cartegory_id){
            $query = "SELECT * FROM tbl_product, tbl_cartegory WHERE tbl_product.cartegory_id = '$cartegory_id' AND tbl_product.cartegory_id = tbl_cartegory.cartegory_id ORDER BY product_name ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function delete_cart($users_id, $product_id){
            $query = "DELETE FROM tbl_cart WHERE users_id = '$users_id' AND product_id = '$product_id'";
            $result = $this->db->delete($query);
            header('Location: cart.php?users_id='.$users_id);
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