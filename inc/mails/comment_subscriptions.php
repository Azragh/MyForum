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


            $ntfmail->Subject = "New comment on '$title'";
            $ntfmail->Body    = "<p><b>$author writes:</b></p><p>'".nl2br($cont)."'</p>";
            $ntfmail->Body   .= "<p><a href='http://localhost/thread.php?tid=" . $threadid . "'>To the Contribution</a>&nbsp;&nbsp;";
            $ntfmail->Body   .= "<a href='http://localhost/thread.php?tid=" . $threadid . "&unsub'>Stop following contribution</a></p>";

            $ntfmail->AltBody = "A new comment has been posted. \r\n \r\n$author sagt: \r\n'$cont'\r\n \r\n";
            $ntfmail->AltBody.= "Link to the post: http://localhost/thread.php?tid=" . $threadid;


            if(!$ntfmail->send()) {
                $errors .= "<p class='error'>The subscription mail could not be sent</p>";
                $errors .= "<p class='error'>Mailer Error: " . $ntfmail->ErrorInfo . "</p>";
            }

        }

    }

?>
