<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>

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
                $res = mysqli_query($connect,"SELECT COUNT(*) FROM `users` where role='mentor' or role='user'");
                $row = mysqli_fetch_array($res);
                $total = $row[0]; // всего записей
   

                // Количество страниц для пагинации
                $str_pag = ceil($total / $kol);
                for ($i = 1; $i <= $str_pag; $i++){  
                }
                $prev = $page - 1;
                $prev2 = $page + 1;
?>
<div class="acaab" >
<h1  class="h1_img" >Управление аккаунтами</h1>

            <div class="pagination_section">
                <?
                if($page == 1){
                    echo "<a ><< Предыдущая</a>"; 
                }else{
                    echo "<a href=workers.php?page=".$prev."><< Предыдущая</a>"; 
                }
                ?>
                <a class="active" style="color: white;"><? echo $page.'/'.($i-1); ?></a>
                <?
                if($page == ($i-1)){
                    echo "<a>Следующая >></a>";
                }else{
                    echo "<a href=workers.php?page=".$prev2.">Следующая >></a>";
                }
                ?>
            </div>
  <div class="cadi1">

<?
        $id = $_SESSION['user']['id'];
        $result = mysqli_query($connect, "SELECT * FROM `users` where role='mentor' or role='user' LIMIT $art,$kol") or die(mysqli_error($connect));
        $row = mysqli_num_rows($result);
        if (mysqli_num_rows($result) > 0){

      foreach ($result as $row) {
         $id=$row['id'];

          $first_name=$row['first_name'];
          $middle_name=$row['middle_name'];
          $last_name=$row['last_name'];
           $email=$row['email'];
           $phone=$row['phone'];
           $role=$row['role'];

        echo "

                        <form  method='post' class='cardi' >
                          <input type='hidden' readonly value='$id' class='maininppp' name='id'>
                          <p>ФИО: $first_name $middle_name $last_name</p>
                          <p>Почта: $email</p>
                          <p>Телефон: $phone</p>
                          <p>Роль: $role</p>";  
                          if($row['block']=="+"){
                            echo "<input class='sub' type='submit' value='Разблокировать аккаунт' style='text-decoration: none;background:#456fce;' name='del2'>";
                          }else{
                            echo "<input class='sub' type='submit' value='Заблокировать аккаунт' style='text-decoration: none;background:#dd84fa;' name='dell'>";
                          }
                          echo"
                        </form>
                        ";
      }
  }
  else {}
       if (isset($_POST['dell'])) {
                    $id = $_POST['id'];
                    $query5 = "UPDATE `users` SET block='+' WHERE `id` = '$id'";
                    $result5 = mysqli_query($connect, $query5) or die(mysqli_error($connect));
                    echo '<meta http-equiv="refresh" content="0">';
            }
            if (isset($_POST['del2'])) {
                    $id = $_POST['id'];
                    $query5 = "UPDATE `users` SET block='-' WHERE `id` = '$id'";
                    $result5 = mysqli_query($connect, $query5) or die(mysqli_error($connect));
                    echo '<meta http-equiv="refresh" content="0">';
            }
        ?>
</div>
</div>
<?php 
}
require_once('footer.php'); ?>
