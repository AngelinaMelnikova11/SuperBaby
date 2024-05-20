<?
require_once('vendor/connect.php');
$id_submission = $_POST['id_submission'];
$query4 = "DELETE FROM `submission` WHERE `id` = '$id_submission'";
$result4 = mysqli_query($connect, $query4) or die(mysqli_error($connect));
header('Location: profile.php');