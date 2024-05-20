<?php require_once('header.php');?>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<main>

<div id="chat"></div>
<div class="container-fluid h-100">
      <div class="row justify-content-center h-110">
      
        <div class="col-md-8 col-xl-6 chat">
          <div class="card">
            <div class="card-header msg_head">
              <div class="d-flex bd-highlight">
          
                <div class="user_info">
                  <span style="white-space:nowrap">
                    
                    <?
                    $id_user = $_SESSION['user']['id'];
                    $result24 = mysqli_query($connect, "SELECT * FROM `users` WHERE id = '$id_user'") or die(mysqli_error($connect));
                    $row24 = mysqli_num_rows($result24);
                    foreach ($result24 as $row24) {
                    if ($row24['new_mes'] > 0 ){
                      mysqli_query($connect, "UPDATE `users` SET `new_mes` = 0 WHERE `id` = '$id_user'") or die(mysqli_error($connect));
                    }
                  }
                    $group_id = $_SESSION['user']['group_id'];


                    $result = mysqli_query($connect, "SELECT * FROM `team` WHERE id = '$group_id'") or die(mysqli_error($connect));
                    $row = mysqli_num_rows($result);
                    foreach ($result as $row) {
                    echo 'Чат группы: "'.$row['name'].'"';}
                    $work = mysqli_query($connect, "SELECT COUNT(*) FROM message WHERE id_group ='$group_id'") or die(mysqli_error($connect));
                    $num_rows = mysqli_fetch_row($work)[0];

                    $users = mysqli_query($connect, "SELECT COUNT(*) FROM users WHERE group_id ='$group_id'") or die(mysqli_error($connect));
                    $nuw_users = mysqli_fetch_row($users)[0];
                    if(isset($_POST['ref'])){
                    echo '<meta http-equiv="refresh" content="1">';
                    echo '<script>location.replace("chat.php#chat");</script>';}
                    ?>

                  </span>
                  <p style="margin-bottom: 0;"><? echo $nuw_users.' Участников<br>'.$num_rows.' Сообщений'; ?></p>
                </div>
                <form method="post" style="display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: flex-end;
  align-items: baseline;
  align-content: stretch; width: 100%;">
                  <button name="ref" style="border: none;margin: 0;display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: flex-end;
  align-items: baseline;
  align-content: stretch; background: none;text-decoration: none;
  outline:none;
  cursor:pointer;padding: 5px;"><i class="fa fa-refresh" style="border-radius: 50px; background:none;"></i></button>
                </form>
              </div>

            </div>
            <div class="card-body msg_card_body">
            <? 


            $result = mysqli_query($connect, "SELECT * FROM `message` WHERE id_group = '$group_id'") or die(mysqli_error($connect));
            $row = mysqli_num_rows($result);
            foreach ($result as $row) {
                    if($row['id_user'] == $id_user){
                      echo '
              <form method="post" action="check_load.php">
              <div class="d-flex justify-content-end mb-4">

                <div class="msg_cotainer_send">';
                $text21 = $row['text'];
                if (strstr($text21, 'http')) {
                  echo '<a href="'.$row['text'].'">'.$row['text'].'</a>';
                }else{
                  echo $row['text'];
                }

                
                  $id_mes = $row['id'];
                  $allowed = array('png', 'jpg', 'jpeg');

                  $result3 = mysqli_query($connect, "SELECT * FROM `file` WHERE id_message = '$id_mes' AND (SUBSTR(file, -3) = 'jpg' or SUBSTR(file, -3) = 'png' or SUBSTR(file, -4) = 'jpeg')") or die(mysqli_error($connect));
                  $row11 = mysqli_num_rows($result3);


                  $result4 = mysqli_query($connect, "SELECT * FROM `file` WHERE id_message = '$id_mes' AND (SUBSTR(file, -3) = 'zip' or SUBSTR(file, -3) = 'doc' or SUBSTR(file, -4) = 'docx' or SUBSTR(file, -3) = 'pdf' or SUBSTR(file, -4) = 'xlsx' or SUBSTR(file, -3) = 'xls')") or die(mysqli_error($connect));
                  $row4 = mysqli_num_rows($result4);

                  $result5 = mysqli_query($connect, "SELECT * FROM `file` WHERE id_message = '$id_mes' AND (SUBSTR(file, -3) = 'mp4' or SUBSTR(file, -3) = 'mov' or SUBSTR(file, -4) = 'webm' or SUBSTR(file, -3) = 'avi' or SUBSTR(file, -3) = 'flv' or SUBSTR(file, -3) = 'wmv')") or die(mysqli_error($connect));
                  $row5 = mysqli_num_rows($result5);

                  $result6 = mysqli_query($connect, "SELECT * FROM `file` WHERE id_message = '$id_mes' AND (SUBSTR(file, -3) = 'mp3' or SUBSTR(file, -3) = 'ape' or SUBSTR(file, -3) = 'ogg' or SUBSTR(file, -4) = 'aiff' or SUBSTR(file, -4) = 'mpeg' or SUBSTR(file, -3) = 'wav')") or die(mysqli_error($connect));
                  $row6 = mysqli_num_rows($result6);

                        foreach ($result3 as $row11) {
                          echo '<br><div id="gallery">';
                          $allowed = array('png', 'jpg', 'jpeg');
                          $extension = pathinfo($row11['file'], PATHINFO_EXTENSION);
                          if(in_array(strtolower($extension), $allowed)){
                            foreach ($result3 as $row11) {
                                  echo'
                              <img src="'.$row11['file'].'" alt="" tabindex="0" />
                              ';
                            }
                        }
                        echo '<div></div>
                      </div>';
                      }

                      foreach ($result4 as $row4) {
                          $allowed = array('zip' , 'doc' , 'docx' , 'xls' , 'xlsx' , 'pdf');
                          $extension = pathinfo($row4['file'], PATHINFO_EXTENSION);
                          if(in_array(strtolower($extension), $allowed)){
                            foreach ($result4 as $row4) {
                              if(!empty($extension)){
                                  echo'
                              <input type="hidden" value="'.$row4['id'].'" name="id_message"><button class="kak_a">Скачать приложенный файл</button>
                              ';
                              }
                            }
                        }
                      
            }
                      foreach ($result5 as $row5) {
                          $allowed = array('mp4' , 'webm' , 'mov' , 'avi' , 'flv' , 'wmv');
                          $extension = pathinfo($row5['file'], PATHINFO_EXTENSION);
                          if(in_array(strtolower($extension), $allowed)){
                            foreach ($result5 as $row5) {
                                  echo'
                             <br><video
                              width="280"
                              controls
                              poster="https://www.chartboost.com/wp-content/uploads/2015/07/create-video-ads-01.jpg"
                            >
                              <source
                                src="'.$row5['file'].'"
                                type="video/mp4"
                              />
                              <source
                                src="'.$row5['file'].'"
                                type="video/avi"
                              />
                              <source
                                src="'.$row5['file'].'"
                                type="video/flv"
                              />
                              <source
                                src="'.$row5['file'].'"
                                type="video/wmv"
                              />
                              <source
                                src="'.$row5['file'].'"
                                type="video/mov"
                              />
                              <source
                                src="'.$row5['file'].'"
                                type="video/ogg"
                              />
                              <source
                                src="'.$row5['file'].'"
                                type="video/webm"
                              />

                            </video>
                              ';
                            }
                        }
                      }

                      foreach ($result6 as $row6) {
                          $allowed = array('mp3' , 'ape' , 'ogg' , 'aiff', 'mpeg', 'wav');
                          $extension = pathinfo($row6['file'], PATHINFO_EXTENSION);
                          if(in_array(strtolower($extension), $allowed)){
                            foreach ($result6 as $row6) {
                                  echo'
                             <br><audio controls>
                                <source
                                  src="'.$row6['file'].'"
                                  type="audio/ogg; codecs=vorbis"
                                />
                                <source src="'.$row6['file'].'" type="audio/mpeg" />
                                <source src="'.$row6['file'].'" type="audio/ape" />
                                <source src="'.$row6['file'].'" type="audio/ogg" />
                                <source src="'.$row6['file'].'" type="audio/aiff" />
                                <source src="'.$row6['file'].'" type="audio/wav" />
                                
                                <a href="'.$row6['file'].'">Скачайте музыку</a>.
                              </audio>
                                                        ';
                            }
                        }
                      }
                      

                  echo'
                  <span class="msg_time_send">'.$row['time'].' , '.$row['data'].'</span>
                </div>
              </div>
              </form>';
                    }else{
                      echo '
                      <form method="post" action="check_load.php">
                        <div class="d-flex justify-content-start mb-4">
                          <div class="msg_cotainer">
                            <b class="name_mes">';
                            $id_user1 = $row['id_user'];
                            $group_id1 = $row['id_group'];
                            $result1 = mysqli_query($connect, "SELECT * FROM `users` WHERE group_id = '$group_id1' AND id = '$id_user1'") or die(mysqli_error($connect));
                            $row1 = mysqli_num_rows($result1);
                            foreach ($result1 as $row1) {
                              echo $row1['first_name'].' '.$row1['middle_name'].' '.$row1['last_name'];
                            }
                            echo'</b><br>
                            ';
                $text21 = $row['text'];
                if (strstr($text21, 'http')) {
                  echo '<a href="'.$row['text'].'">'.$row['text'].'</a>';
                }else{
                  echo $row['text'];
                }
                  $id_mes = $row['id'];
                  $allowed = array('png', 'jpg', 'jpeg');

                  $result3 = mysqli_query($connect, "SELECT * FROM `file` WHERE id_message = '$id_mes' AND (SUBSTR(file, -3) = 'jpg' or SUBSTR(file, -3) = 'png' or SUBSTR(file, -4) = 'jpeg')") or die(mysqli_error($connect));
                  $row11 = mysqli_num_rows($result3);


                  $result4 = mysqli_query($connect, "SELECT * FROM `file` WHERE id_message = '$id_mes' AND (SUBSTR(file, -3) = 'zip' or SUBSTR(file, -3) = 'doc' or SUBSTR(file, -4) = 'docx' or SUBSTR(file, -3) = 'pdf' or SUBSTR(file, -4) = 'xlsx' or SUBSTR(file, -3) = 'xls')") or die(mysqli_error($connect));
                  $row4 = mysqli_num_rows($result4);

                  $result5 = mysqli_query($connect, "SELECT * FROM `file` WHERE id_message = '$id_mes' AND (SUBSTR(file, -3) = 'mp4' or SUBSTR(file, -3) = 'mov' or SUBSTR(file, -4) = 'webm' or SUBSTR(file, -3) = 'avi' or SUBSTR(file, -3) = 'flv' or SUBSTR(file, -3) = 'wmv')") or die(mysqli_error($connect));
                  $row5 = mysqli_num_rows($result5);

                  $result6 = mysqli_query($connect, "SELECT * FROM `file` WHERE id_message = '$id_mes' AND (SUBSTR(file, -3) = 'mp3' or SUBSTR(file, -3) = 'ape' or SUBSTR(file, -3) = 'ogg' or SUBSTR(file, -4) = 'aiff' or SUBSTR(file, -4) = 'mpeg' or SUBSTR(file, -3) = 'wav')") or die(mysqli_error($connect));
                  $row6 = mysqli_num_rows($result6);

                        foreach ($result3 as $row11) {
                          echo '<br><div id="gallery">';
                          $allowed = array('png', 'jpg', 'jpeg');
                          $extension = pathinfo($row11['file'], PATHINFO_EXTENSION);
                          if(in_array(strtolower($extension), $allowed)){
                            foreach ($result3 as $row11) {
                                  echo'
                              <img src="'.$row11['file'].'" alt="" tabindex="0" />
                              ';
                            }
                        }
                        echo '<div></div>
                      </div>';
                      }

                      foreach ($result4 as $row4) {
                          $allowed = array('zip' , 'doc' , 'docx' , 'xls' , 'xlsx' , 'pdf');
                          $extension = pathinfo($row4['file'], PATHINFO_EXTENSION);
                          if(in_array(strtolower($extension), $allowed)){
                            foreach ($result4 as $row4) {
                              if(!empty($extension)){
                                  echo'
                              <input type="hidden" value="'.$row4['id'].'" name="id_message"><button class="kak_a">Скачать приложенный файл</button>
                              ';
                              }
                            }
                        }
                      
            }
                      foreach ($result5 as $row5) {
                          $allowed = array('mp4' , 'webm' , 'mov' , 'avi' , 'flv' , 'wmv');
                          $extension = pathinfo($row5['file'], PATHINFO_EXTENSION);
                          if(in_array(strtolower($extension), $allowed)){
                            foreach ($result5 as $row5) {
                                  echo'
                             <br><video
                              width="280"
                              controls
                              poster="https://www.chartboost.com/wp-content/uploads/2015/07/create-video-ads-01.jpg"
                            >
                              <source
                                src="'.$row5['file'].'"
                                type="video/mp4"
                              />
                              <source
                                src="'.$row5['file'].'"
                                type="video/avi"
                              />
                              <source
                                src="'.$row5['file'].'"
                                type="video/flv"
                              />
                              <source
                                src="'.$row5['file'].'"
                                type="video/wmv"
                              />
                              <source
                                src="'.$row5['file'].'"
                                type="video/mov"
                              />
                              <source
                                src="'.$row5['file'].'"
                                type="video/ogg"
                              />
                              <source
                                src="'.$row5['file'].'"
                                type="video/webm"
                              />

                            </video>
                              ';
                            }
                        }
                      }

                      foreach ($result6 as $row6) {
                          $allowed = array('mp3' , 'ape' , 'ogg' , 'aiff', 'mpeg', 'wav');
                          $extension = pathinfo($row6['file'], PATHINFO_EXTENSION);
                          if(in_array(strtolower($extension), $allowed)){
                            foreach ($result6 as $row6) {
                                  echo'
                             <br><audio controls>
                                <source
                                  src="'.$row6['file'].'"
                                  type="audio/ogg; codecs=vorbis"
                                />
                                <source src="'.$row6['file'].'" type="audio/mpeg" />
                                <source src="'.$row6['file'].'" type="audio/ape" />
                                <source src="'.$row6['file'].'" type="audio/ogg" />
                                <source src="'.$row6['file'].'" type="audio/aiff" />
                                <source src="'.$row6['file'].'" type="audio/wav" />
                                
                                <a href="'.$row6['file'].'">Скачайте музыку</a>.
                              </audio>
                                                        ';
                            }
                        }
                      }
                      

                  echo'
                            <span class="msg_time">'.$row['time'].' , '.$row['data'].'</span>
                          </div>
                        </div></form>
                      ';
                    }
            }


            if (isset($_POST['send'])){
                for ($i = 0; $i < count($_FILES['img']['name']); $i++){

                }
                $i = $i - 1;
              if ($_POST['text'] != '' || $i > 0) {
                $text = $_POST['text'];
                $date_today = date("m.d.y");
                $today[1] = date("H:i:s"); 
                mysqli_query($connect, "INSERT INTO `message` (`id`, `id_group`, `id_user`, `text`, `time`, `data`) VALUES (NULL, '$group_id', '$id_user', '$text', '$today[1]', '$date_today')") or die(mysqli_error($connect));
                mysqli_query($connect, "UPDATE `users` SET `new_mes` = `new_mes` + 1 WHERE `group_id` = '$group_id' AND id != '$id_user'") or die(mysqli_error($connect));

                for ($i = 0; $i < count($_FILES['img']['name']); $i++){

                $result = mysqli_query($connect, "SELECT * FROM `message` WHERE `time` = '$today[1]' AND `data` = '$date_today' AND id_user ='$id_user' ") or die(mysqli_error($connect));
                $row = mysqli_num_rows($result);
                foreach ($result as $row) {
                $message_id = $row['id'];
                }
                $path = 'uploads/';
                $ext = $_FILES['img']['name'][$i];
                if(!empty($ext)){
                $extension = pathinfo($ext, PATHINFO_EXTENSION);

                //Придумать новое имя файла с расширением загружаемого файла
                $new_name = $path.uniqid().'.'.$extension;

                //и загружаем уже с измененным именем
                move_uploaded_file($_FILES['img']['tmp_name'][$i], $new_name);

                mysqli_query($connect, "INSERT INTO `file` (`id_message`, `file`) VALUES ('$message_id','$new_name')") or die(mysqli_error($connect));
              }}

                echo '<meta http-equiv="refresh" content="1">';
                echo '<script>location.replace("chat.php#chat");</script>';
              }else{}
            }
            ?>
            </div>
            <div class="card-footer">
              <form method="post" enctype="multipart/form-data">
                <div class="input-group">
                  <div class="input-group-append">
                    <label class="input-group-text attach_btn" for="file" style="margin:0;"><i class="fas fa-paperclip" style="<? echo $color; ?>"></i></label>
                    <input type="file" id="file" style="display: none" name='img[]' multiple>
                  </div>
                  <textarea name="text" style="border: none;" class="form-control type_msg" placeholder="Введите свое сообщение..."></textarea>
                  <div class="input-group-append">
                    <button class="input-group-text send_btn" name="send" style="border: none;margin: 0;text-decoration: none;
  outline:none;
  cursor:pointer;"><i class="fas fa-location-arrow"></i></button>
                  </div>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
  $('.card').animate({
  scrollTop: $('.card-body').height()
});
  function animated_scroll(block, delay = 1){
  let y = block.scrollTop; // Откуда начинаем прокручивать
  const dest = block.scrollHeight - block.offsetHeight;  // До куда надо прокрутить
  const interval = 1000 / 1000; // 1 fps 
  const delta = (dest - y) * (interval/delay); // Сколько надо прокрутить за шаг, чтобы за время delay успеть прокрутить до куда надо
  // Поехали
  (function scroll(){
    if(y < dest){
      y += delta;
      block.scrollTop = y;
      setTimeout(scroll, interval);
    }// else мы уже на месте
  })();
}


animated_scroll(document.querySelector('.card-body'))
</script>
<?php 

require_once('footer.php');?>