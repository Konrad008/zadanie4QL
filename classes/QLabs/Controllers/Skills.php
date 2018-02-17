<?php

namespace QLabs\Controllers;

use QLabs\Database\DatabaseConnection;

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
            print_r($this->db->searchByLanguage($langs));

        } else {
            throw new \Exception(PHP_EOL.PHP_EOL.'Provide at least one langueage!'.PHP_EOL.PHP_EOL);
        }
    }

    public function addCodeLanguage() {

    }

    public function removeCodeLanguage() {

    }


}