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

    function keepSearchValue(){
        if (isset($_POST["searchQuery"])){
            echo "value='" . $_POST["searchQuery"] . "'";
        } else if (isset($_GET["s"])){
            echo "value='" . $_GET["s"] . "'";
        }
    }

    // thread functions

    function cleanInput($str){
        $str = trim($str);
        $str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
        $str = htmlentities($str, ENT_QUOTES, 'UTF-8');
        return $str;
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
