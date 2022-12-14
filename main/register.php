<?php
    include "database.php";
    include "class/cartegory_class.php";
    include "class/product_class.php";
    include "class/cart_class.php";
    include "class/order_class.php";
    include "class/users_class.php";
?>

<?php
    $user = new users();
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $users_name = $_POST['user_name'];
        $user_phoneNumber = $_POST['user_phoneNumber'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        $get_user = $user->get_users_by_email($user_email);
        
        if($get_user) print_r('Emai đã tồn tại tài khoản');
        else {
            $insert_users = $user->insert_users($users_name, $user_phoneNumber, $user_email, $user_password);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>LStore</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link href="css/login.css" rel="stylesheet" type="text/css"/> -->
        <!-- <link rel="stylesheet" href="style.css"> -->
    </head>

    <style>
        *{
        padding: 0px;
        margin: 0px;
        font-family: sans-serif;
        box-sizing: border-box;
        }
        header{
            background-color: #cccccc;
            min-height: 70px;
            padding: 15px;
        }
        main{
            background-color: #dddddd;
            min-height: 720px;
            padding: 7.5px 15px;
        }
        footer{
            background-color: #cccccc;
            min-height: 70px;
            padding: 15px;
        }
        .container{
            width: 100%;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        .login-form{
            width: 100%;
            max-width: 400px;
            margin: 200px auto;
            background-color: #ffffff;
            padding: 15px;
            border: 2px solid #cccccc;
            border-radius: 10px;
        }
        h1{
            color: #009999;
            font-size: 20px;
            margin-bottom: 30px;
        }
        .input-box{
            margin-bottom: 10px;
        }
        .input-box input{
            padding: 7.5px 15px;
            width: 100%;
            border: 1px solid #cccccc;
            outline: none;
        }
        .btn-box{
            text-align: right;
            margin-top: 30px;
        }
        .btn-box button{
            padding: 7.5px 15px;
            border-radius: 2px;
            background-color: #009999;
            color: #ffffff;
            border: none;
            outline: none;
        }
        .login-form a{
            /* text-decoration: none; */
            color: black;
            font-size: 14px;
        }
    </style>
    <body>
        <main>
            <div class="container">
                <div class="login-form">
                    <form action="" method="post">
                    <h1>Đăng ký tài khoản mới</h1>
                        <div class="input-box">
                            <i ></i>
                            <input type="text" name="user_name" placeholder="Nhập họ tên">
                        </div>
                        <div class="input-box">
                            <i ></i>
                            <input type="text" name="user_phoneNumber" placeholder="Nhập số điện thoại">
                        </div>
                        <div class="input-box">
                            <i ></i>
                            <input type="text" name="user_email" placeholder="Nhập email">
                        </div>
                        <div class="input-box">
                            <i ></i>
                            <input type="password" name="user_password" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="btn-box">
                            <button type="submit">
                                Đăng ký
                            </button>
                        </div>
                        <div>
                            <a href="login.php">Trở lại đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
        </main> 
    </body>
</html>