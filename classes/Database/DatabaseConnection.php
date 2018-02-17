<?php
namespace Database;

use QLabs\Interfaces\DB;

class DatabaseConnection implements DB
{
    private $people;
    private $skills;
    private $route;

    public function __construct() {
        $this->route = __DIR__.'/../../';
        $this->people = fopen($this->route.'peopleDB.json', 'w+');
        $this->skills = fopen($this->route.'skillsDB.json', 'w+');
    }


    public function readFromDB(): array{

        $return = [];

        if (flock($this->people,LOCK_EX) && flock($this->skills, LOCK_EX)) {

            var_dump(json_decode($json, true));

            flock($this->skills,LOCK_UN);
            flock($this->people,LOCK_UN);
        }
        else {
            throw new Exception('Error locking database files! Please try again later.');
        }

        return $return;
    }

    public function saveToDB(array $json){

    }

    public function __destruct()
    {
        fwrite($this->skills);
        fwrite($this->skills);
        fclose($this->skills);
        fclose($this->people);
    }


//$people = fopen("peopleDB.json","w+");
//$skills = fopen("skillsDB.json", "w+");
//
//if (flock($people,LOCK_EX) && flock($skills, LOCK_EX)) {
//
//
//flock($people,LOCK_UN);
//}
//else {
//    throw new Exception('Error locking database files! Please try again later.');
//}
//
//fclose($file);

}