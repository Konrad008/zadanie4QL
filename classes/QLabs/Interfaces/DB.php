<?php
namespace QLabs\Interfaces;

interface DB {
    public function readFromDB(): array;
    public function saveToDB(array $json);
}