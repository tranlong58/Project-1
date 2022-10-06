<?php
    class product {
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function show_cartegory(){
            $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_product($post, $files){
            $product_name = $post['product_name'];
            $cartegory_id = $post['cartegory_id'];
            $product_cost = $post['product_cost'];
            $product_count = $post['product_count'];
            $product_thumbnail = $files['product_thumbnail']['name'];
            $product_desc = $post['product_desc'];
            
            move_uploaded_file($files['product_thumbnail']['tmp_name'],'uploads/'.$files['product_thumbnail']['name']);

            $query = "INSERT INTO tbl_product(
                product_name,
                cartegory_id,
                product_cost,
                product_count,
                product_thumbnail,
                product_desc
                ) 
                VALUES (
                '$product_name',
                '$cartegory_id',
                '$product_cost',
                '$product_count',
                '$product_thumbnail',
                '$product_desc'
                )";
            $result = $this->db->insert($query);
            header('Location: product.php');
            return $result;
        }

        public function show_product(){
            $query = "SELECT * FROM tbl_product, tbl_cartegory WhERE tbl_product.cartegory_id = tbl_cartegory.cartegory_id ORDER BY tbl_product.cartegory_id ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product($product_id){
            $query = "SELECT * FROM tbl_product, tbl_cartegory WHERE product_id = '$product_id' AND tbl_product.cartegory_id = tbl_cartegory.cartegory_id";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_cartegory($cartegory_id){
            $query = "SELECT * FROM tbl_product, tbl_cartegory WHERE tbl_product.cartegory_id = '$cartegory_id' AND tbl_product.cartegory_id = tbl_cartegory.cartegory_id";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_product($post, $files, $product_id){
            $product_name = $post['product_name'];
            $cartegory_id = $post['cartegory_id'];
            $product_cost = $post['product_cost'];
            $product_count = $post['product_count'];
            $product_thumbnail = $files['product_thumbnail']['name'];
            $product_desc = $post['product_desc'];
            
            move_uploaded_file($files['product_thumbnail']['tmp_name'],'uploads/'.$files['product_thumbnail']['name']);

            $query = "UPDATE tbl_product SET 
                product_name = '$product_name',
                cartegory_id = '$cartegory_id',
                product_cost = '$product_cost',
                product_count = '$product_count',
                product_thumbnail = '$product_thumbnail',
                product_desc = '$product_desc' 
                WHERE product_id = '$product_id'";
            $result = $this->db->update($query);
            header('Location: product.php');
            return $result;
        }

        public function delete_product($product_id){
            $query = "DELETE FROM tbl_product WHERE product_id = '$product_id'";
            $result = $this->db->delete($query);
            header('Location: product.php');
            return $result;
        }
        

        

        


        
    }
?>