<?php
namespace models;

use PDO;

class Model
{
    protected $db = null;
    protected $table = null;

    public function __construct()
    {
        if (!$this->db) {
            $this->db = new PDO(DB_DSN, DB_USER, DB_PASS);
        }
    }

    public function getDBConnection()
    {
        return $this->db;
    }

    public function find()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetchObject()) {
            $result[] = $row;
        }
        return $result;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $id]);
        if ($stmt->rowCount()) {
            return $stmt->fetchObject();
        }
        return null;
    }

    public function save($params)
    {
        $columns = [];
        $values = [];
        foreach ($params as $key => $value) {
            $columns[] = $key;
            $values[] = ":$key";
        }
        $columns = implode(",", $columns);
        $values = implode(",", $values);
        $sql = "INSERT INTO {$this->table}({$columns}) VALUES ($values)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $this->db->lastInsertId();
    }
}