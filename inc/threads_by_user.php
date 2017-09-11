<?php

	if ( isset($_GET['user']) && $_GET['user'] != '') {

		$getuser = $_GET['user'];
		$q = mysqli_query($db, "SELECT * FROM threads WHERE author='$getuser'");

		if (mysqli_num_rows($q) > 0) {

			$row = mysqli_fetch_array($q);
			echo "<h2>Beiträge von " . $row["author"] . ":</h2>";

			$q = mysqli_query($db, "SELECT * FROM threads WHERE author='$getuser'");
			while ($row = mysqli_fetch_array($q)) {
				include "inc/thread_preview.php";
			}

		} else {

			$user = strtolower($_SESSION['user']);

			if ( isset($_SESSION['user']) && $user == $_GET['user'] ) {
				echo "<p class='error'>Du hast noch keine öffentlichen Beiträge..</p>";
			} else {
				echo "<p class='error'>Von diesem Benutzer wurden noch keine Beiträge veröffentlicht..</p>";
			}

        }


	}

?>
