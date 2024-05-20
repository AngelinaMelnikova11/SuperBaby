<?php require_once('header.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.btn {
    background-color: #2196F3;
    color: white;
    padding: 6px;
    font-size: 16px;
    border: none;
    outline: none;
    border-radius: 1px;
}

.dropdown {

    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    z-index: 1;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.btn:hover, .dropdown:hover .btn {
    background-color: #0b7dda;
}
</style>

<main>
	<h1 class="h1_img" id="omission">Занятие</h1>
	<div class="table-wrap">
          <table class="table-1">
            <tr>
              <th>№</th>
              <th>ФИО ребенка</th>
              <th>Посещаемость</th>
              <th>Замечание</th>
              <th>Оценка</th>
              <th>Действие</th>
            </tr>
            <?
            $id_group = $_SESSION['user']['group_id'];
            $result = mysqli_query($connect, "SELECT * FROM `child` where group_id='$id_group' ORDER BY `first_name`, `middle_name`, `last_name` ASC") or die(mysqli_error($connect));
            $row = mysqli_num_rows($result);
            $s = 1;
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td style='width:50px;'>".$s++."</td>";
                echo '<td>'.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'</td>';
                echo '<td >';
                $id_lesson = $_COOKIE['lesson'];
                $id_chil = $row['id'];
                $date_today1 = date("Y-m-d");
                $res = mysqli_query($connect, "SELECT * FROM `lesson` where id='$id_lesson'") or die(mysqli_error($connect));
                $ro = mysqli_num_rows($res);
                foreach ($res as $ro) {
                    $data_lesson = $ro['data'];
                }
                $result22 = mysqli_query($connect, "SELECT * FROM `omission` where id_child = '$id_chil' AND id_lesson = '$id_lesson'") or die(mysqli_error($connect));
                $row22 = mysqli_num_rows($result22);
                foreach ($result22 as $row22) {
                        $miss = $row22['miss'];                    }
                if (mysqli_num_rows($result22) <= 0) {
                    if ($miss != '-' || mysqli_num_rows($result22) <= 0) {
                        
                     echo '
                        <div class="dropdown">
                          <button class="btn" style="border-left:1px solid #dd84fa">
                            <i class="fa fa-caret-down"></i>
                          </button>
                          <div class="dropdown-content">
                            <form method="post">
                                   <input type="hidden" name="id_child" value="'.$row['id'].'">
                                   <input type="hidden" name="parent_id" value="'.$row['parent_id'].'">
                                   <button type="submit" class="btn-2" style="width:auto;margin:2;background:#456fce; width:100%;" name="sog1">Присутствует</button>
                               </form>
                                <form method="post">
                                   <input type="hidden" name="id_child" value="'.$row['id'].'">
                                   <input type="hidden" name="parent_id" value="'.$row['parent_id'].'">
                                   <button type="submit" class="btn-2" style="width:auto;margin:2;background:#dd84fa;width:100%;" name="sog2">Отсутсвует</button>
                               </form>
                          </div>
                        </div>';
                    }
                }
                if(mysqli_num_rows($result22) > 0){
                    if ($miss != '-' || mysqli_num_rows($result22) <= 0) {
                        if ($row22['name_back'] == '-') {  
                    echo ' <form method="post" action="sbor.php">
                            <input type="hidden" name="id_child" value="'.$row['id'].'">
                            <button type="submit" class="btn-2" style="width:auto;margin:2;background:#456fce;;width:100%;">Забирают</button>
                           </form>
                    ';
                    }
                    elseif ($row['name_back'] != '-') {
                        echo 'Забрал(а): '.$row22['name_back'].'<br>(<i style="color:gray;font-size:10pt;">'.$row22['time_last'].' | '.$row22['data_last'].'</i>)';
                    }
                }
                if($miss == '-'){
                  echo ' <form method="post">
                            <input type="hidden" name="id_child" value="'.$row['id'].'">
                            <button type="submit" name="back" class="btn-2" style="width:auto;margin:2;background:#456fce;;width:100%;">Вернуть</button>
                           </form>
                    ';
                }
                }

                echo '</td>';
                $result1 = mysqli_query($connect, "SELECT * FROM `omission` where id_child = '$id_chil' AND id_lesson = '$id_lesson' AND miss != '-'") or die(mysqli_error($connect));
                $row1 = mysqli_num_rows($result1);
                foreach ($result1 as $row1) {
                    echo '
                    <form method="post">
                        <input type="hidden" name="id_child" value="'.$row['id'].'">
                        <td><textarea name="zamech"  style="width:100%;height:100%;resize:none;" placeholder="Напишите замечание, если оно имеется">'.$row1['comment'].'</textarea></td>
                        <td>
                        <select name="ocen" style="border: none;padding: 14px;font-size: 14pt; margin: 5px;border-radius: 10px;">
                        <option value="">Оценка ребенка</option>
                        <option value="5"'; if($row1['score']=="5"){echo " selected";} echo'>Отлично</option>
                        <option value="4"'; if($row1['score']=="4"){echo " selected";} echo'>Хорошо</option>
                        <option value="3"'; if($row1['score']=="3"){echo " selected";} echo'>Плохо</option>
                        <select>
                        </td>
                        <td><button name="update" type="submit" style="display: flex;justify-content: center;align-items: center;width: 100%;font-size: 14pt">Сохранить данные</button></td>
                    </form>
                    ';
                }

                echo "</tr>";
            }

            if(isset($_POST['sog1'])){
                $id_child = $_POST['id_child'];
                $parent_id = $_POST['parent_id'];
                $date_today1 = date("Y-m-d");
                $today1[1] = date("H:i:s");
                $id_lesson = $_COOKIE['lesson'];
                mysqli_query($connect, "INSERT INTO `omission` (`id`, `id_child`, `id_lesson`, `miss`, `data_first`, `time_first`, `name_back`, `parent_id`, `id_group`) VALUES (NULL, '$id_child', '$id_lesson', '+', '$date_today1', '$today1[1]','-', '$parent_id', '$id_group')");
                echo '<meta http-equiv="refresh" content="1">';
                echo '<script>location.replace("omission.php#omission");</script>'; 
            }
            if(isset($_POST['sog2'])){
                $id_child = $_POST['id_child'];
                $parent_id = $_POST['parent_id'];
                $date_today1 = date("Y-m-d");
                $today1[1] = date("H:i:s");
                $id_lesson = $_COOKIE['lesson'];
                mysqli_query($connect, "INSERT INTO `omission` (`id`, `id_child`, `id_lesson`, `miss`, `data_last`, `time_last`, `name_back`, `parent_id`, `id_group`) VALUES (NULL, '$id_child', '$id_lesson', '-', '$date_today1', '$today1[1]', '-', '$parent_id', '$id_group')");
                echo '<meta http-equiv="refresh" content="1">';
                echo '<script>location.replace("omission.php#omission");</script>';
            }
            if(isset($_POST['update'])){
                $id_child = $_POST['id_child'];
                $zamech = $_POST['zamech'];
                $ocen = $_POST['ocen'];
                $id_lesson = $_COOKIE['lesson'];
                mysqli_query($connect, "UPDATE `omission` SET `score` = '$ocen', `comment` = '$zamech' WHERE `id_child` = '$id_child' and `id_lesson` = '$id_lesson'");
                echo '<meta http-equiv="refresh" content="1">';
                echo '<script>location.replace("omission.php#omission");</script>';
            }

            if(isset($_POST['back'])){
                $id_child = $_POST['id_child'];
                $id_lesson = $_COOKIE['lesson'];
                $query4 = "DELETE FROM `omission` WHERE `id_child` = '$id_child' AND `id_lesson` = '$id_lesson'";
                $result4 = mysqli_query($connect, $query4) or die(mysqli_error($connect));
                echo '<meta http-equiv="refresh" content="1">';
                echo '<script>location.replace("omission.php#omission");</script>';
            }


            ?>
          </table>
          <style type="text/css">
              select option[value="5"] {
                  background: green;
                  color: white;
                }

                select option[value="3"] {
                  background: red;
                  color: white;
                }

                select option[value="4"] {
                  background: orange;
                }
          </style>
        </div>
</main>
<?php require_once('footer.php'); ?>