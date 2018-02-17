<?php
namespace KD;

use QLabs\Interfaces\Routes;
use QLabs\Database\DatabaseConnection;
use QLabs\Controllers\Skills;
use QLabs\Controllers\People;


class KDRoutes implements Routes
{
    private $database;

    public function __construct() {
        $this->database = new DatabaseConnection('databasesrc/', [
            'peopleDB.json',
            'skillsDB.json',
        ]);

    }

    public function getRoutes(): array {
        $peopleController = new People();
        $skillsController = new Skills();

        $routes = [
            'list' => [
                'controller' => $peopleController,
                'action' => 'showList',
            ],
            'find' => [
                'controller' => $peopleController,
                'action' => 'findPerson',
            ],
            'languages' => [
                'controller' => $skillsController,
                'action' => 'showLanguages',
            ],
            'addPerson' => [
                'controller' => $peopleController,
                'action' => 'addCoder',
            ],
            'removePerson' => [
                'controller' => $peopleController,
                'action' => 'removeCoder',
            ],
            'addLanguage' => [
                'controller' => $skillsController,
                'action' => 'addCodingLanguage',
            ],
            'removeLanguage' => [
                'controller' => $skillsController,
                'action' => 'removeCodingLanguage',
            ],
        ];

        return $routes;
    }
}