<?php

function as_object($array)
{
    return json_decode(json_encode($array));
}

function sanitizeString($string)
{
    $string = filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS);
    $blacklist = ["<script>", "</script>", "<script src", "<script type=", "SELECT * FROM", "SELECT ", " SELECT ", "DELETE FROM", "INSERT INTO", "DROP TABLE", "DROP DATABASE", "TRUNCATE TABLE", "SHOW TABLES", "SHOW DATABASES", "<?php", "?>", "--", "^", "<", ">", "==", "=", ";", "::"];
    $string = trim($string);
    $string = stripslashes($string);

    foreach ($blacklist as $str) {
        $string = str_ireplace($str, "", $string);
    }

    $string = trim($string);
    $string = stripslashes($string);
    return $string;
}