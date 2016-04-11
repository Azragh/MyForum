<?php if (!isset($_SESSION["user"])): ?>
    <p class="info-inline">Melde dich an, um diesen Beitrag kommentieren zu können. Jetzt <a href="register.php">registrieren</a> oder direkt <a href="login.php">Anmelden</a></p>
<?php else: ?>

    <div class="form-container">

        <h3>Kommentar verfassen:</h3>
        <form class="form" action=<?php echo "thread.php?tid=" . $_GET["tid"]; ?> method="POST">
            <div class="form-row">
                <textarea name="cont" rows="4" required></textarea>
            </div>
            <div class="form-row">
                <input type="submit" value="Kommentar Absenden" name="replySent">
            </div>
        </form>

        <?php

            if (isset($_POST["replySent"])
            && isset($_POST["cont"]) && $_POST["cont"] != ""
            && isset($_GET["tid"]) && $_GET["tid"] != "" ) {

                $cont = $_POST["cont"];
                $thread = $_GET["tid"];
                $user = $_SESSION["user"];

                $q = mysqli_query($con, "INSERT INTO replies VALUES ('', '$thread', '$cont', '$user')");
                if ($q) {

                    echo "<p class='success-inline'>Kommentar wurde eingetragen.</p>";

                    // send subscription mails
                    $qu = mysqli_query($con, "SELECT * FROM subscriptions WHERE threadID='$thread'");
                    if (mysqli_num_rows($qu) > 0) {

                        require "plugins/phpmailer/PHPMailerAutoload.php";

                        while ($row = mysqli_fetch_array($qu)) {
                            $mail = new PHPMailer;

                            $mail->isSMTP();
                            $mail->Host = "smtp.gmail.com";
                            $mail->SMTPAuth = true;
                            $mail->Username = "daniel.geiser@new-time.ch";
                            $mail->Password = "icimyy4u";
                            $mail->SMTPSecure = "ssl";
                            $mail->Port = 465;

                            $mail->isHTML(true);
                            $mail->Encoding = "base64";
                            $mail->CharSet = "UTF-8";

                            $mail->setFrom('daniel.geiser@new-time.ch', 'Daniel Geiser');
                            $mail->addAddress( $row['email'] );
                            $mail->addReplyTo('daniel.geiser@new-time.ch', 'Information');

                            $mail->Subject = "Neuer Kommentar";
                            $mail->Body    = "<p>Ein neuer Kommentar wurde verfasst.</p><p><b>$user meint:</b></p><p>'".nl2br($cont)."'</p>";
                            $mail->Body   .= "<p><a href='http://localhost/browser/thread.php?tid=" . $thread . "'>Zum Beitrag</a></p>";

                            $mail->AltBody = "Ein neuer Kommentar wurde verfasst. \r\n \r\n$user sagt: \r\n'$cont'\r\n \r\n";
                            $mail->AltBody.= "Link zum Beitrag: http://localhost/browser/thread.php?tid=" . $thread;

                            if(!$mail->send()) {
                                echo "<p class='error-inline'>Die Subscription-Mail konnte nicht versendet werden</p>";
                                echo "Mailer Error: " . $mail->ErrorInfo;

                            }

                        }

                    }

                    // call alert on next page..? #nomessage
                    header("Location: thread.php?tid=$thread");

                } else {
                    echo "<p class='error-inline'>Kommentar-Eintrag fehlgeschlagen..</p>";
                }
            }

        ?>

    </div>

<?php endif; ?>
