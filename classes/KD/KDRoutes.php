<?php
namespace KD;

use QLabs\Interfaces\RT;
use QLabs\Database\DatabaseConnection;
use QLabs\Controllers\Skills;
use QLabs\Controllers\People;


class KDRoutes implements RT
{
    private $database;
    private $args;

    public function __construct(array $arguments, string $databasePath, array $loadFiles) {
        $this->args = $arguments;
        $this->database = new DatabaseConnection($databasePath, $loadFiles);

    }

    public function getRoutes(): array {
        $peopleController = new People($this->args, $this->database);
        $skillsController = new Skills($this->args, $this->database);

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
                'action' => 'addCodeLanguage',
            ],
            'removeLanguage' => [
                'controller' => $skillsController,
                'action' => 'removeCodeLanguage',
            ],
        ];

        return $routes;
    }
}