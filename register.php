<?php
    session_start();
    if ($_SESSION['user']) {
        header('Location: profile.php');
    }
?>
<?php require_once('header.php');
?>
<main>
    <!-- Форма регистрации -->
    <h1 class="h1_img">Регистрация</h1>
<div class="prof" >
    <form class="form" action="vendor/signup.php"  method="post" >
        <label>ФИО</label>
        <input value="" class="input-words" pattern="[A-Яа-я]{1,}\s[A-Яа-я]{1,}\s[A-Яа-я]{1,}" required type="text" name="full_name" placeholder="Введите свое ФИО">
        <label>Почта</label>
        <input value="" pattern="\S+@[a-z]+.[a-z]+" required type="text" name="email" placeholder="Введите адрес своей почты">
        <label>Телефон</label>
        <input type="text" class="mask-phone" name="phone" maxlength="50" required value="+7(___)___-__-__" placeholder="Введите номер телефона">
        <label>Пароль<br>
            <i style="color: gray;font-size: 10pt;">(Минимум 8 символов, одна цифра, одна буква в верхнем регистре и одна в нижнем)</i>
        </label>
        <input value="" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required type="password" name="password" placeholder="Введите пароль">
        <label>Подтверждение пароля</label>
        <input value="" required type="password" name="password_confirm" placeholder="Подтвердите пароль">
        <div style="display: flex;align-items: center;" >
            <input required class="checkbox" type="checkbox" id="chek1" >
            <label for="chek1">Нажимая на кнопку, вы соглашаетесь на обработку персональных данных</label>
        </div>
        <button type="submit">Зарегистрироваться</button>
        <p style="margin:10px;">
            У вас уже есть аккаунт? - <a href="login.php">Авторизируйтесь!</a>
        </p>
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
<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
<script src="https://snipp.ru/cdn/maskedinput/jquery.maskedinput.min.js"></script>
            <script type="text/javascript">
(function() {
  caseSumsToSep.forEach(makeNumSep);
  function makeNumSep(item, index) {
    let workValue = item.innerHTML;
    item.innerHTML = parseFloat(workValue).toLocaleString('ru-RU', {minimumFractionDigits: 2, maximumFractionDigits: 2}).replace(',', '.');
  }
}) ();
$('body').on('input', 'input[type="number"][maxlength]', function(){
    if (this.value.length > this.maxLength){
        this.value = this.value.slice(0, this.maxLength);
    }
});
$('body').on('input', '.input-words', function(){
    this.value = this.value.replace(/[^a-zа-яё\s]/gi, '');
});
</script>
<script type="text/javascript">
$('.mask-phone').mask('+7(999)999-99-99');
</script>

<?php require_once('footer.php'); ?>