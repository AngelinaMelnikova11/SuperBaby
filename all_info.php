<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>
<?php require_once('header.php');
if ($_SESSION['user']['role'] == 'admin'){
?>
<?

?>
<main>
  <h1 class="h1_img">Полная сводка</h1>
  <form method="post" style="display: flex;align-items: center;flex-direction: row;flex-wrap: wrap;background: white;padding: 5px;border-radius: 5px;margin-bottom: 10px;">

  <div style="padding: 2px;">
    <label for="name_team11">Группа:</label><BR>
      <?$result33 = mysqli_query($connect, "SELECT * FROM `team`") or die(mysqli_error($connect));
        $row33 = mysqli_num_rows($result33);
      echo "
      <input list='name_team1' id='name_team11' style=' width: 100%;
  padding: 15px;
  font-size: 14pt;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;' value='";      
      $result44 = mysqli_query($connect, "SELECT * FROM `team` where id ='".$_COOKIE['group_all']."'") or die(mysqli_error($connect));
      $row44 = mysqli_num_rows($result44);
      foreach ($result44 as $row44){
      echo $row44['name'];}
      echo"'  autocomplete='off' required placeholder='Введите группу' type='text' >
                      <datalist id='name_team1'>";
                              foreach ($result33 as $row33):
                              echo "<option data-value='".$row33['id']."' value='".$row33['name']."'>
                              ";
                      endforeach; 
                     echo' </datalist>
                     ';
      ?>
    </div>
    <div style="padding: 2px;">
      <label for="date1">Дата от:</label>
      <input type="date" id="date15" value="<? echo $_COOKIE['date15']; ?>" required>
    </div>
    <div style="padding: 2px;">
      <label for="date11">Дата до:</label>
      <input type="date" id="date16" value="<? echo $_COOKIE['date16']; ?>" required>
    </div>
    <input type="submit" name="check" class="sub" value="Показать график" id="elme3">
</form>


<script type="text/javascript">

  document.getElementById("date15").onchange = function () {
    var input = document.getElementById("date16");
    input.setAttribute("min", this.value);
  }

  $(document).ready(function() {
    elme3.onclick = function() {
                var date15 = document.getElementById("date15").value;
                var date16 = document.getElementById("date16").value;
                var value2 = $('#name_team11').val();
                document.cookie = "group_all="+$('#name_team1 [value="' + value2 + '"]').data('value')+"";
                document.cookie = "display3=yes";
                document.cookie = "date15=" + date15 + "";
                document.cookie = "date16=" + date16 + "";
        };

});
</script>

<?
if (isset($_POST['check'])) {
  echo '<meta http-equiv="refresh" content="0">';
}
if($_COOKIE['display3'] == 'yes'){
  $qwe22='';
}else{
  $qwe22='opacity:0;';
}
?>


<div class="table-wrap" style="<?echo $qwe22; ?>">
  <form method="post" action="excel.php">
      <input type="hidden" name="date1" value="<? echo $_COOKIE['date15'];?>">
      <input type="hidden" name="date2" value="<? echo $_COOKIE['date16'];?>">
      <input type="hidden" name="group" value="<? echo $_COOKIE['group_all'];?>">
      <button type="submit" class="btn btn-primary profile-button" style="border-radius: 0;background: green;margin-top: 0;">Скачать в Excel <i class="fa fa-download" aria-hidden="true"></i></button>
  </form>
          <table class="table-1">
            <tr>
              <th>#</th>
              <th>ФИО ребенка</th>
              <th>ФИО родителя</th> 
              <th>Номер телефона родителя</th>
              <th>Почта</th>
              <th style="background: red;">Кол-во пропусков</th>
              <th style="background: green;">Кол-во посещений</th>
            </tr>
            <?
            $id_group = $_COOKIE['group_all'];
            $result = mysqli_query($connect, "SELECT * FROM `child` where group_id='$id_group' ORDER BY `first_name`, `middle_name`, `last_name` ASC ") or die(mysqli_error($connect));
            $row = mysqli_num_rows($result);

            $sum1 = 0;
            $sum2 = 0;
            $nub = 1;
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>".$nub++."</td>";
                echo "<td>". $row['first_name'] ." ". $row['middle_name'] ." ". $row['last_name'] ."</td>";
                $parent = $row['parent_id'];
                $result1 = mysqli_query($connect, "SELECT * FROM `users` where id='$parent'") or die(mysqli_error($connect));
                $row1 = mysqli_num_rows($result);

                foreach ($result1 as $row1) {
                    echo "<td>". $row1['first_name'] ." ". $row1['middle_name'] ." ". $row1['last_name'] ."</td>";
                    echo "<td>". $row1['phone'] ."</td>";
                    echo "<td>". $row1['email'] ."</td>";
                }
                $id_child = $row['id'];
                $child = mysqli_query($connect, "SELECT COUNT(*) FROM omission WHERE id_child = '$id_child' AND data_last >= '$date1' AND data_last <= '$date2' AND miss='-'") or die(mysqli_error($connect));
                $nuw_child = mysqli_fetch_row($child)[0];
                echo "<td style='background: red;text-align:center;'>". $nuw_child  ."</td>";

                $child1 = mysqli_query($connect, "SELECT COUNT(*) FROM omission WHERE id_child = '$id_child' AND data_first >= '$date1' AND data_first <= '$date2' AND miss='+'") or die(mysqli_error($connect));
                $nuw_child1 = mysqli_fetch_row($child1)[0];
                echo "<td style='background: green;text-align:center;'>". $nuw_child1  ."</td>";
                $sum1 = $sum1 + $nuw_child;
                $sum2 = $sum2 + $nuw_child1;
                echo '</td>';
                echo "</tr>";
            }


            ?>
           <tr style="font-size: 16pt;">
            <td colspan="5"><b>Всего</b></td>
            <td style='background: red;text-align:center;'><b ><? echo $sum2; ?></b></td>
            <td style='background: green;text-align:center;'><b><? echo $sum1; ?></b></td>
          

           </tr>
          </table>
        </div>


</main>

<?php 
}
require_once('footer.php'); ?>