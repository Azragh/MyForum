<?php require_once("tmpl/header.php"); ?>

    <?php

        if (!isset($_SESSION["user"])){
            echo "<p class='info'>Sign up to comment on this post. If you do not have an account yet, you can register here <a href='register.php'>Register</a>.";
        }

        require "inc/thread_content.php";

        if ( $real_id == false ) {
            echo "<p class='error'>This contribution does not seem to exist anymore.</p>";
        }

        if ( isset($_SESSION["user"]) && $real_id == true ) {
            require "inc/forms/commentform.php";
        }
    ?>

<?php require_once("tmpl/footer.php"); ?>
