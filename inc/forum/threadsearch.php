
<?php

	if (isset($_POST['searchSent']) && isset($_POST['searchQuery']) && $_POST['searchQuery'] != '') {

		$s = $_POST['searchQuery'];
		$s = strtolower($s);
		$ss = explode(' ', $s);
		$noresults = true;

		echo "<p>Ihre Suchergebnisse zu " . $s . ":</p>";

		$q = mysqli_query($con, "SELECT * FROM threads ORDER BY id DESC");
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
					require "inc/forum/tmpl/threadpreview.php";
				}
			}
		}

		if ( $noresults == true ) {
			echo "<p class='error-inline'>Es konnten keine Beiträge mit entsprechenden Tags gefunden werden.</p>";
		}

	} else {
		echo "<p class='error-inline'>Bitte Suchbegriff eingeben</p>";
	}

?>
