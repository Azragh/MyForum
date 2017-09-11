<?php

    $contq = mysqli_query($db, "SELECT * FROM replies WHERE id='" . $id . "' AND threadID='" . $threadid . "'");
    if (mysqli_num_rows($contq) > 0) {
        $row = mysqli_fetch_array($contq);
        $cont = $row['content'];
    }

    $tdq = mysqli_query($db, "SELECT * FROM threads WHERE id='$threadid'");
    if (mysqli_num_rows($tdq) > 0) {

        while ($row = mysqli_fetch_array($tdq)) {

            $title = $row['title'];
            $author = $row['author'];

            $ntfmail = new PHPMailer;

            $ntfmail->isSMTP();
            $ntfmail->Host = "smtp.gmail.com";
            $ntfmail->SMTPAuth = true;
            $ntfmail->Username = "daniel.geiser@new-time.ch";
            $ntfmail->Password = "icimyy4u";
            $ntfmail->SMTPSecure = "ssl";
            $ntfmail->Port = 465;

            $ntfmail->isHTML(true);
            $ntfmail->Encoding = "base64";
            $ntfmail->CharSet = "UTF-8";

            $ntfmail->setFrom('noreply@new-time.ch', 'Daniel Geiser');
            $ntfmail->addAddress( $email );
            $ntfmail->addReplyTo('noreply@new-time.ch', 'Information');


            $ntfmail->Subject = "Neuer Kommentar zu '$title'";
            $ntfmail->Body    = "<p><b>$author schreibt:</b></p><p>'".nl2br($cont)."'</p>";
            $ntfmail->Body   .= "<p><a href='http://localhost/forum/thread.php?tid=" . $threadid . "'>Zum Beitrag</a>&nbsp;&nbsp;";
            $ntfmail->Body   .= "<a href='http://localhost/forum/thread.php?tid=" . $threadid . "&unsub'>Beitrag nicht mehr folgen</a></p>";

            $ntfmail->AltBody = "Ein neuer Kommentar wurde verfasst. \r\n \r\n$author sagt: \r\n'$cont'\r\n \r\n";
            $ntfmail->AltBody.= "Link zum Beitrag: http://localhost/forum/thread.php?tid=" . $threadid;


            if(!$ntfmail->send()) {
                $errors .= "<p class='error'>Die Subscription-Mail konnte nicht versendet werden</p>";
                $errors .= "<p class='error'>Mailer Error: " . $ntfmail->ErrorInfo . "</p>";
            }

        }

    }

?>
