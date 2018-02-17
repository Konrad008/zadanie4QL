<?php
namespace KD;

class KDRoutes
{
    private $person;
    private $skill;

    public function __construct()
    {
        $this->person = new \QLabs\People();
        $this->skill = new \QLabs\Skills();
    }
    //$database = new \QLabs\Database();


}