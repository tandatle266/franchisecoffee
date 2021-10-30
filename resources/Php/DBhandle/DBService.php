<?php


interface  DBService
{
    public function insertInto(array $object):bool;
    public function update(array $object):bool;

    public function delete(int $id):bool;
    public function getALL():array;
    public function getByStatus(int $condition):array;
    public function findByName(String $name):array;
    public function countByStatus(int $status):int;
}

