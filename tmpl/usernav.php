<ul class="nav usernav">
    <?php
        if (isset($_SESSION["user"])){
            $author = $_SESSION["user"];
            echo "<li>Angemeldet als<a href='forum.php?user=" . strtolower($author) . "'>" . $author . "</a>.<a href='logout.php'>Abmelden</a></li>";
            if ($_SESSION['role'] == 'admin') {
                echo "<li><a href='admin.php'>Verwaltung</a></li>";
            }
        } else {
            echo "<li><a href='register.php'>Registrieren</a></li>";
        }
    ?>
</ul>
