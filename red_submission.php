<?php require_once('header.php');
if ($_SESSION['user']['role'] == 'admin'){

if (isset($_GET['page'])){
                    $page = $_GET['page'];
                }else {
                    $page = 1;
                }

                $kol = 4;  // количество записей для вывода
                $art = ($page * $kol) - $kol;
    

                // Определяем все количество записей в таблице
                $res = mysqli_query($connect,"SELECT COUNT(*) FROM `submission` WHERE `status` = 'approval'");
                $row = mysqli_fetch_array($res);
                $total = $row[0]; // всего записей
   

                // Количество страниц для пагинации
                $str_pag = ceil($total / $kol);
                for ($i = 1; $i <= $str_pag; $i++){  
                }
                $prev = $page - 1;
                $prev2 = $page + 1;

  ?>
<main>
	<h1 class="h1_img">Новые заявки</h1>

            <div class="pagination_section">
                <?
                if($page == 1){
                    echo "<a ><< Предыдущая</a>"; 
                }else{
                    echo "<a href=red_submission.php?page=".$prev."><< Предыдущая</a>"; 
                }
                ?>
                <a class="active" style="color: white;"><? echo $page.'/'.($i-1); ?></a>
                <?
                if($page == ($i-1)){
                    echo "<a>Следующая >></a>";
                }else{
                    echo "<a href=red_submission.php?page=".$prev2.">Следующая >></a>";
                }
                ?>
            </div>
	<div class="zavki_all">
<?  
    $id_parent = $_SESSION['user']['id'];
    $result = mysqli_query($connect, "SELECT * FROM `submission` WHERE `status` = 'approval' LIMIT $art,$kol") or die(mysqli_error($connect));
    $row = mysqli_num_rows($result);
    foreach ($result as $row) {
      echo '
      <div class="zavki_one">
        <h2>Заявка</h2>
        <p>ФИО ребенка: '.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'</p>
        <p>Дата рождения ребенка: '.$row['date_br'].'</p>
            <p>Дата создания: '.$row['data_first'].'</p>
            <p>Время создания: '.$row['time_first'].'</p>
            <form method="post">
	            <input type="hidden" value="'.$row['id'].'" name="id_submission">
	            <button type="submit" style="margin: 0;background: #456fce;color:white;width: 150px;padding:10px;font-size:14pt;" name="add">
	                <span class="maintext">✔ Принять</span>
	            </button>
            </form>
            <form method="post">
	            <input type="hidden" value="'.$row['id'].'" name="id_submission">
	            <button type="submit" style="margin: 0;background: #dd84fa;color:white;width:150px;padding:10px;font-size:14pt;" name="otcol">
	                <span class="maintext">✘ Отклонить</span>
	            </button>
            </form>
      </div>
      ';
    }

    if(isset($_POST['add'])){
    	$id_submission = $_POST['id_submission'];
    	$date = ltrim(date('Y-m-d'), 0);
      	$time = ltrim(date('H:i:s'), 0); 
		mysqli_query($connect, "UPDATE `submission` SET `status` = 'approved', `data_last_true` = '$date', `time_last_true` = '$time' WHERE `id` = '$id_submission'") or die(mysqli_error($connect));
		$result1 = mysqli_query($connect, "SELECT * FROM `submission` WHERE `id` = '$id_submission'") or die(mysqli_error($connect));
        $row1 = mysqli_num_rows($result1);
        foreach ($result1 as $row1) {
          $first_name = $row1['first_name'];
          $middle_name = $row1['middle_name'];
          $last_name = $row1['last_name'];
          $id_parent = $row1['id_parent'];
          $date_br = $row1['date_br'];
        }
        mysqli_query($connect, "INSERT INTO `child` (`id`, `first_name`, `middle_name`, `last_name`, `parent_id`, `date_br`, `group_id`) VALUES (NULL, '$first_name', '$middle_name', '$last_name', '$id_parent', '$date_br', '-')") or die(mysqli_error($connect));
		echo '<script>alert("Заявка принята, необходимо добавить ребенка в группу");location.replace("add_group.php");</script>';
    }

    if(isset($_POST['otcol'])){
    	$id_submission = $_POST['id_submission'];
    	$date = ltrim(date('Y-m-d'), 0);
      	$time = ltrim(date('H:i:s'), 0); 
		mysqli_query($connect, "UPDATE `submission` SET `status` = 'rejected', `data_lats_false` = '$date', `time_lats_false` = '$time' WHERE `id` = '$id_submission'") or die(mysqli_error($connect));

		echo '<script>alert("Заявка отклонена");location.replace("red_submission.php");</script>';
    }


        ?>
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
</main>
<?php 
}
require_once('footer.php'); ?>