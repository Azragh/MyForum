<?php

    if ( isset($_GET['free']) && isset($_GET['tid']) ) {

        $id = $_GET['free'];
        $threadid = $_GET['tid'];

        $query = mysqli_query($db, "UPDATE replies SET status='1' WHERE id='$id'");
        if ($query){

            $edit_success = "<p class='success'>The comment has been released.</p>";

            // send notification mails to followers
            $qu = mysqli_query($db, "SELECT * FROM subscriptions WHERE threadID='$threadid'");
            if (mysqli_num_rows($qu) > 0) {

                while ($row = mysqli_fetch_array($qu)) {
                    $email = $row['email'];
                    include 'inc/mails/comment_subscriptions.php';
                }

            }

        } else {
            $edit_errors = "<p class='error'>The comment could not be shared.</p>";
        }

        $_SESSION['edit_errors'] = $edit_errors;
        $_SESSION['edit_success'] = $edit_success;

        header("Location: admin.php");

    }

    if (isset($_GET['kill'])) {

        $id = $_GET['kill'];

        $query = mysqli_query($db, "DELETE FROM replies WHERE id='$id'");
        if ($query){
            $edit_success = "<p class='success'>The comment has been deleted.</p>";
        } else {
            $edit_errors = "<p class='error'>The comment could not be deleted.</p>";
        }

        $_SESSION['edit_errors'] = $edit_errors;
        $_SESSION['edit_success'] = $edit_success;

        header("Location: admin.php");

    }

?>
