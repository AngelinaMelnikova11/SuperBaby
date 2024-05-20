<?
session_start();
    $connect = mysqli_connect('localhost', 'root', 'root', 'baby');

    if (!$connect) {
        die('Error connect to DataBase');
    }
  $id_message = $_POST['id_message'];

   $result1 = mysqli_query($connect, "SELECT * FROM `file` WHERE id = '$id_message'") or die(mysqli_error($connect));
   $row1 = mysqli_num_rows($result1);
    foreach ($result1 as $row1) {
      $locname = $row1['file'];
    }

  if( file_exists($locname)){
    $filesize =filesize($locname); 
    $type = filetype($locname); 
    header("Content-type: $type"); 
    header("Content-Disposition: attachment;filename=$locname"); 
    header("Content-Transfer-Encoding: binary"); 
    header("Content-type: application/octet-stream"); 
    header("Content-Length: "."$filesize"); 
    header('Pragma: no-cache'); 
    header('Expires: 0'); 

    set_time_limit(0); 
    readfile($locname); 
    $new_url = "chat.php"; 
    header("Location: ".$new_url); 
    exit();
  } 
