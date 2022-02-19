<?php

    if (isset($_GET['timestamp'])) {
        $words = json_decode(file_get_contents("target-words.json"), true)["data"];

        srand($_GET['timestamp']);
        $rand = mt_rand() / mt_getrandmax();

        $index = floor($rand * count($words));
        $target = str_rot13($words[$index]);

        echo("{ \"word\": \"$target\", \"index\": $index }");
    }
    else {
        echo("{ \"error\": \"Missing parameter 'timestamp'!\"}");
    }

?>
