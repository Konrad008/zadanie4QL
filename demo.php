<?php

try {

    include __DIR__ . '/includes/autoload.php';

    if (!isset($argv[1])) {
        throw new Exception('No command found'.PHP_EOL.PHP_EOL.'Avalible commands:'.PHP_EOL.PHP_EOL.'list'.PHP_EOL.'find "..."'.PHP_EOL.'languages'.PHP_EOL.'addPerson'.PHP_EOL.'removePerson'.PHP_EOL.'addLanguage'.PHP_EOL.'removeLanguage'.PHP_EOL.PHP_EOL);
    }

    $entryPoint = new \KD\EntryPoint($argv[1], new \KD\KDRoutes());

    $entryPoint->run();

}
catch (Exception $e) {
    print $e.PHP_EOL;
}