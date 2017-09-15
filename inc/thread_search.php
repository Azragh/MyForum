<?php

	$noresults = false;

	// search with POST['']
	if ( isset($_POST['searchSent']) && isset($_POST['searchQuery']) && $_POST['searchQuery'] != '' ) {

		$s = cleanInput($_POST['searchQuery']);
		$s = strtolower($s);
		$ss = explode(' ', $s);
		$noresults = true;

	// Search with GET['s']
	} else if ( isset($_GET['s']) && $_GET['s'] != '' ) {

		$s = cleanInput($_GET['s']);
		$s = strtolower($s);
		$ss = explode(' ', $s);
		$noresults = true;
	}

	if ( isset($s) ) {

		$_SESSION['lastSearch'] = $s;

		echo "<p>Posts with the tag <strong>" . $s . "</strong>:</p>";

		$q = mysqli_query($db, "SELECT * FROM threads ORDER BY id DESC");
		if (mysqli_num_rows($q) > 0) {

			while ($row = mysqli_fetch_array($q)) {

				$hasTag = false;

				if ($row['tags'] != '') {
					$tags = strtolower($row['tags']);

					for ( $i=0; $i<count($ss); $i++ ) {
						if (strpos($tags, $ss[$i]) !== false) {
							$hasTag = true;
							$noresults = false;
						}
					}

				}

				if ($hasTag){
					require "inc/thread_preview.php";
				}

			}
		}
	}

	if ( $noresults == true ) {
		echo "<p class='error'>You can not post new topics in this forum.</p>";
	}

?>
