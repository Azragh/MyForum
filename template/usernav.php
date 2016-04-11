<ul class="nav usernav">
<?php
    if (isset($_SESSION["user"])){
        $author = $_SESSION["user"];
        echo "<li>Angemeldet als<a href='user.php?user=" . strtolower($author) . "'>" . $author . "</a>.<a href='logout.php'>Abmelden</a></li>";
        echo "<li><a href='account.php'><img class='icon' src='img/settings.png' alt='Account'></a></li>";
    } else {
        echo "<li><a href='login.php'>Anmelden</a></li>";
        echo "<li><a href='register.php'>Registrieren</a></li>";
    }
?>
</ul>
