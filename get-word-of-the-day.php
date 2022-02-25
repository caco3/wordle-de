<?php

    $LOG_FOLDER = "./logs";

    if (isset($_GET['timestamp'])) {
        if (!is_dir($LOG_FOLDER)) {
            mkdir($LOG_FOLDER);
        }

        $log  = date("[Y-m-d, H:i:s] ") . $_GET['timestamp'] . ", " . $_SERVER['REMOTE_ADDR'] . ", " . $_SERVER['HTTP_USER_AGENT'] . PHP_EOL;
        file_put_contents('./logs/word-of-the-day.log', $log, FILE_APPEND);

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
