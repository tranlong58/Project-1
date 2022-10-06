<?php
    include "header.php";
    include "slider.php";
?>

<?php
    $cartegory = new cartegory();

    $cartegory_id = $_GET['cartegory_id'];

    $get_cartegory = $cartegory->get_cartegory($cartegory_id);

    if($get_cartegory){
        $res = $get_cartegory->fetch_assoc();
    }

    $show_cartegory = $cartegory->show_cartegory();
?>

<?php
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $cartegory_name = $_POST['cartegory_name'];
        $update_cartegory = $cartegory->update_cartegory($cartegory_name, $cartegory_id);
    }
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
                <h1>Sửa danh mục</h1>
                <form action="" method="POST">
                    <input name="cartegory_name" type="text" required placeholder="Nhập tên danh mục" value="<?php echo $res['cartegory_name'] ?>";>
                    <button type="submit">Sửa</button>
                </form>
            </div>

        </div>
    </section>
</body>
</html>