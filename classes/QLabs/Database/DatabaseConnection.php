<?php
namespace QLabs\Database;

use QLabs\Interfaces\DB;

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

    public function save() {

    }

    public function update() {

    }

    public function delete() {

    }

    public function searchByLanguage(array $langs): array {
        return [];
    }

    public function search(string $string = ' '): array {
        $database = $this->readFromDB();

        $return = [];

        foreach ($database[0] as $keyp => $person) {
            if (strpos(strtolower($person['name'].' '.$person['surname']), strtolower($string)) !== false) {
                $personret = '';

                $personret .= $keyp . ". " . $person['name'] . ' ' . $person['surname'] . ' -';

                $langsarr = ' (';

                foreach ($person['langs'] as $keyl => $lang) {
                    if (array_key_exists($lang, $database[1])) {
                        $langsarr .= $database[1][$database[0][$keyp]['langs'][$keyl]] . ', ';
                    }
                }

                $langsarr = substr($langsarr, 0, strlen($langsarr) - 2) . ')';

                $personret .= $langsarr;

                $return[] = ltrim($personret);
            }
        }

        return $return;
    }

    private function readFromDB(): array{

        foreach ($this->files as $file) {

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
                    throw new \Exception('Error locking database files! Please try again later.');
                }

                fwrite($thisfile, $filecont);
                flock($thisfile, LOCK_UN);
                fclose($thisfile);

            } else {
                fopen($file, 'w+');
                fclose($file);
            }

            $resources[] = json_decode($filecont, true);

        }

        return $resources;
    }

    private function saveToDB(array $json){

    }

}