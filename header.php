<?php
session_start();
    $connect = mysqli_connect('localhost', 'root', 'root', 'baby');

    if (!$connect) {
        die('Error connect to DataBase');
    }

    if(isset($_POST['che123'])){
                setcookie('lesson', $_POST['id_lesson']);
                 header('Location: omission.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>SuperBaby</title>
  <meta charset="utf-8">
  <link href="img/favi.ico" rel="icon" type="image/x-icon" />

  <style type="text/css">
    @font-face {
    font-family: Dimkin-Bold; /* Гарнитура шрифта */
    src: url(font/Dimkin-Bold.ttf); 
   }

   @font-face {
    font-family: Dimkin-Regular; /* Гарнитура шрифта */
    src: url(font/Dimkin-Regular.ttf); 
   }

   .table-wrap{
  overflow-x:auto;
  width: 100%;
  background-color: white;
} 
table.table-1 {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
}
table.table-1 tr {
  background-color: #f8f8f8;
}
table.table-1 th, table.table-1 td {
    padding: 8px;
    border: 1px solid #ddd;
}
table.table-1 th{
  font-weight: bold;
}
.raz1 {
  position: relative;
}
.raz1 > div {
  position: absolute;
  top: 0;
  left: 50%;
}
/*Всплывающее окно*/
.raz1 > div > #popUp1 {
  height: auto;
  width: auto;  
  border-radius: 11px;
  background: white; 
  display: none; 
  opacity: 0;
  padding: 5px;
  z-index: 6;
  position: fixed;
  transform: translate(-50%,-25%);
}
#popUp1 #close1 {
  display: flex;
  justify-content: flex-end;
  cursor: pointer;
  text-align: right;
  width: 100%;
  height: 23px;
}
#overlay1 {
  z-index:4; 
  background-color:#010; 
  position:fixed; 
  opacity:0.86;
  width:100%; 
  height:100%;
  display:none; 
  top:0;
  left:0;
}
#popUp2 {
  height: auto;
  width: auto;  
  border-radius: 11px;
  background: white; 
  opacity: 1;
  padding: 5px;
}
#popUp2 #close2 {
  display: flex;
  justify-content: flex-end;
  cursor: pointer;
  text-align: right;
  width: 100%;
  height: 23px;
}
 </style>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  </head>

<header>
  <div class="head" >
  <a href="index.php"><img src="img/logo.png" class="logo"></a>
  <div class="h2" style="text-align: center;"><h1 style="font-family: Dimkin-Bold, 'Dimkin-Bold';">
  <b style="color: #456fce;">Дошкольное обучение</b> <b style="color: #dd84fa;">"SUPERBABY"</b></h1></div>
  <div class="h4">

    <?php
    //смена иконок
    if ($_SESSION['user']) {
        echo '<div class="of" ><a href="vendor/logout.php"><img src="img/vihod.png" ></a>';
        echo '<a href="profile.php" ><img src="img/prof.png"></a>';
        echo "</div>";
    }
    else {
      echo '<a href="login.php"><img src="img/vhod.png"></a>';
      echo '<a href="register.php"><img src="img/reg.png"></a>';
    }

//заявка
if(isset($_POST['going'])){
  if($_SESSION['user']['role'] == 'user'){
    echo '<script>location.replace("appointment.php");</script>';
  }
  else{
    echo '<script>location.replace("login.php");</script>';
  }
}

//добавление ребенка
$name=$_POST['full_name'];
$id_parent = $_SESSION['user']['id'];
if (isset($_POST['reg_att'])){
    if($_SESSION['user']['role'] == 'user'){
      $name=$_POST['full_name_child'];
      $date_br=$_POST['data'];
      $name2 = explode(' ', $name);
      $date = ltrim(date('Y-m-d'), 0);
      $time = ltrim(date('H:i:s'), 0);  
      mysqli_query($connect, "INSERT INTO `submission` (`id`, `first_name`, `middle_name`, `last_name`, `id_parent`, `data_first`, `time_first`, `status` ,`date_br`) VALUES (NULL, '$name2[0]', '$name2[1]', '$name2[2]', '$id_parent', '$date', '$time','approval', '$date_br')") or die(mysqli_error($connect));
      echo '<script>alert("Заявка создана"); location.replace("profile.php");</script>';
    }
    else{
      echo '<script>location.replace("login.php");</script>';
    }
  }

  //добавление урока
