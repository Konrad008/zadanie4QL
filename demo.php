<?php
try {
    include __DIR__ . '/includes/autoload.php';

    // Wyświetlanie listy komend w przypadku żadnej oraz wejscie do routera.

    if (!isset($argv[1])) {
        throw new Exception('No command found'.PHP_EOL.PHP_EOL.'Avalible commands:'.PHP_EOL.PHP_EOL.'list'.PHP_EOL.'find "..."'.PHP_EOL.'languages'.PHP_EOL.'addPerson'.PHP_EOL.'removePerson'.PHP_EOL.'addLanguage'.PHP_EOL.'removeLanguage'.PHP_EOL.PHP_EOL);
    } else {

        // Tworzymy instancję routera przekazując mu argumenty z cli, listę poleceń oraz ścieżkę do folderu z bazą danych (pattern */).
        $entryPoint = new \KD\EntryPoint($argv[1], new \KD\KDRoutes($argv, 'databasesrc/'));

        // Inicjujemy skrypt.
        $entryPoint->run();
    }
}
catch (Exception $e) {

    // Łapacza wykorzystuje do UX (patrz throw new \Exception w kontrolerach.)
    print $e.PHP_EOL;
}