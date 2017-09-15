<div class="form-container">

    <form class="form registerform" method="post">
        <div class="form-row">
            <label>Username:</label><br>
            <input type="text" name="username" maxlength="20" <?php keepUsernameValue(); ?> required>
        </div>
        <div class="form-row">
            <label>Email:</label><br>
            <input type="email" name="email" <?php keepEmailValue(); ?> required>
        </div>
        <div class="form-row">
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </div>
        <div class="form-row">
            <label>Password Again:</label><br>
            <input type="password" name="password2" required>
        </div>
        <div class="form-row">
            <button type="submit"><span>Register</span></button>
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

            $role = "user";

            // set unique regkey
            $regkey = md5( $username );
            $activated = 0;

            // check if user exists
            $userquery = "SELECT username FROM benutzer WHERE username='" . $username . "'";
            $result = $db->query( $userquery );

            if( $db->affected_rows == 1 ){
                echo "<p class='error'>This username is already taken.</p>";
                $result->free();
            } else {
                $usrcheck = true;
                $result->free();
            }

            // check if email exists
            $mailquery = "SELECT email FROM benutzer WHERE email='" . $email . "'";
            $result = $db->query( $mailquery );

            if( $db->affected_rows == 1 ){
                echo "<p class='error'>This email has already been used.</p>";
                $result->free();
            } else {
                $mailcheck = true;
                $result->free();
            }

            // check if passwords match
            if( $password !== $password2 ) {
                echo "<p class='error'>The passwords do not match.</p>";
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

                $registerquery = "INSERT INTO benutzer (username, password, salt, email, regkey, activated, role) VALUES ('"
                    . $username . "', '"
                    . $password . "', '"
                    . $salt .     "', '"
                    . $email .    "', '"
                    . $regkey .   "', '"
                    . $activated. "', '"
                    . $role .     "')";

                $result = $db->query( $registerquery );

                if( $db->affected_rows == 1 ){
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

                    $mail->Subject = "Account Activation";
                    $mail->Body    = "<p>Hey, " . $username . "! Your account has been created successfully.</p>
                    <p>Click on <b><a href='http://localhost/register.php?reg=" . $regkey . "'>This link</a></b>, to login.";
                 
                    $mail->AltBody = "Hey, " . $username . "! Your account has been created successfully.
                    Copy and paste this link into your browser: http://localhost/register.php?reg=" . $regkey;

                    if(!$mail->send()) {
                        echo "<p class='error'>Sorry, no activation link could be sent to the specified email.</p>";
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    } else {
                        echo "<p class='success'>You have successfully registered! Click on the link in the confirmation mail to log in.</p>";
                    }

                } else {
                    echo "<p class='error'>There was something wrong.</p>";
                }
            }
        }

        if (isset($_GET['reg'])){
            require("inc/user_activation.php");
        }
    ?>

</div>
