<?php

namespace QLabs\Controllers;

use QLabs\Database\DatabaseConnection;

// Logika umiejętności.
class Skills
{
    private $args;
    private $db;

    public function __construct(array $arguments, DatabaseConnection $connection) {
        $this->db = $connection;
        $this->args =  $arguments;
    }

    public function showLanguages() {
        if (isset($this->args[2])) {

            for ($i = 2; $i < count($this->args); $i++){
                $langs[] = $this->args[$i];
            }

            foreach ($this->db->searchByLanguage($langs) as $value) {
                print($value . PHP_EOL);
            }

        } else {
            throw new \Exception(PHP_EOL.PHP_EOL.'Provide at least one language!'.PHP_EOL.PHP_EOL);
        }
    }

    public function addCodeLanguage() {
        if (isset($this->args[2])) {

            $dbresponse = $this->db->readFromDB();

            if (array_search($this->args[2], $dbresponse[1]) !== false) {
                throw new \Exception(PHP_EOL.PHP_EOL.'Language exists in database!'.PHP_EOL.PHP_EOL);
            } else {
                $dbresponse[1][] = strtolower($this->args[2]);
            }

            $this->db->saveToDB($dbresponse);

        } else {
            throw new \Exception(PHP_EOL.PHP_EOL.'Please specify language to add!'.PHP_EOL.PHP_EOL);
        }
    }

    public function removeCodeLanguage() {
        $dbresponse = $this->db->readFromDB();

        if (array_search($this->args[2], $dbresponse[1]) !== false) {
            $dbresponse[1] = array_diff($dbresponse[1], array_slice($dbresponse[1], array_search(strtolower($this->args[2]), $dbresponse[1]) - 1, 1, true));
        } else {
            throw new \Exception(PHP_EOL.PHP_EOL.'Language not found!'.PHP_EOL.PHP_EOL);
        }

        $this->db->saveToDB($dbresponse);
    }

    public function listLanguages() {
        $dbresponse = $this->db->readFromDB();

        foreach ($dbresponse[1] as $value) {
            print($value.PHP_EOL);
        }
    }

}