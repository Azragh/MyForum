<?php
    // account activation
    if (isset($_GET["reg"])) {

        $getreg = $_GET["reg"];

        // check if regkey exists
        $regkeyquery = "SELECT regkey, activated FROM benutzer WHERE regkey='" . $getreg . "'";
        $result = $con->query( $regkeyquery );

        if( $con->affected_rows == 1 ){

            $row = $result->fetch_assoc();

            if ( $row['activated'] == 1 ){
                echo "<p class='success-inline'>der Account wurde bereits aktiviert.. <a href='login.php'>Login</a></p>";

            } else {
                $result->free();
                $activatequery = "UPDATE benutzer SET activated=1 WHERE regkey='" . $getreg . "'";
                $result = $con->query( $activatequery );

                if( $con->affected_rows == 1 ){
                    echo "<p class='success-inline'>Der Account wurde erfolgreich aktiviert! <a href='login.php'>Login</a></p>";
                } else {
                    echo "<p class='error-inline'>Da ist was schief gelaufen..</p>";
                }
            }

        } else {
            echo "<p class='error-inline'>Der Aktivierungslink scheint nicht zu stimmen..</p>";
            $result->free();
        }
    } else {
        echo "<p class='error-inline'>Die URL enthält keinen Aktivierungscode</p>";
    }
?>
