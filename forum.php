<?php require_once "tmpl/header.php";  ?>

    <h1>Forum</h1>

    <?php
        if (!isset($_SESSION["user"])){
            echo "<p class='info'>Please login to post a comment. If you do not have an account yet, you can register here <a href='register.php'>Register</a>.";
        } else {
            echo "<p>Welcome, " . $_SESSION['user'] . "!</p>";
            echo "<p>Your Role: " . $_SESSION['role'] . "</p>";
            if ( $_SESSION['role'] == "admin" ) {
                require "inc/forms/threadform.php";
            }
        }
if (!isset($_SESSION["user"])){
} else {
            if ( $_SESSION['role'] == "user" ) {
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
