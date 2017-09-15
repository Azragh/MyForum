<?php

    $getreg = $_GET["reg"];

    // check if regkey exists
    $regkeyquery = "SELECT regkey, activated FROM benutzer WHERE regkey='" . $getreg . "'";
    $result = $db->query( $regkeyquery );

    if( $db->affected_rows == 1 ){

        $row = $result->fetch_assoc();

        if ( $row['activated'] == 1 ){
            echo "<p class='success'>The account has already been activated.</p>";

        } else {
            $result->free();
            $activatequery = "UPDATE benutzer SET activated=1 WHERE regkey='" . $getreg . "'";
            $result = $db->query( $activatequery );

            if( $db->affected_rows == 1 ){
                echo "<p class='success'>The account has been successfully activated! You can now login and post comments / threads.</p>";
            } else {
                echo "<p class='error'>There was something wrong.</p>";
            }
        }

    } else {
        echo "<p class='error'>The activation link does not seem to be correct.</p>";
        $result->free();
    }

?>
