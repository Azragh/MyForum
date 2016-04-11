<?php

	$_SESSION["rating"] = "";

	if (isset($_GET['tid']) && isset($_GET['rating'])) {

		$id = $_GET['tid'];
		$rating = $_GET['rating'];
		$isRated = false;

		if ($rating > 5){
            $rating = 5;
        }
		if ($rating < 1){
            $rating = 1;
        }

		$qu = mysqli_query($con, "SELECT * FROM threads WHERE id='$id'") or die(mysql_error());
		if (mysqli_num_rows($qu) > 0) {

			$info = mysqli_fetch_array($qu) or die(mysql_error());
			$newRatings = $info['totalRatings'] + 1;
			$newTotal = $info['rating'] + $rating;

			$q = mysqli_query($con, "UPDATE threads SET rating='$newTotal', totalRatings='$newRatings' WHERE id='$id'") or die(mysql_error());
			if ($q) {
				echo "<p class='success-inline'>Der Beitrag wurde bewertet. <a href='thread.php?tid=" . $id . "'>Zurück</a></p>";
				// call alert on next page..? #nomessage 
				// header("Location: thread.php?tid=" . $id );
			} else {
				echo "<p class='error-inline'>Der Beitrag konnte nicht bewertet werden. <a href='thread.php?tid=" . $id . "'>Zurück</a></p>";
				// call alert on next page..? #nomessage
				// header("Location: thread.php?tid=" . $id );
			}

		}

	} else {
		echo "<p class='error-inline'>Die Beitrags-ID in der URL scheint nicht zu stimmen..</p>";
    }

?>