if (isset($_POST['add_les'])){
    $data1=$_POST['data1'];
    $text=$_POST['text'];
    $id_user = $_SESSION['user']['id'];
    $id_group = $_SESSION['user']['group_id'];
    mysqli_query($connect, "INSERT INTO `lesson` (`id`, `data`, `id_group`, `workplan`, `id_mentor`) VALUES (NULL, '$data1', '$id_group', '$text', '$id_user')") or die(mysqli_error($connect));
    echo '<meta http-equiv="refresh" content="0">';
}

    ?>
  </div>
  </div>
  <div class="topnav" id="myTopnav" style="font-family: Dimkin-Bold, 'Dimkin-Bold';">
  <a href="index.php" class="icon2">Главная</a>
  <a href="menu.php" class="icon2">Питание</a>
  <a href="help.php" class="icon2">Справка</a>  
  <a href="gosuslugi.php" class="icon2">Госуслуги</a>  
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
  </div>

<div class="raz">
  <div>
    <!--всплывающее окно заявки-->
    <div id="popUp">
          <span id="close">&#10006</span>
          <form style="display: flex; flex-direction: column; width: 100%;"  method="post" >
            <label for="date">ФИО ребенка</label>
            <input value="" pattern="[A-Яа-я]{1,}\s[A-Яа-я]{1,}\s[A-Яа-я]{1,}" required type="text" class="input-words" name="full_name_child" placeholder="Введите ФИО ребенка">
            <label for="date">Дата рождения ребенка</label>
            <input type="date" id="date" name="data" required>
            <div style="display: flex; align-items: center;" >
                <input required class="checkbox" type="checkbox" id="chek" >
                <label for="chek" style="font-size: 12pt;">Нажимая на кнопку, вы соглашаетесь на обработку персональных данных!</label>
            </div>
            <center>
            <button name="reg_att" type="submit" style="display: flex;justify-content: center;align-items: center;width: 100%;font-size: 14pt">Подать заявку</button>
            </center>
            <i style="color: gray;font-size: 10pt;text-align: center;">Заявку может создать только авторизованный пользователь!</i>
        </form>
    </div>
  </div>
</div>

<!--всплывающее окно для создания урока-->
<div class="raz1">
  <div>
    <div id="popUp1">
          <span id="close1">&#10006</span>
          <form style="display: flex; flex-direction: column; width: 100%;"  method="post" >
            <label for="date">Дата проведения занятия</label>
            <input type="date" id="date" name="data1" required min="<? echo date('Y-m-d'); ?>">
            <label for="date1">Описание занятия</label>
            <textarea id="date1" name="text" placeholder="Введите описание занятия" required style="width: 100%;max-width: 500px;min-width: 300px;height: 200px;max-height: 200px;min-height: 200px;"></textarea>
            <center>
            <button name="add_les" type="submit" style="display: flex;justify-content: center;align-items: center;width: 100%;font-size: 14pt">Добавить занятие</button>
            </center>
        </form>
    </div>
  </div>
</div>

 <script type="text/javascript">
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
$('body').on('input', '.input-words', function(){
    this.value = this.value.replace(/[^a-zа-яё\s]/gi, '');
});
</script>
<script type="text/javascript">
$('.mask-phone').mask('+7(999)999-99-99');

</script>
<div id="overlay"></div>
<div class="headimg">
</div>
</header>
<body style="font-family: Dimkin-Regular, 'Dimkin-Regular';">

<script type="text/javascript">
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

</script>

<script>
/*открытие всплывающего окна*/
$(document).ready(function() { 
  $('button#start2').click( function(event){ 
    event.preventDefault(); 
    $('#overlay2').fadeIn(250, 
      function(){
        $('#popUp2') 
          .css('display', 'block') 
          .animate({opacity: 1}, 490); 
    });
  });
/*по нажатию на крестик закрываю окно*/
  $('#close2, #overlay2').click( function(){ 
    $('#popUp2')
      .animate({opacity: 0}, 490, 
        function(){ 
          $(this).css('display', 'none'); 
          $('#overlay2').fadeOut(220); 
        }
      );
  });
});
</script>