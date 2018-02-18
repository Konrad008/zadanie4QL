<?php
namespace QLabs\Interfaces;

interface DB {
    public function searchByLanguage(array $langs): array;
    public function search(): array;
    public function readFromDB(): array;
    public function saveToDB(array $json);
}