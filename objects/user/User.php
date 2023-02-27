<?php

class User
{
    // database connection and table name
    private $conn;
    private string $table_name = 'users';

    // object properties
    public $id;
    public $name;
    public $city_id;
    public $timestamp;

    public function __construct(public $db)
    {
        $this->conn = $db;
    }

    // create product
    public function create(): bool
    {
        //write query
        $query = "INSERT INTO $this->table_name (name, city_id, created_at) VALUES (?,?,?)";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->name = User::sanitizeMySQL($this->conn, $this->name);
        $this->city_id = User::sanitizeMySQL($this->conn, $this->city_id);

        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');

        // bind values
        $stmt->bind_param('sis', $this->name, $this->city_id, $this->timestamp);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update(): bool
    {
        $query = "UPDATE $this->table_name
                  SET name = ?, city_id  = ?
                  WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->name = User::sanitizeMySQL($this->conn, $this->name);
        $this->city_id = User::sanitizeMySQL($this->conn, $this->city_id);
        $this->id = User::sanitizeMySQL($this->conn, $this->id);

        // bind parameters
        $stmt->bind_param('sii', $this->name, $this->city_id, $this->id);

        // execute the query
        return (bool)$stmt->execute();
    }

    public function readAll($from_record_num, $records_per_page)
    {
        $query = "SELECT id, name, city_id FROM $this->table_name 
                  ORDER BY name ASC
                  LIMIT {$from_record_num}, {$records_per_page}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne()
    {
        $query = "SELECT name, city_id
                  FROM $this->table_name
                  WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        $stmt->bind_result($name, $city_id);

        $stmt->fetch();

        $this->name = $name;
        $this->city_id = $city_id;
    }

    public function countAll()
    {
        $query = "SELECT id FROM $this->table_name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows;
    }

    private function sanitizeString($string): string
    {
        return htmlentities(strip_tags(trim($string)));
    }

    private function sanitizeMySQL($conn, $string): string
    {
        $string = $conn->real_escape_string($string);
        return User::sanitizeString($string);
    }
}