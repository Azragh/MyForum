<h2>Letzte Beiträge:</h2>
<?php

    $nq = mysqli_query($db, "SELECT * FROM threads ORDER BY id DESC LIMIT 3");

    if (mysqli_num_rows($nq) > 0) {

        while ($row = mysqli_fetch_array($nq)) {
            require "inc/thread_preview.php";
        }

    } else {
        echo "<p class='error'>Keine Beiträge gefunden..</p>";
    }

?>
