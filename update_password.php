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
                $res = mysqli_query($connect,"SELECT COUNT(*) FROM `back`");
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
<h1  class="h1_img" >Заявки на изменение пароля</h1>
<div class="pagination_section">
                <?
                if($page == 1){
                    echo "<a ><< Предыдущая</a>"; 
                }else{
                    echo "<a href=update_password.php?page=".$prev."><< Предыдущая</a>"; 
                }
                ?>
                <a class="active" style="color: white;"><? echo $page.'/'.($i-1); ?></a>
                <?
                if($page == ($i-1)){
                    echo "<a>Следующая >></a>";
                }else{
                    echo "<a href=update_password.php?page=".$prev2.">Следующая >></a>";
                }
                ?>
            </div>
  <div class="cadi1">

<?
        $id = $_SESSION['user']['id'];
        $result = mysqli_query($connect, "SELECT * FROM `back` LIMIT $art,$kol") or die(mysqli_error($connect));
        $row = mysqli_num_rows($result);
        if (mysqli_num_rows($result) > 0){

      foreach ($result as $row) {
         $id=$row['id'];
         $email=$row['email'];


        echo "

                        <form  method='post' class='cardi' >
                          Почта запроса
                          <input type='text' readonly value='$email' class='maininppp' readonly name='email'>
                          <input type='hidden' readonly value='$id' class='maininppp' name='id'>
                          <input type='text' name='new_password' placeholder='Введите новый пароль'>
                          ";  
                          if($row['status']=="new"){
                            echo "<input class='sub' type='submit' value='Изменить пароль' style='text-decoration: none;background:#dd84fa;' name='del2'>";
                          }else{
                            echo "<input class='sub' type='submit' value='Удалить' style='text-decoration: none;background:#dd84fa;' name='dell'>";
                          }
                          echo"
                        </form>
                        ";
      }
  }
  else {}
       if (isset($_POST['dell'])) {
                    $id = $_POST['id'];
                    $query5 = "DELETE FROM `back` WHERE `id` = '$id'";
                    $result5 = mysqli_query($connect, $query5) or die(mysqli_error($connect));
                    echo '<meta http-equiv="refresh" content="0">';
            }
            if (isset($_POST['del2'])) {
                    $email = $_POST['email'];
                    $id = $_POST['id'];
                    $new_password = $_POST['new_password'];
                    $new_password = md5($new_password);
                    $query5 = "UPDATE `users` SET password='$new_password' WHERE `email` = '$email'";
                    $query6 = "UPDATE `back` SET status='no_new' WHERE `id` = '$id'";
                    $result5 = mysqli_query($connect, $query5) or die(mysqli_error($connect));
                    $result6 = mysqli_query($connect, $query6) or die(mysqli_error($connect));
                    echo '<meta http-equiv="refresh" content="0">';
            }
        ?>
</div>
</div>
<?php 
}
require_once('footer.php'); ?>
