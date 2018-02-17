<?php

$files = [];

$files[] = __DIR__.'/../peopleDB.json';
$files[] = __DIR__.'/../skillsDB.json';

foreach ($files as $file) {

    if (file_exists($file)) {

        $thisfile = fopen($file, 'r');
        $size = filesize($file);

        if (flock($thisfile, LOCK_EX)) {

            if ($size != 0) {
                $filecont = fread(fopen($file, 'r'), $size);
            } else {
                $filecont = '';
            }

        } else {
            throw new Exception('Error locking database files! Please try again later.');
        }

        fwrite($thisfile, $filecont);
        flock($thisfile, LOCK_UN);
        fclose($thisfile);

    } else {
        fopen($file, 'w+');
    }
}

//$skillsDB = json_decode($skillscont, true);
//$peopleDB = json_decode($peoplecont, true);

