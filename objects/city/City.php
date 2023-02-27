<?php

class City
{
    private $conn;
    private string $table_name = 'cities';
    public $name;
    public $id;

    public function __construct(public $db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT id, name FROM $this->table_name ORDER BY name ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readName(): string
    {
        $query = "SELECT name FROM $this->table_name WHERE id = ? limit 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        $stmt->bind_result($name);
        $stmt->fetch();

        return $this->name = $name;
    }
}