<?php if (!isset($_SESSION['user'])): ?>

    <form class="loginform" method="post">
        <div class="form-row">
            <input type="text" name="user" <?php keepUsernameValue(); ?> placeholder="Benutzername" required>
            <input type="password" name="password" placeholder="Passwort" required>
            <button type="submit"><i class="fa fa-lock"></i></button>
        </div>
    </form>

<?php endif; ?>

<?php

    $login_errors = "";

    if (isset($_POST["user"])) {

        // define variables
        $username = $_POST['user'];
        $password = $_POST['password'];
        $login_ok = false;
        $activated_ok = false;
        $userrole = "";

        // check db
        $loginquery = "SELECT username, password, salt, email, activated FROM benutzer WHERE username='" . $username . "'";
        $result = $db->query( $loginquery );

        if( $db->affected_rows == 1 ){

            while( $row = $result->fetch_assoc() ) {

                $check_password = hash('sha256', $password . $row['salt']);

                for($round = 0; $round < 65536; $round++) {
                    $check_password = hash('sha256', $check_password . $row['salt']);
                }

                if($check_password === $row['password']) {
                    $login_ok = true;
                    $_SESSION["email"] = $row["email"];
                }

                if ( $row['activated'] == 1 ) {
                    $activated_ok = true;
                }
            }
        }

        // check user role
        $rolequery = "SELECT username, role FROM benutzer WHERE username='" . $username . "'";
        $result = $db->query( $rolequery );

        if( $db->affected_rows == 1 ){
            $row = $result->fetch_assoc();
            $userrole = $row['role'];
            if ( $userrole == "admin" ) {
                $_SESSION['role'] = "admin";
            } else if ( $userrole == "user" ) {
                $_SESSION['role'] = "user";
            }
        }

        // check login and if account is active
        if ( $login_ok && $activated_ok ) {
            $_SESSION["user"] = $username;
            $_SESSION["activated"] = "activated";

        } else if ( $login_ok && $activated_ok == false ) {
            $login_errors .= "<p class='error'>Der Account ist noch nicht aktiviert worden - überprüfe deine Emails.</p>";
            session_destroy();
            $_SESSION = array();

        } else {
            $login_errors .= "<p class='error'>Falsche anmeldedaten eingegeben..</p>";
            session_destroy();
            $_SESSION = array();
        }

        // redirect
        if ( isset($_SESSION["activated"]) && isset($_SESSION["user"]) && isset($_SESSION["email"]) ){

            if ( isset($_GET['s']) ) {
                $s = $_GET['s'];
                header("Location: search.php?s=$s");
                $result->free();
            } else if ( isset($_SESSION['lastSearch']) ) {
                $s = $_SESSION['lastSearch'];
                header("Location: search.php?s=$s");
                $result->free();
            } else {
                echo "<script>window.location='" . $refering_url . "'</script>";
                $result->free();
            }
        }
    }
?>
