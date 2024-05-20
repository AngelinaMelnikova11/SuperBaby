<?php require_once('header.php');
if ($_SESSION['user']['role'] == 'admin'){
?>
<main>
	<h1 class="h1_img">Меню</h1>
     <?
        if (isset($_POST['upda1'])) {
            $to_date = $_POST['to_date'];
            $be_date = $_POST['be_date'];
            $id = $_POST['id'];

            mysqli_query($connect, "UPDATE `data_menu` SET `to_date` = '$to_date', `be_date` = '$be_date'  WHERE `id` = '$id'");
            echo '<meta http-equiv="refresh" content="1">';
        }

        $result = mysqli_query($connect, "SELECT * FROM `data_menu`") or die(mysqli_error($connect));
        $row = mysqli_num_rows($result);
        foreach ($result as $row) {
                    echo "
                    <form method='post' style='display: flex;align-items: center;flex-direction: row;flex-wrap: wrap;background: white;padding: 5px;border-radius: 5px; width:300px;'>
                        <input type='hidden' value='". $row['id'] ."' name='id'>
                        <label>Дата меню от:</label>
                        <input type='date' value='". $row['to_date'] ."' name='to_date'>
                        <label>Дата меню до:</label>
                        <input type='date' value='". $row['be_date'] ."' name='be_date'>
                        <input type='submit' class='sub' name='upda1' style='width:100%;display: flex;align-items: center;justify-content:center;' value='Обновить'>
                    </form>";
                }

        ?>
	<div class="menu">
		<div class="m1">
			<h2 class="name_menu1">ЗАВТРАК</h2>
							<form method="post">
                                <div class="text-field">
                                  <label class="text-field__label" for="find"></label>
                                  <div class="text-field__icon">
                                    <input class="text-field__input input-words" type="search" name="name" required id="find" placeholder="Введите новое блюдо на завтрак" value="">
                                    <span class="text-field__aicon-2" type="submit">
                                     <button type="submit" style="background:none;padding:0;width:100%;" name="get1">&#9989;</button>
                                    </span>
                                  </div>
                                </div>
                            </form>
			<ul>
				<?
				if (isset($_POST['get1'])){
					$name = $_POST['name'];
					mysqli_query($connect, "INSERT INTO `breakfast` (`id`, `name`) VALUES (NULL, '$name')");
					echo '<meta http-equiv="refresh" content="0">';
				}


				$result = mysqli_query($connect, "SELECT * FROM `breakfast`") or die(mysqli_error($connect));
        		$row = mysqli_num_rows($result);

        		foreach ($result as $row) {
        			echo "<form method='post'><li>". $row['name'] ."<input type='hidden' value='". $row['id'] ."' name='id'>
        			<button class='cl-btn-7' style='background:none;padding:0;' name='del'></button></li>
        			</form>";
        		}

        		if (isset($_POST['del'])){
        			$id = $_POST['id'];
        			$query4 = "DELETE FROM `breakfast` WHERE `id` = '$id'";

                    $result4 = mysqli_query($connect, $query4) or die(mysqli_error($connect));
                    echo '<meta http-equiv="refresh" content="0">';
        		}
				 ?>
			</ul>
		</div>
		
		<div class="m1">
			<h2 class="name_menu3">ОБЕД</h2>
			<form method="post">
                                <div class="text-field">
                                  <label class="text-field__label" for="find"></label>
                                  <div class="text-field__icon">
                                    <input class="text-field__input input-words" type="search" name="name" required id="find" placeholder="Введите новое блюдо на обед" value="">
                                    <span class="text-field__aicon-2" type="submit">
                                     <button type="submit" style="background:none;padding:0;width:100%;" name="get3">&#9989;</button>
                                    </span>
                                  </div>
                                </div>
                            </form>
			<ul>
				<? 
				if (isset($_POST['get3'])){
					$name = $_POST['name'];
					mysqli_query($connect, "INSERT INTO `brunch` (`id`, `name`) VALUES (NULL, '$name')");
					echo '<meta http-equiv="refresh" content="0">';
				}
				$result = mysqli_query($connect, "SELECT * FROM `brunch`") or die(mysqli_error($connect));
        		$row = mysqli_num_rows($result);

        		foreach ($result as $row) {
        			echo "<form method='post'><li>". $row['name'] ."<input type='hidden' value='". $row['id'] ."' name='id'>
        			<button class='cl-btn-7' style='background:none;padding:0;' name='del2'></button></li>
        			</form>
        			";
        		}
        		if (isset($_POST['del2'])){
        			$id = $_POST['id'];
        			$query4 = "DELETE FROM `brunch` WHERE `id` = '$id'";

                    $result4 = mysqli_query($connect, $query4) or die(mysqli_error($connect));
                    echo '<meta http-equiv="refresh" content="0">';
        		}
				 ?>
			</ul>
		</div>
		<div class="m1">
			<h2 class="name_menu4">УЖИН</h2>
			<form method="post">
                                <div class="text-field">
                                  <label class="text-field__label" for="find"></label>
                                  <div class="text-field__icon">
                                    <input class="text-field__input input-words" type="search" name="name" required id="find" placeholder="Введите новое блюдо на ужин" value="">
                                    <span class="text-field__aicon-2" type="submit">
                                     <button type="submit" style="background:none;padding:0;width:100%;" name="get4">&#9989;</button>
                                    </span>
                                  </div>
                                </div>
                            </form>
			<ul>
				<? 
				if (isset($_POST['get4'])){
					$name = $_POST['name'];
					mysqli_query($connect, "INSERT INTO `dinner` (`id`, `name`) VALUES (NULL, '$name')");
					echo '<meta http-equiv="refresh" content="0">';
				}
				$result = mysqli_query($connect, "SELECT * FROM `dinner`") or die(mysqli_error($connect));
        		$row = mysqli_num_rows($result);

        		foreach ($result as $row) {
        			echo "<form method='post'><li>". $row['name'] ."<input type='hidden' value='". $row['id'] ."' name='id'>
        			<button class='cl-btn-7' style='background:none;padding:0;' name='del3'></button></li>
        			</form>
        			";
        		}
        		if (isset($_POST['del3'])){
        			$id = $_POST['id'];
        			$query4 = "DELETE FROM `dinner` WHERE `id` = '$id'";

                    $result4 = mysqli_query($connect, $query4) or die(mysqli_error($connect));
                    echo '<meta http-equiv="refresh" content="0">';
        		}
				 
				 ?>
			</ul>
		</div>

		<div class="m1">
			<h2 class="name_menu2">ЛАНЧ</h2>
			<form method="post">
                                <div class="text-field">
                                  <label class="text-field__label" for="find"></label>
                                  <div class="text-field__icon">
                                    <input class="text-field__input input-words" type="search" name="name" required id="find" placeholder="Введите новое блюдо на ланч" value="">
                                    <span class="text-field__aicon-2" type="submit">
                                     <button type="submit" style="background:none;padding:0;width:100%;" name="get2">&#9989;</button>
                                    </span>
                                  </div>
                                </div>
                            </form>
			<ul>
				<?
				if (isset($_POST['get2'])){
					$name = $_POST['name'];
					mysqli_query($connect, "INSERT INTO `lunch` (`id`, `name`) VALUES (NULL, '$name')");
					echo '<meta http-equiv="refresh" content="0">';
				}
				$result = mysqli_query($connect, "SELECT * FROM `lunch`") or die(mysqli_error($connect));
        		$row = mysqli_num_rows($result);

        		foreach ($result as $row) {
        			echo "<form method='post'><li>". $row['name'] ."
        			
        			<input type='hidden' value='". $row['id'] ."' name='id'>
        			<button class='cl-btn-7' style='background:none;padding:0;' name='del1'></button></li>
        			</form>
        			";
        		}
        		if (isset($_POST['del1'])){
        			$id = $_POST['id'];
        			$query4 = "DELETE FROM `lunch` WHERE `id` = '$id'";

                    $result4 = mysqli_query($connect, $query4) or die(mysqli_error($connect));
                    echo '<meta http-equiv="refresh" content="0">';
        		}
				 ?>
			</ul>
		</div>
	</div>
</main>
<?php }
require_once('footer.php'); ?>