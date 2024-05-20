<?php
session_start();

if ($_SESSION['user']) {
    header('Location: profile.php');
}

?>
<?php require_once('header.php');

$a = rand(1,10);
$b = rand(1,10);

$_SESSION['res'] = $a + $b;

?>
<body>

<!-- Форма авторизации -->
<main>
    <h1 class="h1_img">Авторизация</h1>
    <div class="prof" >
    <form class="form"  action="vendor/signin.php" method="post">
        <label>Почта</label>
        <input value="" pattern="\S+@[a-z]+.[a-z]+" required type="text" name="email" placeholder="Введите свою почту">
        <label>Пароль</label>
        <input  type="password" name="password" placeholder="Введите пароль">
        <label>Решите капчу: <i style="padding: 5px; background: #456fce;color: white;border-radius: 5px;"><?echo $a.' + '.$b;?></i></label>
        <input required type="number" name="res" placeholder="Введите ответ" min="0">
        <button type="submit">Войти</button>
        <div style="display: flex;justify-content: space-between;flex-wrap: wrap;flex-direction: row;"> 
        <p style="margin:10px;">
            У вас нет аккаунта? - <a href="register.php">Зарегистрируйтесь!</a>
        </p>
        <p style="margin:10px;">
            <a href="back_password.php">Забыли пароль?</a>
        </p>
        </div>
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