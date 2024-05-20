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
    $id_child =  $_POST['id_child'];
    $id_group =  $_POST['id_group'];

    $parent_id =  $_POST['parent_id'];

    $result = mysqli_query($connect, "SELECT * FROM `team` WHERE `id` = '$id_group'") or die(mysqli_error($connect));
    $row = mysqli_num_rows($result);
    foreach ($result as $row) {
        $alo = $row['quantity'];
    }
    if($alo <= '0'){
        echo '<script>alert("Мест в группе нет");location.replace("add_group.php");</script>';
    }else {
    mysqli_query($connect, "UPDATE `users` SET `group_id` = '$id_group' WHERE `id` = '$parent_id'") or die(mysqli_error($connect));

    mysqli_query($connect, "UPDATE `child` SET `group_id` = '$id_group' WHERE `id` = '$id_child'") or die(mysqli_error($connect));


    $a = 1;

    mysqli_query($connect, "UPDATE `team` SET `quantity` = `quantity` - '$a' WHERE `id` = '$id_group'") or die(mysqli_error($connect));

    echo '<script>alert("Ребенок добавлен в группу");location.replace("add_group.php");</script>';}
}

if (isset($_POST['upd1'])){
    $id_child =  $_POST['id_child'];
    $id_group =  $_POST['id_group'];
    $parent_id =  $_POST['parent_id'];

    mysqli_query($connect, "UPDATE `users` SET `group_id` = '-' WHERE `id` = '$parent_id'") or die(mysqli_error($connect));

    mysqli_query($connect, "UPDATE `child` SET `group_id` = '-' WHERE `id` = '$id_child'") or die(mysqli_error($connect));


    $a = 1;

    mysqli_query($connect, "UPDATE `team` SET `quantity` = `quantity` + '$a' WHERE `id` = '$id_group'") or die(mysqli_error($connect));

    echo '<script>alert("Ребенек исключен из группы");location.replace("add_group.php");</script>';
}

 ?>
<body>
<div class="acab" >
    <h1 style="text-align: center;font-size: 30px;margin:10px;">Список детей в группе</h1>
    <div class="prof" >
    <?
    $result = mysqli_query($connect, "SELECT * FROM `child` WHERE `group_id` = '$id_group'") or die(mysqli_error($connect));
    $row = mysqli_num_rows($result);
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $row) {
            $parent_id = $row['parent_id'];
            $result1 = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$parent_id'") or die(mysqli_error($connect));
            $row1 = mysqli_num_rows($result1);
            echo ' 
                <form class="kvas11" method="post">
                    <input type="hidden" value="'.$row['id'].'" name="id_child">
                    <input type="hidden" value="'.$_POST['id_group'].'" name="id_group">
                    <input type="hidden" value="'.$row['parent_id'].'" name="parent_id">
                    <div>
                        <p>ФИО ребенка: '.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'</p>
                        <p>Дата рождения ребенка: '.$row['date_br'].'</p>';
                        foreach ($result1 as $row1) {
                        echo'<p>ФИО родителя: '.$row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'].'</p>';

                    }
                        echo '
                    </div>
                    <button type="submit" class="btn-2" style="width:200px;margin:0;background:red;" name="upd1">Убарть из группы</button>
                </form>
            ';
        }
    }else {
        echo "Дети в группе отсутствуют";
    }
    ?>
    </div>
    <h1 style="text-align: center;font-size: 30px;margin:10px;">Список детей без группы</h1>
    <div class="prof" >
    <?
    $result = mysqli_query($connect, "SELECT * FROM `child` WHERE `group_id` = '-'") or die(mysqli_error($connect));
    $row = mysqli_num_rows($result);
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $row) {
            $parent_id = $row['parent_id'];
            $result1 = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$parent_id'") or die(mysqli_error($connect));
            $row1 = mysqli_num_rows($result1);
            echo ' 
                <form class="kvas11" method="post">
                    <input type="hidden" value="'.$row['id'].'" name="id_child">
                    <input type="hidden" value="'.$_POST['id_group'].'" name="id_group">
                    <div>
                        <p>ФИО ребенка: '.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'</p>
                        <p>Дата рождения ребенка: '.$row['date_br'].'</p>';

                        foreach ($result1 as $row1) {
                        echo'<p>ФИО родителя: '.$row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'].'</p><input type="hidden" value="'.$row['parent_id'].'" name="parent_id">';

                    }
                        echo '
                    </div>
                    <button type="submit" class="btn-2" style="width:200px;margin:0;" name="upd">Добавить в группу</button>
                </form>
            ';
        }
    }else {
        echo "Дети без группы отсутствуют";
    }
    ?>
    </div>
</div>



<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
<script src="https://snipp.ru/cdn/maskedinput/jquery.maskedinput.min.js"></script>

</body>
<?php require_once('footer.php'); ?>