<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>
<?php require_once('header.php');
?>
<? 


$id_group =  $_POST['id_group'];
if (isset($_POST['upd'])){
    $id_user =  $_POST['id_user'];
    $id_group =  $_POST['id_group'];
    mysqli_query($connect, "UPDATE `users` SET `group_id` = '$id_group' WHERE `id` = '$id_user'");

    echo '<script>alert("Воспитатель добавлен в группу");location.replace("add_group.php");</script>';
}

if (isset($_POST['upd1'])){
    $id_user =  $_POST['id_user'];
    $id_group =  $_POST['id_group'];
    mysqli_query($connect, "UPDATE `users` SET `group_id` = '-' WHERE `id` = '$id_user'");

    echo '<script>alert("Воспитатель удален из группы");location.replace("add_group.php");</script>';
}

 ?>
<body>
<div class="acab" >
    <h1 style="text-align: center;font-size: 30px;margin:10px;" >Список воспитателей группы</h1>
    <div class="prof" >
    <?
    $result = mysqli_query($connect, "SELECT * FROM `users` WHERE `group_id` = '$id_group' AND `role` = 'mentor'") or die(mysqli_error($connect));
    $row = mysqli_num_rows($result);
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $row) {
            echo '
                <form class="kvas11" method="post">
                    <input type="hidden" value="'.$row['id'].'" name="id_user">
                    <input type="hidden" value="'.$_POST['id_group'].'" name="id_group">
                    <p>ФИО: '.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'</p>
                    <p>Номер телефона: '.$row['phone'].'</p>
                    <button type="submit" class="btn-2" style="width:200px;margin:0;background:red;" name="upd1">Убарть из группы</button>
                </form>
            ';
        }
    }else {
        echo "В группе отсутствуют воспитатели";
    }
    ?>
    </div>
    <h1 style="text-align: center;font-size: 30px;margin:10px;" >Список воспитателей без группы</h1>
    <div class="prof" >
    <?
    $result = mysqli_query($connect, "SELECT * FROM `users` WHERE `group_id` = '-' AND `role` = 'mentor'") or die(mysqli_error($connect));
    $row = mysqli_num_rows($result);
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $row) {
            echo ' 
                <form class="kvas11" method="post">
                    <input type="hidden" value="'.$row['id'].'" name="id_user">
                    <input type="hidden" value="'.$_POST['id_group'].'" name="id_group">
                    <p>ФИО: '.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'</p>
                    <p>Номер телефона: '.$row['phone'].'</p>
                    <button type="submit" class="btn-2" style="width:200px;margin:0;" name="upd">Добавить в группу</button>
                </form>
            ';
        }
    }else {
        echo "Воспитатели без группы отсутствуют";
    }
    ?>
    </div>
</div>



<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
<script src="https://snipp.ru/cdn/maskedinput/jquery.maskedinput.min.js"></script>

</body>
<?php require_once('footer.php'); ?>