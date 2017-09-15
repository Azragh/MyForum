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


    $ntfmail->Subject = "Your contribution '$title' was commented!";
    $ntfmail->Body    = "<p><b>$user means:</b></p><p>'".nl2br($cont)."'</p>";
    $ntfmail->Body   .= "<p><a href='http://localhost/thread.php?tid=" . $thread . "'>To the Contribution</a>&nbsp;&nbsp;";
    $ntfmail->Body   .= "<a href='http://localhost/forum/admin.php'>To the administration page</a></p>";

    $ntfmail->AltBody = "A new comment has been posted. \r\n \r\n$user says: \r\n'$cont'\r\n \r\n";
    $ntfmail->AltBody.= "Link to the article: http://localhost/thread.php?tid=" . $thread;


    if(!$ntfmail->send()) {
        $errors .= "<p class='error'>The subscription mail could not be sent</p>";
        $errors .= "<p class='error'>Mailer Error: " . $ntfmail->ErrorInfo . "</p>";
    }


?>
