<h2>Alle Beiträge:</h2>
<?php

    $qu = mysqli_query($db, "SELECT * FROM threads ORDER BY id DESC");

    if (mysqli_num_rows($qu) > 0) {

        while ($row = mysqli_fetch_array($qu)) {
            require "inc/thread_preview.php";
        }

    } else {
        echo "<p class='error'>No posts found.</p>";
    }

?>
