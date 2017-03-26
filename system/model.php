<?php

namespace App\Model;

abstract class Model
{
    protected $db;
    protected $object;
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }
    abstract public function insert();
    abstract public function update();
    abstract public function delete();
}