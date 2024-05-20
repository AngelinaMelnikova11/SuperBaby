<?php

    session_start();
    require_once 'connect.php';

    $id = $_POST['id'];
    $password = $_POST['password'];
    $password = md5($password);

    $new_password = $_POST['password_new'];

    $new_password = md5($new_password);

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id' AND password = '$password'");
        if (mysqli_num_rows($check_user) > 0) {
        	mysqli_query($connect, "UPDATE `users` SET password='$new_password' WHERE `id` = '$id'");
        	$_SESSION['message'] = 'Пароль изменен';
        	header('Location: ../profile.php');
        }else {
            $_SESSION['message'] = 'Введенный вами пароль неверен';
            header('Location: ../profile.php');
        }

?>
