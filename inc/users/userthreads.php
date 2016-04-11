<?php

	if (isSet($_GET['user']) && $_GET['user'] != '') {

		$getuser = $_GET['user'];
		$q = mysqli_query($con, "SELECT * FROM threads WHERE author='$getuser'");
        $qn = mysqli_query($con, "SELECT * FROM threads WHERE author='$getuser'");

        $inf = mysqli_fetch_array($qn);
        echo "<h1>Beiträge von " . $inf["author"] . "</h1>";

		if (mysqli_num_rows($q) > 0) {

			while ($row = mysqli_fetch_array($q)) {
                require "inc/forum/tmpl/threadpreview.php";
			}

		} else {
            echo "<p class='error-inline'>Von diesem Benutzer gibt es (noch) keine Beiträge..</p>";
        }
	}

?>
