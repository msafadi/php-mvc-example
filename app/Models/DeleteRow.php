<?php

namespace Models;

trait DeleteRow
{
    public function delete($id)
    {
        $query = "DELET FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
}