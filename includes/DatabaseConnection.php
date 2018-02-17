<?php

$files = [];

$peoplesrc = __DIR__.'/../peopleDB.json';
$skillssrc = __DIR__.'/../skillsDB.json';

if (file_exists($peoplesrc) && file_exists($peoplesrc)) {

    $peoplefile = fopen($peoplesrc, 'r');
    $skillsfile = fopen($skillssrc, 'r');

    $ps = filesize($peoplesrc);
    $ss = filesize($skillssrc);

    if (flock($peoplefile, LOCK_EX) && flock($skillsfile, LOCK_EX)) {

        if ($ps != 0) {
            $peoplecont = fread(fopen($peoplesrc, 'r'), $ps);
        } else {
            $peoplecont = '';
        }

        if ($ss != 0) {
            $skillscont = fread(fopen($skillssrc, 'r'), $ss);
        } else {
            $skillscont = '';
        }

    }

    fwrite($peoplefile, $peoplecont);
    fwrite($skillsfile, $skillscont);

    flock($peoplefile, LOCK_UN);
    flock($skillsfile, LOCK_UN);

    fclose($peoplefile);
    fclose($skillsfile);

} else {
    throw new Exception('Error locking database files! Please try again later.');
}

//$skillsDB = json_decode($skillscont, true);
//$peopleDB = json_decode($peoplecont, true);

