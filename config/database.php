<?php
declare(strict_types=1);

class Database
{
    private string $host = 'localhost';
    private string $db = 'data_mata_kuliah';
    private string $user = 'root';
    private string $pass = '';

    public function connect(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";

        return new PDO($dsn, $this->user, $this->pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}
