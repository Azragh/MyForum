<div class="box">
<?php

    $replies = array();

    $qu = mysqli_query($db, "SELECT * FROM replies WHERE status='0' ORDER BY id DESC");
    if (mysqli_num_rows($qu) > 0) {

        while ($row = mysqli_fetch_array($qu)) {

            $rid = $row['id'];
            $threadid = $row['threadID'];
            $reauthor = $row['author'];
            $recontent = $row['content'];
            $recontent = nl2br($recontent);

            $qqq = mysqli_query($db, "SELECT * FROM threads WHERE id='$threadid' AND author='$admin'");
            if (mysqli_num_rows($qqq) == 1) {

                $info = mysqli_fetch_array($qqq);
                $threadtitle = $info['title'];

                $replies[$rid]  = "<li class='reply'>";
                $replies[$rid] .= "<div class='reply-author'><a href='forum.php?user=" . strtolower($reauthor) . "'>" . $reauthor . "</a> Antwortet auf den Beitrag <a href='thread.php?tid=".$threadid."'>$threadtitle</a>:</div>";
                $replies[$rid] .= "<div class='reply-content'>" . $recontent . "</div>";
                $replies[$rid] .= "</li>";

                $replies[$rid] .= "<form action='admin.php?free=$rid&tid=$threadid' class='adminform' method='post'>";
                $replies[$rid] .= "<input type='submit' name='freecomment' class='submit-inline' value='Kommentar freigeben'> &nbsp; ";
                $replies[$rid] .= "</form>";

                $replies[$rid] .= "<form action='admin.php?kill=$rid&tid=$threadid' class='adminform' method='post'>";
                $replies[$rid] .= "<input type='submit' name='killcomment' class='submit-inline' value='Kommentar löschen'>";
                $replies[$rid] .= "</form>";

            }

        }

    }

    if ( $replies != array() ){
        echo "<h3>Offene Kommentare zu deinen Beiträgen:</h3>";
        echo "<ul class='replies'>";
        foreach ( $replies as $reply ) {
            echo $reply;
        }
        echo "</ul>";
    } else {
        echo "<h3>Offene Kommentare zu deinen Beiträgen:</h3>";
        echo "<p>Momentan sind keine Kommentare offen.</p>";
    }

    // check for errors & success messages
    if (isset($_SESSION['edit_errors'])) {
        echo $_SESSION['edit_errors'];
        unset($_SESSION['edit_errors']);
    }
    if (isset($_SESSION['edit_success'])) {
        echo $_SESSION['edit_success'];
        unset($_SESSION['edit_success']);
    }

    include 'admin/edit_opencomments.php';

?>
</div>
