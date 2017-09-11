<?php require_once "tmpl/header.php";  ?>

    <h1>Forum</h1>

    <?php
        if (!isset($_SESSION["user"])){
            echo "<p class='info'>Melde dich an, um Beiträge verfassen und kommentieren zu können. Wenn du noch keinen Account hast, kannst du dich hier <a href='register.php'>registrieren</a>.";
        } else {
            echo "<p>Willkommen, " . $_SESSION['user'] . "!</p>";
            echo "<p>Deine Benutzerrolle: " . $_SESSION['role'] . "</p>";
            if ( $_SESSION['role'] == "admin" ) {
                require "inc/forms/threadform.php";
            }
        }

        if (!isset($_GET["user"])){
	        require "inc/threads_all.php";
        } else {
            require "inc/threads_by_user.php";
        }
    ?>

<?php require_once "tmpl/footer.php";  ?>
