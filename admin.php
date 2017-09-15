<?php require_once("tmpl/header.php"); ?>

    <h1>Verwaltung</h1>

    <?php

        if (isset($_SESSION["user"]) && $_SESSION['role'] == "admin"){

            $admin = $_SESSION['user'];

            include "admin/list_opencomments.php";

        } else {
            echo "<p class='info'>To manage your posts, you must log in before.</p>";
        }

    ?>

<?php require_once("tmpl/footer.php"); ?>
