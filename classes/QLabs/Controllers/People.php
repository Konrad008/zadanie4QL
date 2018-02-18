<?php

namespace QLabs\Controllers;

use QLabs\Database\DatabaseConnection;

// Logika ludzi.
class People
{
    private $args;
    private $db;

    public function __construct(array $arguments, DatabaseConnection $connection) {
        $this->db = $connection;
        $this->args =  $arguments;
    }

    public function showList() {
        $list = $this->db->search();

        foreach ($list as $value) {
            print($value.PHP_EOL);
        }
    }

    public function findPerson() {
        if (isset($this->args[2])) {

            $list = $this->db->search($this->args[2]);

            foreach ($list as $value) {
                print($value . PHP_EOL);
            }
        } else {
            throw new \Exception(PHP_EOL.PHP_EOL.'The search command needs the string you are looking for!'.PHP_EOL.PHP_EOL);
        }
    }

    public function addCoder() {
        $dbresponse = $this->db->readFromDB();

        $newuser = [];

        if (isset($this->args[4])) {
            foreach ($this->args as $key => $value) {
                if ($key == 2) {
                    if (preg_match('/[^a-zA-Z]+/', $value) == false) {
                        $newuser['name'] = $value;
                    } else {
                        throw new \Exception(PHP_EOL.PHP_EOL.'Name can contain only letters!'.PHP_EOL.PHP_EOL);
                    }
                }
                if ($key == 3) {
                    if (preg_match('/[^a-zA-Z]+/', $value) == false) {
                        $newuser['surname'] = $value;
                    } else {
                        throw new \Exception(PHP_EOL.PHP_EOL.'Surname can contain only letters'.PHP_EOL.PHP_EOL);
                    }
                }
                if ($key >= 4) {
                    if (array_search($this->args[$key], $dbresponse[1]) !== false) {
                        $newuser['langs'][] = array_search($this->args[$key], $dbresponse[1]);
                    } else {
                        $dbresponse[1][] = strtolower($this->args[$key]);
                        $newuser['langs'][] = array_search($this->args[$key], $dbresponse[1]);
                    }
                }
            }
        } else {
            throw new \Exception(PHP_EOL.PHP_EOL.'You must provide name, surname and at least one programming language!!'.PHP_EOL.PHP_EOL);
        }

        $dbresponse[0][] = $newuser;

        $this->db->saveToDB($dbresponse);
    }

    public function removeCoder() {
        $dbresponse = $this->db->readFromDB();

        if (array_key_exists($this->args[2], $dbresponse[0]) !== false) {
            unset($dbresponse[0][$this->args[2]]);
        } else {
            throw new \Exception(PHP_EOL.PHP_EOL.'ID not found!'.PHP_EOL.PHP_EOL);
        }

        $this->db->saveToDB($dbresponse);
    }

}