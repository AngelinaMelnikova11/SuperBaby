<?php require_once('header.php');?>

<main>
	<h1 class="h1_img" id="omission">Успеваемость</h1>
  <?
  $id = $_SESSION['user']['id'];
$result33 = mysqli_query($connect, "SELECT * FROM `child` WHERE `parent_id` = '$id'") or die(mysqli_error($connect));
$row33 = mysqli_num_rows($result33);
echo "
<form method='post' id='name_child' class='form_filtr'>
<input list='name_child1' id='name_child11' style='width:250px;'  autocomplete='off' required placeholder='Введите ФИО' type='text' >
                    <datalist id='name_child1'>";
                            foreach ($result33 as $row33):
                            echo "<option data-value='".$row33['id']."' value='".$row33['first_name']." ".$row33['middle_name']." ".$row33['last_name']."'>
                            ";
                    endforeach; 
                   echo' </datalist><input type="submit" name="check" class="sub" value="Показать успеваемость" id="elme55"></form>';

  ?>
  <script type="text/javascript">
  $(document).ready(function() {
        elme55.onclick = function() {
        var value = $('#name_child11').val();
        document.cookie = "id_child="+$('#name_child1 [value="' + value + '"]').data('value')+"";
        document.cookie = "display_child=yes";
        };

});
</script>
  <?
  if($_COOKIE['display_child'] == 'yes'){
    $st = '';
  }else{
    $st = 'display:none';
  }
  ?>

            <div class="pagination_section">
                <?
                $group_id = $_SESSION['user']['group_id'];
                 if (isset($_GET['page'])){
                    $page = $_GET['page'];
                }else {
                    $page = 1;
                }

                $kol = 4;  // количество записей для вывода
                $art = ($page * $kol) - $kol;
    

                // Определяем все количество записей в таблице
                $res = mysqli_query($connect,"SELECT COUNT(*) FROM `lesson` where id_group='$group_id'");
                $row = mysqli_fetch_array($res);
                $total = $row[0]; // всего записей
   

                // Количество страниц для пагинации
                $str_pag = ceil($total / $kol);
                for ($i = 1; $i <= $str_pag; $i++){  
                }
                $prev = $page - 1;
                $prev2 = $page + 1;
                if($page == 1){
                    echo "<a ><< Предыдущая</a>"; 
                }else{
                    echo "<a href=performance.php?page=".$prev."><< Предыдущая</a>"; 
                }
                ?>
                <a class="active" style="color: white;"><? echo $page.'/'.($i-1); ?></a>
                <?
                if($page == ($i-1)){
                    echo "<a>Следующая >></a>";
                }else{
                    echo "<a href=performance.php?page=".$prev2.">Следующая >></a>";
                }
                ?>
            </div>
	<div class="table-wrap" style="<? echo $st; ?>">
          <table class="table-1">
            <tr>
              <th width="100px">Дата занятия</th>
              <th>Чем занимались на занятии</th>
              <th>Оценка</th>
              <th>Замечание</th>
            </tr>
            <?
            $group_id = $_SESSION['user']['group_id'];
            $id = $_SESSION['user']['id'];
            $result = mysqli_query($connect, "SELECT * FROM `lesson` where id_group='$group_id' ORDER BY `data` DESC LIMIT $art,$kol") or die(mysqli_error($connect));
            $row = mysqli_num_rows($result);
            foreach ($result as $row) {
              $id_child = $_COOKIE['id_child'];
             echo '
             <tr>
                <td>'.$row['data'].'</td>
                <td style="text-align:justify;">'.$row['workplan'].'</td>';
                
            $result1= mysqli_query($connect, "SELECT * FROM `omission` where `id_group` = '$group_id' AND `parent_id` = '$id' AND id_child = '$id_child' AND `id_lesson` = '".$row['id']."'") or die(mysqli_error($connect));
            $row1 = mysqli_num_rows($result1);
            foreach ($result1 as $row1) {

                if ($row1['score'] == '4') {
                    echo '<td style="background: yellow;">Хорошо</td>';
                }

                if ($row1['score'] == '3') {
                     echo '<td style="background: red;
                  color: white;">Плохо</td>';
                }

                if ($row1['score'] == '5') {
                     echo '<td style="background: green;
                  color: white;">Отлично</td>';
                }


                echo ' <td>'.$row1['comment'].'</td>';

            }


             echo '</tr>
             ';
            }
           


            ?>
          </table>
          
        </div>
</main>
<?php require_once('footer.php'); ?>