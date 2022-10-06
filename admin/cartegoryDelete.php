<?php
    include "header.php";
    include "slider.php";
?>

<?php 
    $cartegory = new cartegory();

    if(!isset($_GET['cartegory_id']) || $_GET['cartegory_id'] == NULL){
        echo "<script> window.location = 'cartegoryList.php' </script>";
    }
    else {
        $cartegory_id = $_GET['cartegory_id'];
    }

    $delete_cartegory = $cartegory->delete_cartegory($cartegory_id);

    $delete_product = $cartegory->delete_product_in_cartegory($cartegory_id);

    header('Location: cartegory.php');

    $show_cartegory = $cartegory->show_cartegory();
?>

        <div class="admin-content-right">
            <div class="admin-content-right-cartegory-list">
                <h1>Danh sách danh mục</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Tùy biến</th>
                    </tr>

                    <?php
                    if($show_cartegory){
                        $i = 0;
                        while($result = $show_cartegory->fetch_assoc()){
                            $i++;
                    ?>

                    <tr>
                        <td> <?php echo $i ?> </td>
                        <td> <?php echo $result['cartegory_id'] ?> </td>
                        <td> <?php echo $result['cartegory_name'] ?> </td>
                        <td><a href="cartegoryEdit.php?cartegory_id=<?php echo $result['cartegory_id']?>">Sửa</a> <a href="cartegoryDelete.php?cartegory_id=<?php echo $result['cartegory_id']?>">Xóa</a></td>
                    </tr>

                    <?php
                        }
                    }
                    ?>
                </table>
            </div>

            <div class="admin-content-right-cartegory-add">
                <h1>Thêm danh mục</h1>
                <form action="" method="POST">
                    <input name="cartegory_name" type="text" required placeholder="Nhập tên danh mục">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>