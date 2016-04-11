<div class="form-container">

    <form class="form loginform" method="post">
        <div class="form-row">
            <label>Benutzername:</label><br>
            <input type="text" name="user" <?php keepUsernameValue(); ?> required>
        </div>
        <div class="form-row">
            <label>Passwort:</label><br>
            <input type="password" name="password" required>
        </div>
        <div class="form-row">
            <input type="submit" value="Login">
        </div>
    </form>

    <?php
        if (isset($_POST["user"])) {

            // define variables
            $username = $_POST['user'];
            $password = $_POST['password'];
            $login_ok = false;
            $activated_ok = false;

            // check db
            $loginquery = "SELECT username, password, salt, email, activated FROM benutzer WHERE username='" . $username . "'";
            $result = $con->query( $loginquery );

            if( $con->affected_rows == 1 ){

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

            // check login and if account is active
            if ( $login_ok && $activated_ok ) {
                $_SESSION["user"] = $username;
                $_SESSION["activated"] = "activated";

            } else if ( $login_ok && $activated_ok == false ) {
                echo "<p class='error-inline'>Der Account ist noch nicht aktiviert worden - überprüfe deine Emails.</p>";
                session_destroy();
                $_SESSION = array();

            } else {
                echo "<p class='error-inline'>Falsche anmeldedaten eingegeben..</p>";
                session_destroy();
                $_SESSION = array();
            }

            // redirect to the core
            if ( isset($_SESSION["activated"]) && isset($_SESSION["user"]) && isset($_SESSION["email"]) ){
                header("Location: forum.php");
                $result->free();
            }
        }
    ?>

</div>
