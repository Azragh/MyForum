<ul class="nav usernav">
    <?php
        if (isset($_SESSION["user"])){
            $author = $_SESSION["user"];
            echo "<li>Logged In As: <a href='forum.php?user=" . strtolower($author) . "'>" . $author . "</a>.<a href='logout.php'>Logout</a></li>";
            if ($_SESSION['role'] == 'admin') {
                echo "<li><a href='admin.php'>Admin CP</a></li>";
            }
        } else {
            echo "<li><a href='register.php'>Register</a></li>";
            echo "<li><a href='login.php'>Login</a></li>";
        }
    ?>
</ul>
