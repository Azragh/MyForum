<?php

    $qu = mysqli_query($con, "SELECT * FROM threads ORDER BY id DESC");

    if (mysqli_num_rows($qu) > 0) {
        while ($row = mysqli_fetch_array($qu)) {
            require "inc/forum/tmpl/threadpreview.php";
        }
        
    } else {
        echo "<p class='error-inline'>Keine Beiträge gefunden..</p>";
    }

?>
