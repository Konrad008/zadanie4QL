<?php
namespace QLabs\Database;

use QLabs\Interfaces\DB;

// Logika bazy.
class DatabaseConnection implements DB
{
    private $files;

    public function __construct(string $location) {

        $files = [
            'peopleDB.json',
            'skillsDB.json',
        ];

        foreach ($files as $file) {
            $this->files[] = __DIR__ . '/../../../' . $location . $file;
        }
    }

    public function searchByLanguage(array $langs): array {
        $database = $this->readFromDB();

        foreach ($langs as $key => $value) {
            $langs[$key] = array_search(strtolower($value), $database[1]);
        }

        $return = [];

        foreach ($database[0] as $key => $valuep){

            $response = array_intersect($valuep['langs'], $langs);

            if (count($response) == count($langs)) {
                $return = array_merge($return, $this->search($valuep['name'].' '.$valuep['surname']));
            }
        }

        return $return;
    }

    public function search(string $string = ' '): array {
        $database = $this->readFromDB();

        $return = [];

        foreach ($database[0] as $keyp => $person) {

            if (strpos(strtolower($person['name'].' '.$person['surname']), strtolower($string)) !== false) {

                $personret = '';

                $personret .= $keyp . '. ' . $person['name'] . ' ' . $person['surname'] . ' -';

                $langsarr = ' (';

                foreach ($person['langs'] as $keyl => $lang) {
                    if (array_key_exists($lang, $database[1])) {
                        $langsarr .= $database[1][$database[0][$keyp]['langs'][$keyl]] . ', ';
                    }
                }

                $langsarr = substr($langsarr, 0, strlen($langsarr) - 2) . ')';

                if (strlen($langsarr) !== 1) {
                    $personret .= $langsarr;
                }

                $return[] = ltrim($personret);
            }
        }

        return $return;
    }

    public function readFromDB(): array{

        foreach ($this->files as $key => $file) {

            if (file_exists($file)) {

                $thisfile = fopen($file, 'r');
                $size = filesize($file);

                if (flock($thisfile, LOCK_EX)) {

                    if ($size != 0) {
                        $filecont = fread(fopen($file, 'r'), $size);
                    } else {
                        $filecont = '{}';
                    }

                } else {
                    throw new \Exception('Error locking database files! Please try again later.');
                }

                fwrite($thisfile, $filecont);
                flock($thisfile, LOCK_UN);
                fclose($thisfile);

            } else {
                fopen($file, 'w+');
                $filecont = '{}';
            }

            $resources[] = json_decode($filecont, true);

        }

        return $resources;
    }

    public function saveToDB(array $json){

        $json[0] = array_values($json[0]);

        foreach ($json as $key => $value){
            $json[$key] = json_encode($value);
        }

        foreach ($json as $key => $file) {

            $thisfile = fopen($this->files[$key], 'w+');

            if (flock($thisfile, LOCK_EX)) {
                fwrite($thisfile, $file);
            } else {
                throw new \Exception('Error locking database files! Please try again later.');
            }

            flock($thisfile, LOCK_UN);
            fclose($thisfile);
        }

    }

}