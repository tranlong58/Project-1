<?php
    class users {
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function get_users_by_email($user_email){
            $query = "SELECT * FROM tbl_user WHERE user_email = '$user_email'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_users_by_id($users_id){
            $query = "SELECT * FROM tbl_user WHERE users_id = '$users_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_users($users_name, $user_phoneNumber, $user_email, $user_password){
            $query = "INSERT INTO tbl_user(users_name, user_phoneNumber, user_email, user_password) VALUES ('$users_name', '$user_phoneNumber', '$user_email', '$user_password')";
            $result = $this->db->insert($query);
            header('Location: register.php');
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