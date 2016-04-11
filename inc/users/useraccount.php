<?php
	if (isset( $_SESSION["user"] )){

		$user = $_SESSION['user'];
		$threads = "<ul class='mythreads'>";

		echo "<h2>Deine Beiträge:</h2>";

		$q2 = mysqli_query($con, "SELECT * FROM threads WHERE author='$user'");
		if (mysqli_num_rows($q2) > 0) {
			while ($row = mysqli_fetch_array($q2)) {
				$threads .= '<li><a href="thread.php?tid='.$row["id"].'">'.$row["title"].'</li>';
			}
		}

		$threads .= '</ul>';
		echo $threads;

	} else {
		// alert after redirect..? #nomessage
		header("Location: index.php");
	}
?>
