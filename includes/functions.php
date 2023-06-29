<?php

    function sanitize_data($input){
        return trim(htmlspecialchars(stripcslashes($input)));
    }

?>