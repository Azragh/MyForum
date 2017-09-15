<?php

	if (isset($_GET['tid']) && isset($_GET['rating'])) {

		$id = $_GET['tid'];
		$rating = $_GET['rating'];

		// check if thread has been rated before
		$qq = mysqli_query($db, "SELECT * FROM ratings WHERE threadID='$id' AND user_ip='$user_ip'") or die(mysql_error());
		if (mysqli_num_rows($qq) > 0) {
			$errors .= "<p class='error'>You have already rated this post. <a href='thread.php?tid=$id'> Back </a></p>";

		} else {

			if ($rating > 5){
				$rating = 5;
			}
			if ($rating < 1){
				$rating = 1;
			}

			// select thread
			$qu = mysqli_query($db, "SELECT * FROM threads WHERE id='$id'") or die(mysql_error());
			if (mysqli_num_rows($qu) > 0) {

				$info = mysqli_fetch_array($qu) or die(mysql_error());
				$newRatings = $info['totalRatings'] + 1;
				$newTotal = $info['rating'] + $rating;

				// insert new ratings in db
				$q = mysqli_query($db, "UPDATE threads SET rating='$newTotal', totalRatings='$newRatings' WHERE id='$id'") or die(mysql_error());
				$qr = mysqli_query($db, "INSERT INTO ratings SET threadID='$id', user_ip='$user_ip'") or die(mysql_error());

				if ( $q && $qr ) {
					$success .= "<p class='success'>The contribution was evaluated. <a href='thread.php?tid=$id'> Back </a></p>";
				} else {
					$errors .= "<p class='error'>The contribution could not be evaluated. <a href='thread.php?tid=$id'> Back </a></p>";
				}

			}

		}

	}

?>
