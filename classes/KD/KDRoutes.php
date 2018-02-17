<?php
namespace KD;

use Database\DatabaseConnection;
use QLabs\Interfaces\Routes;

class KDRoutes implements Routes
{
    private $database;
    private $people;
    private $skills;

    public function __construct() {
        $this->database = new \QLabs\Database\DatabaseConnection([
            'peopleDB.json',
            'skillsDB.json'
        ]);

        print_r($this->database->readFromDB());

        $this->skills = new \QLabs\Controllers\Skills();
        $this->people = new \QLabs\Controllers\People();
    }

    public function getRoutes(): array {

    }


}