<?php require_once('header.php');?>
<main>
	<h1 class="h1_img">Заполните информацию</h1>
	<?
    $id_lesson = $_COOKIE['lesson'];
    if (isset($_POST['zab1'])) {
        $id_child = $_POST['id_child'];
        $name_back = $_POST['name_back'];
        $date_today1 = date("Y-m-d");
        $today1[1] = date("H:i:s");
        mysqli_query($connect, "UPDATE `omission` SET `name_back` = '$name_back', `data_last` = '$date_today1', `time_last` = '$today1[1]' WHERE `id_child` = '$id_child' and `id_lesson` = '$id_lesson'")or die(mysqli_error($connect));
        echo '<meta http-equiv="refresh" content="1">';
        echo '<script>location.replace("omission.php#omission");</script>';
    }

    ?>
    <div id="popUp2">
          <form style="display: flex; flex-direction: column;width: 100%;"  method="post">
             <label for="date">ФИО кто забирает</label>
             <input type="hidden" name="id_child" value='<? echo $_POST['id_child'];  ?>'>
            <input value="" pattern="[A-Яа-я]{1,}\s[A-Яа-я]{1,}\s[A-Яа-я]{1,}" required type="text" class="input-words" name="name_back" placeholder="Введите ФИО">
            <center>
            <button name="zab1" type="submit" style="display: flex;justify-content: center;align-items: center;width: 100%;font-size: 14pt">Сохранить</button>
            </center>
            <i style="color: gray;font-size: 10pt;text-align: center;">Данные ФИО обязательно списываются с предоставленых документов</i>
        </form>
    </div>

</main>
<?php require_once('footer.php'); ?>