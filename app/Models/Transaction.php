<?php

namespace Models;

use PDO;
use PDOException;

class Transaction extends Model
{
    use DeleteRow, FindRow;

    protected string $table = 'transactions';

    public function fetch()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        return $this->db->query($query);
    }

    public function create(array $data)
    {
        $time = $data['created_at'] ?? date('Y-m-d H:i:s');

        $query = "INSERT INTO {$this->table} (amount, description, tag_id, user_id, created_at)
                  VALUES (:amount, :desc, :tag, :user, :time)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':amount', $data['amount']);
        $stmt->bindParam(':desc', $data['description']);
        $stmt->bindParam(':tag', $data['tag_id'], PDO::PARAM_INT);
        $stmt->bindParam(':user', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':time', $time);

        return $stmt->execute();
    }

    public function update(array $data, int $id)
    {
        $this->db->beginTransaction();
        try {
            $query = "UPDATE {$this->table} SET
                    amount = :amount,
                    description = :desc,
                    tag_id = :tag
                    WHERE id = :id";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':amount', $data['amount']);
            $stmt->bindParam(':desc', $data['description']);
            $stmt->bindParam(':tag', $data['tag_id'], PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // assume there are other statements to be executed...
            
            $this->db->commit();

        } catch (PDOException $e) {
            $this->db->rollBack();
        }

    }

}