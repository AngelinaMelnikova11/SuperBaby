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
  <h1 class="h1_img">График успеваемости</h1>
<form method="post" style="display: flex;align-items: center;flex-direction: row;flex-wrap: wrap;background: white;padding: 5px;border-radius: 5px;">
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
      $result44 = mysqli_query($connect, "SELECT * FROM `team` where id ='".$_COOKIE['group1']."'") or die(mysqli_error($connect));
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
      <input type="date" id="date13" value="<? echo $_COOKIE['data2']; ?>" required>
    </div>
    <div style="padding: 2px;">
      <label for="date11">Дата до:</label>
      <input type="date" id="date14" value="<? echo $_COOKIE['data3']; ?>" required>
    </div>
    <input type="submit" name="check" class="sub" value="Показать график" id="elme3">
</form>
<script type="text/javascript">
  document.getElementById("date13").onchange = function () {
    var input = document.getElementById("date14");
    input.setAttribute("min", this.value);
}
  $(document).ready(function() {
    elme3.onclick = function() {
                var data2 = document.getElementById("date13").value;
                var data3 = document.getElementById("date14").value;
                var value2 = $('#name_team11').val();
                document.cookie = "group1="+$('#name_team1 [value="' + value2 + '"]').data('value')+"";
                document.cookie = "display2=yes";
                document.cookie = "data2=" + data2 + "";
                document.cookie = "data3=" + data3 + "";
        };

});
</script>

<?
if (isset($_POST['check'])) {
  echo '<meta http-equiv="refresh" content="0">';
}
if($_COOKIE['display2'] == 'yes'){
  $qwe22='';
}else{
  $qwe22='opacity:0;';
}
?>
<div style="width: 100%;height:100%;padding:20px 0 20px 0;<?echo $qwe22; ?>">
  <form method="post" action="excel2.php">
      <input type="hidden" name="date1" value="<? echo $_COOKIE['data2'];?>">
      <input type="hidden" name="date2" value="<? echo $_COOKIE['data3'];?>">
      <input type="hidden" name="group" value="<? echo $_COOKIE['group1'];?>">
       <button type="submit" class="btn btn-primary profile-button" style="border-radius: 0;background: green">Скачать в Excel <i class="fa fa-download" aria-hidden="true"></i></button>
  </form>
    <canvas id="myChart" style="height: 500px;"></canvas>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
const plugin = {
  id: 'custom_canvas_background_color',
  beforeDraw: (chart) => {
    const ctx = chart.canvas.getContext('2d');
    ctx.save();
    ctx.globalCompositeOperation = 'destination-over';
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, chart.width, chart.height);
    ctx.restore();
  }
};
ctx.canvas.parentNode.style.height = "90%";
ctx.canvas.parentNode.style.width = "90%";

  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: [
        <?
        $group_id =$_COOKIE['group1'];
        $result = mysqli_query($connect, "SELECT * FROM `child` where group_id = '$group_id' ORDER BY `first_name`, `middle_name`, `last_name` ASC") or die(mysqli_error($connect));
        $row = mysqli_num_rows($result);
           foreach ($result as $row) {
                echo '"'.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'"'.',';}
         ?>
        ],
        datasets: [{
            label: "Отлично",
            backgroundColor: 'green',
            data: [
            <?
            $array = array();

        $group_id =$_COOKIE['group1'];
        $result = mysqli_query($connect, "SELECT * FROM `child` where group_id = '$group_id' ORDER BY `first_name`, `middle_name`, `last_name` ASC") or die(mysqli_error($connect));
        $row = mysqli_num_rows($result);
           foreach ($result as $row) {
       
              $date_0 =$_COOKIE['data2'];
              $date_1 =$_COOKIE['data3'];
              $id_child = $row['id'];
              $users = mysqli_query($connect, "SELECT COUNT(*) FROM omission WHERE id_child = '$id_child' AND data_first >= '$date_0' AND data_first <= '$date_1' AND score ='5'") or die(mysqli_error($connect));
              $nuw_users = mysqli_fetch_row($users)[0];
              $array[] = (int)$nuw_users;
            }
              foreach($array as $myarr)
                {
                  echo $myarr.",";
                }
            
            ?>

            ],
        },
        {
            label: "Плохо",
            backgroundColor: 'red',
            data: [
            <?
            $array1 = array();

          $group_id = $_COOKIE['group1'];
          $result1 = mysqli_query($connect, "SELECT * FROM `child` where group_id = '$group_id' ORDER BY `first_name`, `middle_name`, `last_name` ASC") or die(mysqli_error($connect));
          $row1 = mysqli_num_rows($result1);
           foreach ($result1 as $row1) {
       
               $date_0 =$_COOKIE['data2'];
              $date_1 =$_COOKIE['data3'];
              $id_child = $row1['id'];
              $users1 = mysqli_query($connect, "SELECT COUNT(*) FROM omission WHERE id_child = '$id_child' AND data_first >= '$date_0' AND data_first <= '$date_1' AND score ='3'") or die(mysqli_error($connect));
              $nuw_users1 = mysqli_fetch_row($users1)[0];
              $array1[] = (int)$nuw_users1;
            }
              foreach($array1 as $myarr1)
                {
                  echo $myarr1.",";
                }
            
            ?>

            ],
        },
        {
            label: "Хорошо",
            backgroundColor: 'orange',
            data: [
            <?
            $array2 = array();

          $group_id =$_COOKIE['group1'];
          $result2 = mysqli_query($connect, "SELECT * FROM `child` where group_id = '$group_id' ORDER BY `first_name`, `middle_name`, `last_name` ASC") or die(mysqli_error($connect));
          $row2 = mysqli_num_rows($result2);
           foreach ($result2 as $row2) {
       
               $date_0 =$_COOKIE['data2'];
              $date_1 =$_COOKIE['data3'];
              $id_child = $row2['id'];
              $users2 = mysqli_query($connect, "SELECT COUNT(*) FROM omission WHERE id_child = '$id_child' AND data_first >= '$date_0' AND data_first <= '$date_1' AND score ='4'") or die(mysqli_error($connect));
              $nuw_users2 = mysqli_fetch_row($users2)[0];
              $array2[] = (int)$nuw_users2;
            }
              foreach($array2 as $myarr2)
                {
                  echo $myarr2.",";
                }
            
            ?>

            ],
        }],


    },
plugins: [plugin],
option: {
  maintainAspectRatio: false,
}
});
</script>

</main>

<?php 
}
require_once('footer.php'); ?>