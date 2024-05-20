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
  <h1 class="h1_img">График посещаемости</h1>
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
      $result44 = mysqli_query($connect, "SELECT * FROM `team` where id ='".$_COOKIE['group']."'") or die(mysqli_error($connect));
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
      <input type="date" id="date12" value="<? echo $_COOKIE['data']; ?>" required>
    </div>
    <div style="padding: 2px;">
      <label for="date11">Дата до:</label>
      <input type="date" id="date11" value="<? echo $_COOKIE['data1']; ?>" required min="">
    </div>
    <input type="submit" name="check" class="sub" value="Показать график" id="elme3">
</form>
<script type="text/javascript">

  document.getElementById("date12").onchange = function () {
    var input = document.getElementById("date11");
    input.setAttribute("min", this.value);
}

  $(document).ready(function() {
    
    elme3.onclick = function() {
                var data = document.getElementById("date12").value;
                var data1 = document.getElementById("date11").value;
                var value1 = $('#name_team11').val();
                document.cookie = "group="+$('#name_team1 [value="' + value1 + '"]').data('value')+"";
                document.cookie = "display1=yes";
                document.cookie = "data=" + data + "";
                document.cookie = "data1=" + data1 + "";
        };

});
</script>

<?
if (isset($_POST['check'])) {
  echo '<meta http-equiv="refresh" content="0">';
}
if($_COOKIE['display1'] == 'yes'){
  $qwe2='';
}else{
  $qwe2='opacity:0;';
}
?>
<div style="width: 100%;height:100%;padding:20px 0 20px 0;<?echo $qwe2; ?>">
    <canvas id="myChart" style="height: 500px;"></canvas>
</div>
<div style="width: 100%;height:100%;padding:20px 0 20px 0;background:white;<?echo $qwe2; ?>">
    <canvas id="myChart1" style="height: 500px;"></canvas>
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
ctx.canvas.parentNode.style.height = "80%";
ctx.canvas.parentNode.style.width = "80%";

  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: [
        <?
        $group_id = $_COOKIE['group'];
        $date_0 =$_COOKIE['data'];
              $date_1 =$_COOKIE['data1'];
        $result = mysqli_query($connect, "SELECT * FROM `lesson` where id_group = '$group_id' AND data >= '$date_0' AND data <= '$date_1' ORDER BY `data` DESC") or die(mysqli_error($connect));
        $row = mysqli_num_rows($result);
           foreach ($result as $row) {
                echo '"'.$row['data'].'"'.',';}
         ?>
        ],
        datasets: [{
            label: "Отсутствие",
            backgroundColor: '#dd84fa',
            data: [
            <?
            $array = array();

        $group_id =$_COOKIE['group'];
        $date_0 =$_COOKIE['data'];
        $date_1 =$_COOKIE['data1'];
        $result = mysqli_query($connect, "SELECT * FROM `lesson` where id_group = '$group_id' AND data >= '$date_0' AND data <= '$date_1' ORDER BY `data` DESC") or die(mysqli_error($connect));
        $row = mysqli_num_rows($result);
           foreach ($result as $row) {
       
              $date_0 =$_COOKIE['data'];
              $date_1 =$_COOKIE['data1'];
              $id_lesson = $row['id'];
              $users = mysqli_query($connect, "SELECT COUNT(*) FROM omission WHERE id_lesson = '$id_lesson' AND miss ='-'") or die(mysqli_error($connect));
              $nuw_users = mysqli_fetch_row($users)[0];
              $array[] = (int)$nuw_users;
            }
              foreach($array as $myarr)
                {
                  echo $myarr.",";
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

<script>
  var ctx1 = document.getElementById('myChart1').getContext('2d');
const plugin1 = {
  id: 'custom_canvas_background_color',
  beforeDraw: (chart) => {
    const ctx1 = chart.canvas.getContext('2d');
    ctx.save();
    ctx.globalCompositeOperation = 'destination-over';
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, chart.width, chart.height);
    ctx.restore();  
  }
};
ctx1.canvas.parentNode.style.height = "80%";
ctx1.canvas.parentNode.style.width = "80%";

  var chart = new Chart(ctx1, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: [
        <?
        $group_id = $_COOKIE['group'];
        $date_0 =$_COOKIE['data'];
              $date_1 =$_COOKIE['data1'];
        $result = mysqli_query($connect, "SELECT * FROM `lesson` where id_group = '$group_id' AND data >= '$date_0' AND data <= '$date_1' ORDER BY `data` DESC") or die(mysqli_error($connect));
        $row = mysqli_num_rows($result);
           foreach ($result as $row) {
                echo '"'.$row['data'].'"'.',';}
         ?>
        ],
        datasets: [{
            label: "Присутствие",
            backgroundColor: '#456fce',
            data: [
            <?
            $array = array();

        $group_id =$_COOKIE['group'];
        $date_0 =$_COOKIE['data'];
        $date_1 =$_COOKIE['data1'];
        $result = mysqli_query($connect, "SELECT * FROM `lesson` where id_group = '$group_id' AND data >= '$date_0' AND data <= '$date_1' ORDER BY `data` DESC") or die(mysqli_error($connect));
        $row = mysqli_num_rows($result);
           foreach ($result as $row) {
       
              $date_0 =$_COOKIE['data'];
              $date_1 =$_COOKIE['data1'];
              $id_lesson = $row['id'];
              $users = mysqli_query($connect, "SELECT COUNT(*) FROM omission WHERE id_lesson = '$id_lesson' AND miss ='+'") or die(mysqli_error($connect));
              $nuw_users = mysqli_fetch_row($users)[0];
              $array[] = (int)$nuw_users;
            }
              foreach($array as $myarr)
                {
                  echo $myarr.",";
                }
            
            ?>

            ],
        }],


    },
plugins: [plugin1],
option: {
  maintainAspectRatio: false,
}
});
</script>

</main>

<?php 
}
require_once('footer.php'); ?>