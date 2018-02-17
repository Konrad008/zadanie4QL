<?php
namespace KD;

use QLabs\Interfaces\Routes;

class KDRoutes implements Routes
{
    private $database;
    private $people;
    private $skills;

    public function __construct() {
        include __DIR__.'/../../includes/DatabaseConnection.php';
        $this->skills = new \QLabs\Controllers\Skills();
        $this->people = new \QLabs\Controllers\People();
    }

    public function getRoutes(): array {

    }


}