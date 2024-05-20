<?php

    session_start();
    require_once 'connect.php';

    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE email='$email'"));
    if (!empty($user)){
        $_SESSION['message'] = 'Почта уже используется';
        header('Location: ../register.php');
    }else{

    if ($password === $password_confirm) {
        $password = md5($password);

        $name2 = explode(' ', $name);

        mysqli_query($connect, "INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `password`, `block`, `role`,`group_id`) VALUES (NULL, '$name2[0]', '$name2[1]', '$name2[2]', '$email', '$phone', '$password','-','user','-')") or die(mysqli_error($connect));



        $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");

    
    if (mysqli_num_rows($check_user) > 0) {

        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
                    "id" => $user['id'],
                    "first_name" => $user['first_name'],
                    "middle_name" => $user['middle_name'],
                    "last_name" => $user['last_name'],
                    "email" => $user['email'],
                    "phone" => $user['phone'],
                    "group_id" => $user['group_id'],
                    "role" => $user['role']
                ];

        $_SESSION['message'] = 'Регистрация прошла успешно!';
        header('Location: ../profile.php');
}

    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../register.php');
    }
}

?>
