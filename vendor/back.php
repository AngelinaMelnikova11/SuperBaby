<?php

    session_start();
    require_once 'connect.php';

    $email = $_POST['email'];

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");
        if (mysqli_num_rows($check_user) > 0) {
        	mysqli_query($connect, "INSERT INTO `back` (`id`, `email`, `status`) VALUES (NULL, '$email', 'new')");
        	$_SESSION['message'] = 'Ожидайте на почту письмо с новым паролем!';
        	header('Location: ../back_password.php');
        }else {
            $_SESSION['message'] = 'Данная почта не зарегистрирована!';
            header('Location: ../back_password.php');
        }

?>
