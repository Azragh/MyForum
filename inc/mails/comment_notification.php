<?php

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
    $ntfmail->addAddress( $row['email'] );
    $ntfmail->addReplyTo('noreply@new-time.ch', 'Information');


    $ntfmail->Subject = "Dein Beitrag '$title' wurde kommentiert!";
    $ntfmail->Body    = "<p><b>$user meint:</b></p><p>'".nl2br($cont)."'</p>";
    $ntfmail->Body   .= "<p><a href='http://localhost/forum/thread.php?tid=" . $thread . "'>Zum Beitrag</a>&nbsp;&nbsp;";
    $ntfmail->Body   .= "<a href='http://localhost/forum/admin.php'>Zur Verwaltungsseite</a></p>";

    $ntfmail->AltBody = "Ein neuer Kommentar wurde verfasst. \r\n \r\n$user sagt: \r\n'$cont'\r\n \r\n";
    $ntfmail->AltBody.= "Link zum Beitrag: http://localhost/forum/thread.php?tid=" . $thread;


    if(!$ntfmail->send()) {
        $errors .= "<p class='error'>Die Subscription-Mail konnte nicht versendet werden</p>";
        $errors .= "<p class='error'>Mailer Error: " . $ntfmail->ErrorInfo . "</p>";
    }


?>
