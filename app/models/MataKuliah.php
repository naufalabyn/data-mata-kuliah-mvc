<?php
declare(strict_types=1);

class MataKuliah
{
    public function __construct(private PDO $db) {}

    public function getAll(): array
    {
        $stmt = $this->db->query(
            'SELECT id, kode_mk, nama_mk, sks, semester, program_studi, dosen_pengampu
             FROM mata_kuliah ORDER BY semester, nama_mk'
        );
        return $stmt->fetchAll();
    }

    public function findById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            'SELECT id, kode_mk, nama_mk, sks, semester, program_studi, dosen_pengampu
             FROM mata_kuliah WHERE id = :id'
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function insert(array $data): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO mata_kuliah
             (kode_mk, nama_mk, sks, semester, program_studi, dosen_pengampu)
             VALUES (:kode_mk, :nama_mk, :sks, :semester, :program_studi, :dosen_pengampu)'
        );
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $stmt = $this->db->prepare(
            'UPDATE mata_kuliah SET kode_mk = :kode_mk, nama_mk = :nama_mk,
             sks = :sks, semester = :semester, program_studi = :program_studi,
             dosen_pengampu = :dosen_pengampu WHERE id = :id'
        );
        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM mata_kuliah WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
