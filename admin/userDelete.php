<?php
    include "header.php";
    include "slider.php";
?>

<?php 
    $user = new users();
    $show_user = $user->show_user();

    $users_id_remove = $_GET['users_id_remove'];
    $delete_users = $user->delete_users($users_id_remove);
?>

        <div class="admin-content-right">
            <div class="admin-content-right-cartegory-list">
                <h1>Danh sách tài khoản</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Tên người dùng</th>
                        <th>Vai trò</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Tùy biến</th>
                    </tr>
                    
                    <?php
                        if($show_user){
                            $i=0;
                            while($res = $show_user->fetch_assoc()){
                                $i++;
                    ?>
                    
                            <tr>
                                <td><p> <?php echo $i?> </p></td>
                                <td><p> <?php echo $res['users_name'] ?> </p></td>
                                <td><p> <?php echo $res['role_name'] ?> </p></td>
                                <td><p> <?php echo $res['user_phoneNumber'] ?> </p></td>
                                <td><p> <?php echo $res['user_email'] ?> </p></td>
                                <td><a href="userDelete.php?users_id_remove=<?php echo $res['users_id'] ?>">Xóa  </a></td>
                            </tr>

                    <?php
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>