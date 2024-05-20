<?php
session_start();


?>
<?php require_once('header.php');
?>
<body>

<!-- Форма авторизации -->
<main>
<h1 class="h1_img">Восстановление пароля</h1>
<div class="prof">
    <form class="form" action="vendor/back.php" method="post">
        <label>Почта</label>
        <input value="" pattern="\S+@[a-z]+.[a-z]+" required type="text" name="email" placeholder="Введите адрес своей почты">
        <button type="submit">Отправить письмо</button>

        <?php
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
    </form>
</div>
</main>
</body>
<?php require_once('footer.php'); ?>