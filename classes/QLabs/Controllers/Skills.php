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

    }

    public function addCodeLanguage() {

    }

    public function removeCodeLanguage() {

    }


}