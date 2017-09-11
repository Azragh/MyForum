<?php

    $getreg = $_GET["reg"];

    // check if regkey exists
    $regkeyquery = "SELECT regkey, activated FROM benutzer WHERE regkey='" . $getreg . "'";
    $result = $db->query( $regkeyquery );

    if( $db->affected_rows == 1 ){

        $row = $result->fetch_assoc();

        if ( $row['activated'] == 1 ){
            echo "<p class='success'>der Account wurde bereits aktiviert.. </p>";

        } else {
            $result->free();
            $activatequery = "UPDATE benutzer SET activated=1 WHERE regkey='" . $getreg . "'";
            $result = $db->query( $activatequery );

            if( $db->affected_rows == 1 ){
                echo "<p class='success'>Der Account wurde erfolgreich aktiviert! Du kannst dich nun anmelden und Beiträge kommentieren.</p>";
            } else {
                echo "<p class='error'>Da ist was schief gelaufen..</p>";
            }
        }

    } else {
        echo "<p class='error'>Der Aktivierungslink scheint nicht zu stimmen..</p>";
        $result->free();
    }

?>
