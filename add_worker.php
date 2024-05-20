<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>
<?php require_once('header.php');
?>
<? 
$name=$_POST['full_name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$password=$_POST['password'];
$password = md5($password);
if (isset($_POST['add'])){
    $user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE email='$email'"));
    if (!empty($user)){
        $_SESSION['message'] = 'Почта уже используется';
    }else{


    $name2 = explode(' ', $name);

    mysqli_query($connect, "INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `password`, `block`, `role`, `group_id`) VALUES (NULL, '$name2[0]', '$name2[1]', '$name2[2]', '$email', '$phone', '$password','-','mentor','-')");

    echo '<script>location.replace("workers.php");</script>';}
}
if ($_SESSION['user']['role'] == 'admin'){
 ?>
<body>
     <div class="acab" >
        <h1 class="h1_img">Добавить нового воспитателя </h1>
    <div class="prof" >

<form style="display: flex; flex-direction: column; width: 70%;"  method="post" >
         <label>ФИО</label>
        <input value="" pattern="[A-Яа-я]{1,}\s[A-Яа-я]{1,}\s[A-Яа-я]{1,}" class="input-words" required type="text" name="full_name" placeholder="Введите ФИО">
        <label>Почта</label>
        <input value="" pattern="\S+@[a-z]+.[a-z]+" required type="text" name="email" placeholder="Введите адрес почты">
        <label>Телефон</label>
        <input type="text" class="mask-phone" name="phone" maxlength="50" required value="+7(___)___-__-__" placeholder="Введите номер телефона">
        <label>Пароль<br>
            <i style="color: gray;font-size: 10pt;">(Минимум 8 символов, одна цифра, одна буква в верхнем регистре и одна в нижнем)</i>
        </label>
        <input value="" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required type="password" name="password" placeholder="Введите пароль">
        <button name="add" type="submit" class="sub" style="font-family: 'Dimkin-Regular'; display: flex;justify-content: center;align-items: center; ">Добавить</button>
         <?php
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
    </form>
</div>
</div>
<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
<script src="https://snipp.ru/cdn/maskedinput/jquery.maskedinput.min.js"></script>
              <script type="text/javascript">
(function() {
  let caseSumsToSep = document.querySelectorAll('span.price');
  caseSumsToSep.forEach(makeNumSep);
  function makeNumSep(item, index) {
    let workValue = item.innerHTML;
    item.innerHTML = parseFloat(workValue).toLocaleString('ru-RU', {minimumFractionDigits: 2, maximumFractionDigits: 2}).replace(',', '.');
  }
}) ();

(function() {
  let caseSumsToSep = document.querySelectorAll('span.price');
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
$('header').on('input', '.input-words', function(){
    this.value = this.value.replace(/[^a-zа-яё\s]/gi, '');
});
</script>
<script type="text/javascript">
$('.mask-phone').mask('+7(999)999-99-99');
</script>
</body>
<?php }require_once('footer.php'); ?>