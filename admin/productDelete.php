<?php
    include "header.php";
    include "slider.php";
?>

<?php 
    $product = new product();

    if(!isset($_GET['product_id']) || $_GET['product_id'] == NULL){
        echo "<script> window.location = 'product.php' </script>";
    }
    else {
        $product_id = $_GET['product_id'];
    }

    $delete_product = $product->delete_product($product_id); 

    $show_product = $product->show_product();
?>

        <div class="admin-content-right">
            <div class="admin-content-right-product-list">
                <h1>Danh sách sản phẩm</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Tên danh mục</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Ảnh</th>
                        <th>Mô tả</th>
                        <th>Tùy biến</th>
                    </tr>

                    <?php
                    if($show_product){
                        $i = 0;
                        while($result = $show_product->fetch_assoc()){
                            $i++;
                    ?>

                    <tr>
                        <td> <?php echo $i ?> </td>
                        <td> <?php echo $result['product_id'] ?> </td>
                        <td> <?php echo $result['product_name'] ?> </td>
                        <td> <?php echo $result['cartegory_name'] ?> </td>
                        <td> <?php echo $result['product_cost'] ?> </td>
                        <td> <?php echo $result['product_count'] ?> </td>
                        <td> <img width="150px" src="uploads/<?php echo $result['product_thumbnail'] ?>" alt=""> </td>
                        <td> <?php echo $result['product_desc'] ?> </td>
                        <td><a href="productEdit.php?product_id=<?php echo $result['product_id']?>">Sửa</a> <a href="productDelete.php?product_id=<?php echo $result['product_id']?>">Xóa</a></td>
                    </tr>

                    <?php
                        }
                    }
                    ?>
                </table>
            </div>

            <div class="admin-content-right-product-add">
                <h1>Thêm sản phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <select name="cartegory_id">
                        <?php
                        $show_cartegory = $product->show_cartegory();
                        if($show_cartegory){
                            while($result = $show_cartegory->fetch_assoc()){
                        ?>
                        <option value="<?php echo $result['cartegory_id']?>"> <?php echo $result['cartegory_name']?></option>
                        <?php        
                            }
                        }
                        ?>
                    </select>
                    <input required name="product_name" type="text" placeholder="Nhập tên sản phẩm">
                    <input required name="product_cost" type="text" placeholder="Nhập giá sản phẩm">
                    <input required name="product_count" type="text" placeholder="Nhập số lượng sản phẩm">
                    <input required name="product_thumbnail" type="file">
                    <textarea required name="product_desc" name="" id="" cols="30" rows="10" placeholder="Nhập mô tả sản phẩm"></textarea>
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>