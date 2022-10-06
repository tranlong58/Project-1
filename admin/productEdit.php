<?php
    include "header.php";
    include "slider.php";
?>

<?php
    $product = new product();

    $product_id = $_GET['product_id'];

    $get_product = $product->get_product($product_id);

    if($get_product){
        $res = $get_product->fetch_assoc();
    }

    $show_product = $product->show_product();
?>

<?php
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $update_product = $product->update_product($_POST, $_FILES, $product_id);
    }
?>

        <div class="admin-content-right">
            <div class="admin-content-right-product-list">
                <h1>Danh sách sản phẩm</h1>
                <table>
                    <tr>
                        <th style="width: 5%">STT</th>
                        <th style="width: 5%">ID</th>
                        <th style="width: 15%">Tên sản phẩm</th>
                        <th style="width: 10%">Tên danh mục</th>
                        <th style="width: 10%">Giá</th>
                        <th style="width: 5%">Số lượng</th>
                        <th style="width: 10%">Ảnh</th>
                        <th style="width: 30%">Mô tả</th>
                        <th style="width: 10%">Tùy biến</th>
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
                <h1>Sửa sản phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <select name="cartegory_id">
                        <?php
                        $show_cartegory = $product->show_cartegory();
                        if($show_cartegory){
                            while($result = $show_cartegory->fetch_assoc()){
                        ?>
                        <option 
                            value="<?php echo $result['cartegory_id']?>"
                            <?php if($res['cartegory_id']==$result['cartegory_id']) echo "selected";?>
                        > 
                            <?php echo $result['cartegory_name']?>
                        </option>
                        <?php        
                            }
                        }
                        ?>
                    </select>
                    <input required name="product_name" type="text" placeholder="Nhập tên sản phẩm" value="<?php echo $res['product_name'] ?>";>
                    <input required name="product_cost" type="text" placeholder="Nhập giá sản phẩm" value="<?php echo $res['product_cost'] ?>";>
                    <input required name="product_count" type="text" placeholder="Nhập số lượng sản phẩm" value="<?php echo $res['product_count'] ?>";>
                    <input required name="product_thumbnail" type="file">
                    <textarea required name="product_desc" name="" id="" cols="30" rows="10" placeholder="Nhập mô tả sản phẩm"> <?php echo $res['product_desc'] ?></textarea>
                    <button type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>