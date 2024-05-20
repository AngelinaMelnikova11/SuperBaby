<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>
<?php require_once('header.php');
?>

<body>
    <div class="acab" >
      <h1 class="h1_img">Информация о профиле</h1>
      <div class="prof" >
        <div class="prof1" >
    <form method="post" action="vendor/profile_update.php">
      <input type="hidden" name="id" value="<?= $_SESSION['user']['id'] ?>">
        <h2 style="margin: 5px 0;">ФИО: <?= $_SESSION['user']['first_name'] ?> <?= $_SESSION['user']['middle_name'] ?> <?= $_SESSION['user']['last_name'] ?></h2>
        <h2  style="margin: 5px 0;" >Телефон: <?= $_SESSION['user']['phone'] ?></h2>
        <h2  style="margin: 5px 0;" href="#">Почта: <?= $_SESSION['user']['email'] ?></h2>
        <div style="display: flex;align-items: center;flex-wrap: wrap;flex-direction: column;border:5px solid #456fce;border-radius: 5px;">
        <h2  style="margin: 5px 0;">Форма изменения пароля</h2>
        <input type="password" name="password" placeholder="Введите старый пароль" required>
        <input type="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="password_new" placeholder="Введите новый пароль" required>
        <i style="color: gray;font-size: 9pt;max-width: 300px;text-align: center;">(Минимум 8 символов, одна цифра, одна буква в верхнем регистре и одна в нижнем)</i>
        <input type="submit" name="update_password2" value="Изменить пароль" class="sub">
        <?php
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
      </div>
    </form>
    </div>
    <br><br>
    <? 
    if ( $_SESSION['user']['role'] == 'admin' ) {

      echo '<div class="prof2"><ol class="rectangle">
  <li><a href="red_submission.php">Новые заявки</a></li>
  <li><a href="add_worker.php">Добавить воспитателя</a></li>
  <li><a href="add_group.php">Управление группами</a></li>
  <li><a href="workers.php">Управление аккаунтами</a></li>
  <li><a href="update_password.php">Заявки на изменение пароля</a></li>
  <li><a href="red_menu.php">Управление меню</a></li>
  <li><a href="appointment.php">График посещаемости</a></li>
  <li><a href="appointment_2.php">График успеваемости</a></li>
  <li><a href="all_info.php">Полная сводка</a></li>
</ol>';} 
if ( $_SESSION['user']['role'] == 'user') {
if ($_SESSION['user']['group_id'] != '-') {

                    $id_user = $_SESSION['user']['id'];
                    $result24 = mysqli_query($connect, "SELECT * FROM `users` WHERE id = '$id_user'") or die(mysqli_error($connect));
                    $row24 = mysqli_num_rows($result24);
                    foreach ($result24 as $row24) {
                      $new_mes = $row24['new_mes'];
                    }

  echo '<div class="prof2"><ol class="rectangle">
  <li><a href="performance.php">Успеваемость ребенка</a></li>
  <li><a href="chat.php">Чат группы';
  if ($row24['new_mes'] > 0 ){
    echo " <b class='new_mes'>".$new_mes."</b>";
  }
  echo '</a></li>
</ol></div>';
} 

}

if ( $_SESSION['user']['role'] == 'mentor')
 {
  if ($_SESSION['user']['group_id'] != '-') {
                    $id_user = $_SESSION['user']['id'];
                    $result24 = mysqli_query($connect, "SELECT * FROM `users` WHERE id = '$id_user'") or die(mysqli_error($connect));
                    $row24 = mysqli_num_rows($result24);
                    foreach ($result24 as $row24) {
                      $new_mes = $row24['new_mes'];
                    }
  echo '<div class="prof2"><ol class="rectangle">
  <li><a href="lesson.php">Занятия</a></li>
  <li><a href="chat.php">Чат группы ';
  if ($row24['new_mes'] > 0 ){
    echo " <b class='new_mes'>".$new_mes."</b>";
  }
  echo '</a></li>
</ol></div>';}}

?></div>
<div class="zavki_all">
<?  
    $id_parent = $_SESSION['user']['id'];
    $result = mysqli_query($connect, "SELECT * FROM `submission` WHERE `id_parent` = '$id_parent'") or die(mysqli_error($connect));
    $row = mysqli_num_rows($result);

    foreach ($result as $row) {
      echo '
      <form class="zavki_one" method="post" action="delete.php">
      <input type="hidden" value="'.$row['id'].'" name="id_submission">
        <h2>Заявка</h2>
        <p>ФИО ребенка: '.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'</p>
        <p>Дата рождения ребенка: '.$row['date_br'].'</p>
      ';

        if($row['status']=='approval'){
          echo '
            <p>Дата создания: '.$row['data_first'].'</p>
            <p>Время создания: '.$row['time_first'].'</p>
            <div class="status_zavki_1">
              Расмотрение
            </div>
            <br>
            <button type="submit" style="margin: 0;background: 0;width: auto;" target="_blank" onclick="return confirmDelete(this);" class="delete-link need-to-confirm">
                <span class="maintext">✘ Удалить</span>
                <span class="confirmation">✔ Точно?</span>
            </button>
          ';
        }
        if($row['status']=='approved'){
          echo '
            <p>Дата одобрения: '.$row['data_last_true'].'</p>
            <p>Время одобрения: '.$row['time_last_true'].'</p>
            <div class="status_zavki_2">
              Одобрено
            </div>
          ';
        }
        if($row['status']=='rejected'){
          echo '
            <p>Дата отклонения: '.$row['data_lats_false'].'</p>
            <p>Время отклонения: '.$row['time_lats_false'].'</p>
            <div class="status_zavki_3">
              Отклонено
            </div>
            <br>
            <button type="submit" style="margin: 0;background: 0;width: auto;" target="_blank" onclick="return confirmDelete(this);" class="delete-link need-to-confirm">
                <span class="maintext">✘ Удалить</span>
                <span class="confirmation">✔ Точно?</span>
            </button>
          ';
        }

        echo '
      </form>

      ';} 

        ?>
        <style type="text/css">
          .delete-link {
    display: inline-block;
    padding: 3px 5px;
    border: 1px solid red;
    background-color: #edbaba;
    color: red;
    text-decoration: none;
    font-size: 14pt;
}
.delete-link:hover {
    background-color: #fff;
}
.need-to-confirm .confirmation {
    display: none;
}
.confirmed .maintext {
    display: none;
}
        </style>
        <script type="text/javascript">
          var confirmDelete = (function (element) {
    var className = element.className;

    if (className.indexOf('need-to-confirm') > -1) {
        element.className = className.replace('need-to-confirm', 'confirmed');
        return false;
    } 
});
        </script>
      </div>
     
        </div>
        </div>
</html>
<?php require_once('footer.php'); ?>