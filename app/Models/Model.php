<?php

namespace Models;

use PDO;

class Model
{
    /**
     * @var \PDO
     */
    protected readonly PDO $db;

    protected string $table;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}