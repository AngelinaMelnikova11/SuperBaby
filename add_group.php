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
$name_group = $_POST['name_group'];
$quantity = $_POST['quantity'];

if (isset($_POST['add'])){
    $user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM team WHERE name='$name_group'"));
    if (!empty($user)){

    }else{

    mysqli_query($connect, "INSERT INTO `team` (`id`, `name`, `quantity`, `status`) VALUES (NULL, '$name_group', '$quantity','free')");

    echo '<script>location.replace("add_group.php");</script>';}
}
$name_new = $_POST['name_new'];
if (isset($_POST['upd'])){
    $user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM team WHERE name='$name_new'"));
    if (!empty($user)){
        $_SESSION['message1'] = 'Имя уже существует';
    }else{
    $id_group =  $_POST['id_group'];
    mysqli_query($connect, "UPDATE `team` SET `name` = '$name_new' WHERE `id` = '$id_group'");

    echo '<script>location.replace("add_group.php");</script>';}
}
if (isset($_POST['del'])) {
                    $id_group = $_POST['id_group'];

                    mysqli_query($connect, "UPDATE `users` SET `group_id` = '-' WHERE `group_id` = '$id_group'");

                    mysqli_query($connect, "UPDATE `child` SET `group_id` = '-' WHERE `group_id` = '$id_group'");

                    $query4 = "DELETE FROM `team` WHERE `id` = '$id_group'";

                    $result4 = mysqli_query($connect, $query4) or die(mysqli_error($connect));
                    echo '<meta http-equiv="refresh" content="0">';
            }
 ?>
<body>
<div class="acab" >
    <h1 class="h1_img">Управление группами</h1>
    <div class="prof3" >
        <div style="padding: 0 20px 20px 20px;">
        <form class="add_group"  method="post" >
                <h2>Форма создания группы</h2>
                <input class="input-words" required type="text" name="name_group" placeholder="Введите назавание группы">
                <input  required type="number" name="quantity" placeholder="Введите количество мест" min="0" max="99" maxlength="2">
                <button name="add" type="submit" class="sub" style="font-family: 'Dimkin-Regular';display: flex;justify-content: center;align-items: center;">Создать</button>
                 <?php
                    if ($_SESSION['message']) {
                        echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
                    }
                    unset($_SESSION['message']);


                if (isset($_GET['page'])){
                    $page = $_GET['page'];
                }else {
                    $page = 1;
                }

                $kol = 1;  // количество записей для вывода
                $art = ($page * $kol) - $kol;
    

                // Определяем все количество записей в таблице
                $res = mysqli_query($connect,"SELECT COUNT(*) FROM `team`");
                $row = mysqli_fetch_array($res);
                $total = $row[0]; // всего записей
   

                // Количество страниц для пагинации
                $str_pag = ceil($total / $kol);
                for ($i = 1; $i <= $str_pag; $i++){  
                }
                $prev = $page - 1;
                $prev2 = $page + 1;


                ?>
        </form>
    </div>
            
            <div class="catal">
                <?

                $result = mysqli_query($connect, "SELECT * FROM `team` LIMIT $art,$kol") or die(mysqli_error($connect));
                $row = mysqli_num_rows($result);

                foreach ($result as $row) {
                    echo '
                        <div class="kvas11">
                            <form method="post">
                            <input type="hidden" value="'.$row['id'].'" name="id_group">
                                <div class="text-field">
                                  <label class="text-field__label" for="find">Назавание группы:</label>
                                  <div class="text-field__icon">
                                    <input class="text-field__input input-words" type="search" name="name_new" required id="find" placeholder="'.$row['name'].'" value="'.$row['name'].'">
                                    <span class="text-field__aicon-2" type="submit">
                                     <button type="submit" style="background:none;padding:0;width:100%;" name="upd">&#9997;</button>
                                    </span>
                                  </div>
                                </div>
                            </form>
                            <p>Количество свободных мест в группе: '.$row['quantity'].'</p>
                            <div class="zak">
                                <form method="post" action="mentor.php">
                                    <input type="hidden" value="'.$row['id'].'" name="id_group">
                                    <button type="submit" class="btn-2">Добавить воспитателя</button>
                                </form>';
                                if($row['quantity'] <= '0'){
            
                                }else{
                                    echo '
                                    <form method="post" action="child.php">
                                        <input type="hidden" value="'.$row['id'].'" name="id_group">
                                        <button type="submit" class="btn-2">Добавить детей</button>
                                    </form>
                                ';
                                }
                                echo '<form method="post" action="group.php">
                                    <input type="hidden" value="'.$row['id'].'" name="id_group">
                                    <button type="submit" class="btn-2">Полный список группы</button>
                                </form>
                                <form method="post">
                                    <input type="hidden" value="'.$row['id'].'" name="id_group">
                                    <button type="submit" class="btn-2" name="del"> Удалить</button>
                                </form>
                            </div>
                        </div>
                       
                    ';
}
                ?>
            <div class="catal2">

        <div class="pagination_section">
        <?
    if($page == 1){
        echo "<a ><< Предыдущая</a>"; 
    }else{
        echo "<a href=add_group.php?page=".$prev."><< Предыдущая</a>"; 
    }
    ?>
    <a class="active" style="color: white;"><? echo $page.'/'.($i-1); ?></a>
    <?
    if($page == ($i-1)){
        echo "<a>Следующая >></a>";
    }else{
        echo "<a href=add_group.php?page=".$prev2.">Следующая >></a>";
    }
    ?>
</div>
            </div>
        </div>
    </div>

</div>
<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
<script src="https://snipp.ru/cdn/maskedinput/jquery.maskedinput.min.js"></script>
            <script type="text/javascript">
(function() {
  let caseSumsToSep = document.querySelectorAll('span.price');
  caseSumsToSep.forEach(makeNumSep);
  function makeNumSep(item, index) {
    let workValue = item.innerHTML;
    item.innerHTML = parseFloat(workValue).toLocaleString('ru-RU', {minimumFractionDigits: 2, maximumFractionDigits: 2}).replace(',', '.');
  }
}) ();
$('body').on('input', 'input[type="number"][maxlength]', function(){
    if (this.value.length > this.maxLength){
        this.value = this.value.slice(0, this.maxLength);
    }
});
$('body').on('input', '.input-words', function(){
    this.value = this.value.replace(/[^a-zа-яё\s]/gi, '');
});
</script>
<script type="text/javascript">
$('.mask-phone').mask('+7(999)999-99-99');
</script>
</body>
<?php 
}
require_once('footer.php'); ?>