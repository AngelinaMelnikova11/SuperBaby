<?php require_once('header.php');?>
<main>
	<h1 class="h1_img">Меню действительно с

<?
$result = mysqli_query($connect, "SELECT * FROM `data_menu`") or die(mysqli_error($connect));
        $row = mysqli_num_rows($result);
        foreach ($result as $row) {
        	echo $row['to_date'].' по '.$row['be_date'];
        }
?>

	</h1>
	<div class="menu">
		<div class="m">
			<h2 class="name_menu1">ЗАВТРАК</h2>
			<ul>
				<? 
				$result = mysqli_query($connect, "SELECT * FROM `breakfast`") or die(mysqli_error($connect));
        		$row = mysqli_num_rows($result);
        		foreach ($result as $row) {
        			echo "<li>". $row['name'] ."</li>";
        		}
				 ?>
			</ul>
		</div>

		<div class="m">
			<h2 class="name_menu3">ОБЕД</h2>
			<ul>
				<? 
				$result = mysqli_query($connect, "SELECT * FROM `brunch`") or die(mysqli_error($connect));
        		$row = mysqli_num_rows($result);

        		foreach ($result as $row) {
        			echo "<li>". $row['name'] ."</li>";
        		}
				 ?>
			</ul>
		</div>

		<div class="m">
			<h2 class="name_menu4">УЖИН</h2>
			<ul>
				<? 
				$result = mysqli_query($connect, "SELECT * FROM `dinner`") or die(mysqli_error($connect));
        		$row = mysqli_num_rows($result);

        		foreach ($result as $row) {
        			echo "<li>". $row['name'] ."</li>";
        		}
				 ?>
			</ul>
		</div>

		<div class="m">
			<h2 class="name_menu2">ЛАНЧ</h2>
			<ul>
				<? 
				$result = mysqli_query($connect, "SELECT * FROM `lunch`") or die(mysqli_error($connect));
        		$row = mysqli_num_rows($result);

        		foreach ($result as $row) {
        			echo "<li>". $row['name'] ."</li>";
        		}
				 ?>
			</ul>
		</div>
	</div>
</main>
<?php require_once('footer.php'); ?>