<?php require_once("tmpl/header.php"); ?>

    <?php

        if (!isset($_SESSION["user"])){
            echo "<p class='info'>Melde dich an, um diesen Beitrag kommentieren zu können. Falls du noch keinen Account hast, kannst du dich hier <a href='register.php'>registrieren</a>.";
        }

        require "inc/thread_content.php";

        if ( $real_id == false ) {
            echo "<p class='error'>Diesen Beitrag scheint es nicht (mehr) zu geben.</p>";
        }

        if ( isset($_SESSION["user"]) && $real_id == true ) {
            require "inc/forms/commentform.php";
        }
    ?>

<?php require_once("tmpl/footer.php"); ?>
