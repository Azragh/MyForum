<?php

    $nq = mysqli_query($con, "SELECT * FROM (SELECT * FROM threads ORDER BY id DESC LIMIT 3) t ORDER BY id ASC");

    if (mysqli_num_rows($nq) > 0) {
        while ($row = mysqli_fetch_array($nq)) {
            require "inc/forum/tmpl/threadpreview.php";
        }
        
    }

?>
