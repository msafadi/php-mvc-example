<?php

namespace Models;

use PDO;

class Tag extends Model
{
    use DeleteRow, FindRow;

    protected string $table = 'tags';
    
    public function fetch()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY name DESC";
        return $this->db->query($query);
    }

    public function create(array $data)
    {
        $query = "INSERT INTO {$this->table} (name) VALUES (:name)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        
        return $stmt->execute();
    }

    public function update(array $data, int $id)
    {
        $query = "UPDATE {$this->table} SET
                    name = :name
                    WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

}