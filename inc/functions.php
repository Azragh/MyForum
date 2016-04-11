<?php

    // form functions

    function keepUsernameValue(){
        if (isset($_POST["username"])){
            echo "value='" . $_POST["username"] . "'";
        }
    }

    function keepEmailValue(){
        if (isset($_POST["email"])){
            echo "value='" . $_POST["email"] . "'";
        }
    }

    function excerpt( $content ){
        if (strlen($content) > 100) {
            $a = $content;
            $content = '';
            for( $i=0; $i<100; $i++ ) {
                $content .= $a[$i];
            }
            $content .= "...";
            return $content;
        } else {
            return $content;
        }
    }

    function calcRating( $all, $total ){

        if ($all == 0 || $all == null || $total == 0 || $total == null) {
            $average = "0/5";
            return $average;
        } else {
            $average = $all / $total;
            $average = round($average, 1) . "/5";
            return $average;
        }

    }
?>
