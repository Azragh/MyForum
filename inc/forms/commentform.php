<div class="form-container">
    <h3>Write a Comment:</h3>
    <form class="form" action="<?php echo 'thread.php?tid=' . $_GET["tid"]; ?>" method="POST">
        <div class="form-row">
            <textarea name="cont" rows="4" required></textarea>
        </div>
        <div class="form-row">
            <button type="submit" name="replySent"><span>Comment Send</span></button>
        </div>
    </form>
</div>

<?php
    if (isset($_POST["replySent"])
    && isset($_POST["cont"]) && $_POST["cont"] != ""
    && isset($_GET["tid"]) && $_GET["tid"] != "" ) {

        $cont = $_POST["cont"];
        $thread = $_GET["tid"];
        $user = $_SESSION["user"];
        $role = $_SESSION["role"];

        $errors = "";
        $success = "";
        $insertquery = "";
        $threadauth = "";

        if ( $role == "admin" ) {
            $insertquery = "INSERT INTO replies VALUES ('', '$thread', '$cont', '$user', '1')";
        } else {
            $insertquery = "INSERT INTO replies VALUES ('', '$thread', '$cont', '$user', '0')";
        }

        if ( $db->query($insertquery) == TRUE ) {

            if ( $role == "user" ) {
                $success = "<p class='success'>Your comment will be entered as soon as it is released by the author of the post. Many Thanks!</p>";
            } else {
                $success = "<p class='success'>Comment has been entered.</p>";

                // send notification mails to followers
                $qu = mysqli_query($db, "SELECT * FROM subscriptions WHERE threadID='$thread'");
                if (mysqli_num_rows($qu) > 0) {

                    $threadid = $thread;

                    while ($row = mysqli_fetch_array($qu)) {
                        $email = $row['email'];
                        include 'inc/mails/comment_subscriptions.php';
                    }

                }

            }

            // send notification mail to author
            $aq = mysqli_query($db, "SELECT * FROM benutzer WHERE username='$author'");
            if ( mysqli_num_rows($aq) > 0 ){

                $row = mysqli_fetch_array($aq);
                include 'inc/mails/comment_notification.php';

            }


        } else {
            $errors .= "<p class='error'>Comment entry failed.</p>";
        }
    }

    echo $errors;
    echo $success;
    $errors = "";
    $success = "";

?>
