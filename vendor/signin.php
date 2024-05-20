<?php

    session_start();
    require_once 'connect.php';

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
    $check_user1 = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
        if (mysqli_num_rows($check_user) > 0) {

            $row = mysqli_fetch_assoc($check_user1);
            if($_POST['res'] == $_SESSION['res']){
                if ($row['block'] == '-'){
                $user = mysqli_fetch_assoc($check_user);

                $_SESSION['user'] = [
                    "id" => $user['id'],
                    "first_name" => $user['first_name'],
                    "middle_name" => $user['middle_name'],
                    "last_name" => $user['last_name'],
                    "email" => $user['email'],
                    "phone" => $user['phone'],
                    "group_id" => $user['group_id'],
                    "role" => $user['role'],
                ];

                header('Location: ../profile.php');

            }else{
                $_SESSION['message'] = 'Ваш аккаунт заблокирован!';
                header('Location: ../login.php');
            }
            }else{
             $_SESSION['message'] = 'Капча введена неверно!';
                header('Location: ../login.php');
        }

        } else {
            $_SESSION['message'] = 'Неверный логин или пароль!';
            header('Location: ../login.php');
        }
    ?>

<pre>
    <?php
    print_r($check_user);
    print_r($user);
    ?>
</pre>
