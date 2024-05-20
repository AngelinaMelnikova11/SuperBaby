<?php require_once('header.php');?>

<script>
/*открываю попап*/
$(document).ready(function() { 
  $('button#start1').click( function(event){ 
    event.preventDefault(); 
    $('#overlay1').fadeIn(250, 
      function(){
        $('#popUp1') 
          .css('display', 'block') 
          .animate({opacity: 1}, 490); 
    });
  });
/*по нажатию на крестик закрываю окно*/
  $('#close1, #overlay1').click( function(){ 
    $('#popUp1')
      .animate({opacity: 0}, 490, 
        function(){ 
          $(this).css('display', 'none'); 
          $('#overlay1').fadeOut(220); 
        }
      );
  });
});
</script>
<div id="overlay1"></div>
<main>
	<h1 class="h1_img">Занятия</h1>
    <button class="sub" id="start1" style="width: auto;">Добавить занятие</button>
                <div class="pagination_section">
                <?
                 if (isset($_GET['page'])){
                    $page = $_GET['page'];
                }else {
                    $page = 1;
                }

                $kol = 4;  // количество записей для вывода
                $art = ($page * $kol) - $kol;
    
                $id_group = $_SESSION['user']['group_id'];
                // Определяем все количество записей в таблице
                $res = mysqli_query($connect,"SELECT COUNT(*) FROM `lesson` where id_group='$id_group'");
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
                    echo "<a href=lesson.php?page=".$prev."><< Предыдущая</a>"; 
                }
                ?>
                <a class="active" style="color: white;"><? echo $page.'/'.($i-1); ?></a>
                <?
                if($page == ($i-1)){
                    echo "<a>Следующая >></a>";
                }else{
                    echo "<a href=lesson.php?page=".$prev2.">Следующая >></a>";
                }
                ?>
            </div>
	   <div class="table-wrap">
          <table class="table-1">
            <tr>
              <th>Дата проведения</th>
              <th>План занятия</th>
              <th>Управление</th>
            </tr>
            <?
            $id_group = $_SESSION['user']['group_id'];
            $result = mysqli_query($connect, "SELECT * FROM `lesson` where id_group='$id_group' ORDER BY `data` DESC LIMIT $art,$kol") or die(mysqli_error($connect));
            $row = mysqli_num_rows($result);

            foreach ($result as $row) {
                echo "<tr><form method='post'>";
                echo "<input type='hidden' value='".$row['id']."' name='id_lesson'>";
                echo "<td>". $row['data'] ."</td>";
                echo "<td>". $row['workplan'] ."</td>";
                echo '<td><button name="che123" type="submit" style="display: flex;justify-content: center;align-items: center;width: 100%;font-size: 14pt">Список группы</button></form>';
                $id_lesson = $row['id'];
                $result22 = mysqli_query($connect, "SELECT * FROM `omission` where id_lesson = '$id_lesson'") or die(mysqli_error($connect));
                if(mysqli_num_rows($result22) <= 0){
                echo '<form method="post">
                    <input type="hidden" name="id_lesson" value="'.$row['id'].'">
                    <button name="delete_lesson" type="submit" style="display: flex;justify-content: center;align-items: center;width: 100%;font-size: 14pt;background:red;">Удалить</button>
                </form>';
                }
                echo '</td>';
                echo "</tr>";
            }
            if (isset($_POST['delete_lesson'])) {
                $id_lesson12 = $_POST['id_lesson'];
                $query4 = "DELETE FROM `lesson` WHERE `id` = '$id_lesson12'";
                $result4 = mysqli_query($connect, $query4) or die(mysqli_error($connect));
                echo '<meta http-equiv="refresh" content="1">';
            }
            ?>
           
          </table>
        </div>
</main>
<?php require_once('footer.php'); ?>