<?php

class Database
{
    private string $host = 'localhost';
    private string $database = 'gleb';
    private string $login = 'root';
    private string $password = '';
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new mysqli($this->host, $this->login, $this->password, $this->database);
        } catch(mysqli_sql_exception $e) {
            die("Connection error: " . $e->getMessage());
        }
        return $this->conn;
    }
}