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

    public function __construct(array $arguments, string $databasePath) {
        $this->args = $arguments;
        $this->database = new DatabaseConnection($databasePath);

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
            'addperson' => [
                'controller' => $peopleController,
                'action' => 'addCoder',
            ],
            'removeperson' => [
                'controller' => $peopleController,
                'action' => 'removeCoder',
            ],
            'addlanguage' => [
                'controller' => $skillsController,
                'action' => 'addCodeLanguage',
            ],
            'removelanguage' => [
                'controller' => $skillsController,
                'action' => 'removeCodeLanguage',
            ],
            'listlangs' => [
                'controller' => $skillsController,
                'action' => 'listLanguages',
            ],
            'test' => [
                'controller' => $peopleController,
                'action' => 'test',
            ],
        ];

        return $routes;
    }
}