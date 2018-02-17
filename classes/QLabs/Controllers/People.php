<?php

namespace QLabs\Controllers;

use QLabs\Database\DatabaseConnection;

class People
{
    private $args;
    private $db;

    public function __construct(array $arguments, DatabaseConnection $connection) {
        $this->db = $connection;
        $this->args =  $arguments;
    }

    public function showList() {

        print_r($this->args);
    }

    public function findPerson() {

    }

    public function addCoder() {

    }
    public function removeCoder() {

    }
}