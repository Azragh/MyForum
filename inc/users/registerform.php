<div class="form-container">

    <form class="form registerform" method="post">
        <div class="form-row">
            <label>Benutzername:</label><br>
            <input type="text" name="username" maxlength="20" <?php keepUsernameValue(); ?> required>
        </div>
        <div class="form-row">
            <label>Email:</label><br>
            <input type="email" name="email" <?php keepEmailValue(); ?> required>
        </div>
        <div class="form-row">
            <label>Passwort:</label><br>
            <input type="password" name="password" required>
        </div>
        <div class="form-row">
            <label>Passwort wiederholen:</label><br>
            <input type="password" name="password2" required>
        </div>
        <div class="form-row">
            <input type="submit" value="Registrieren">
        </div>
    </form>

    <?php
        if (isset($_POST["username"])) {

            $username = $_POST['username'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $email = $_POST['email'];

            $usrcheck = false;
            $passcheck = false;
            $mailcheck = false;

            // set unique regkey
            $regkey = md5( $username );
            $activated = 0;

            // check if user exists
            $userquery = "SELECT username FROM benutzer WHERE username='" . $username . "'";
            $result = $con->query( $userquery );

            if( $con->affected_rows == 1 ){
                echo "<p class='error-inline'>Dieser Benutzername ist bereits vergeben..</p>";
                $result->free();
            } else {
                $usrcheck = true;
                $result->free();
            }

            // check if email exists
            $mailquery = "SELECT email FROM benutzer WHERE email='" . $email . "'";
            $result = $con->query( $mailquery );

            if( $con->affected_rows == 1 ){
                echo "<p class='error-inline'>Diese Email ist bereits vergeben..</p>";
                $result->free();
            } else {
                $mailcheck = true;
                $result->free();
            }

            // check if passwords match
            if( $password !== $password2 ) {
                echo "<p class='error-inline'>Die Passwörter stimmen nicht überein..</p>";
            } else {
                // A salt is randomly generated here to protect again brute force attacks
                $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
                // This hashes the password with the salt
                $password = hash('sha256', $password . $salt);
                // Next we hash the hash
                for($round = 0; $round < 65536; $round++) {
                    $password = hash('sha256', $password . $salt);
                }
                $passcheck = true;
            }

            // register user in db
            if ($usrcheck && $passcheck && $mailcheck) {

                $registerquery = "INSERT INTO benutzer (username, password, salt, email, regkey, activated) VALUES ('"
                    . $username . "', '"
                    . $password . "', '"
                    . $salt .     "', '"
                    . $email .    "', '"
                    . $regkey .   "', '"
                    . $activated. "')";

                $result = $con->query( $registerquery );

                if( $con->affected_rows == 1 ){
                    require "plugins/phpmailer/PHPMailerAutoload.php";

                    $mail = new PHPMailer;

                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "daniel.geiser@new-time.ch";
                    $mail->Password = "icimyy4u";
                    $mail->SMTPSecure = "ssl";
                    $mail->Port = 465;

                    $mail->setFrom('daniel.geiser@new-time.ch', 'Daniel Geiser');
                    $mail->addAddress( $email );
                    $mail->addReplyTo('daniel.geiser@new-time.ch', 'Information');

                    $mail->isHTML(true);
                    $mail->Encoding = "base64";
                    $mail->CharSet = "UTF-8";

                    $mail->Subject = "Account-Aktivierung";
                    $mail->Body    = "<p>Hey, " . $username . "! Dein Account ist erfolgreich angelegt worden.</p>
                    <p>Klicke auf <b><a href='http://localhost/browser/activate.php?reg=" . $regkey . "'>diesen Link</a></b>, um dich anmelden zu können.";

                    $mail->AltBody = "Hey, " . $username . "! Dein Account ist erfolgreich angelegt worden.
                    Kopiere folgenden Link und öffne ihn in deinem Browser: http://localhost/browser/activate.php?reg=" . $regkey;

                    if(!$mail->send()) {
                        echo "<p class='error-inline'>Es konnte leider kein aktivierungslink an die angegebene Email gesendet werden..</p>";
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    } else {
                        echo "<p class='success-inline'>Du hast dich erfolgreich registriert! Klicke auf den Link in der Bestätigungsmail, um dich einloggen zu können.</p>";
                    }

                } else {
                    echo "<p class='error-inline'>Da ist was schief gelaufen..</p>";
                }
            }
        }
    ?>

</div>
