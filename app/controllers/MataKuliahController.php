<?php
declare(strict_types=1);

class MataKuliahController
{
    public function __construct(private MataKuliah $model) {}

    public function index(): void
    {
        $mataKuliah = $this->model->getAll();
        require dirname(__DIR__) . '/views/mata_kuliah/index.php';
    }

    public function create(): void
    {
        $mataKuliah = null;
        $formAction = 'store';
        require dirname(__DIR__) . '/views/mata_kuliah/form.php';
    }

    public function store(): void
    {
        try {
            $data = $this->validateInput($_POST);
            $this->model->insert($data);
            $this->setFlash('success', 'Data mata kuliah berhasil ditambahkan.');
        } catch (InvalidArgumentException $e) {
            $this->setFlash('error', $e->getMessage());
            header('Location: index.php?page=mata_kuliah&action=create');
            exit;
        } catch (PDOException $e) {
            $this->setFlash('error', 'Data gagal disimpan. Pastikan kode mata kuliah belum digunakan.');
        }
        header('Location: index.php?page=mata_kuliah');
        exit;
    }

    public function edit(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $mataKuliah = $id ? $this->model->findById((int) $id) : false;

        if (!$mataKuliah) {
            http_response_code(404);
            exit('Data mata kuliah tidak ditemukan.');
        }

        $formAction = 'update';
        require dirname(__DIR__) . '/views/mata_kuliah/form.php';
    }

    public function update(): void
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (!$id || !$this->model->findById((int) $id)) {
            http_response_code(404);
            exit('Data mata kuliah tidak ditemukan.');
        }

        try {
            $data = $this->validateInput($_POST);
            $this->model->update((int) $id, $data);
            $this->setFlash('success', 'Data mata kuliah berhasil diperbarui.');
        } catch (InvalidArgumentException $e) {
            $this->setFlash('error', $e->getMessage());
            header('Location: index.php?page=mata_kuliah&action=edit&id=' . (int) $id);
            exit;
        } catch (PDOException $e) {
            $this->setFlash('error', 'Data gagal diperbarui. Pastikan kode mata kuliah belum digunakan.');
        }

        header('Location: index.php?page=mata_kuliah');
        exit;
    }

    public function delete(): void
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $this->setFlash('error', 'ID data tidak valid.');
        } else {
            try {
                $this->model->delete((int) $id);
                $this->setFlash('success', 'Data mata kuliah berhasil dihapus.');
            } catch (PDOException $e) {
                $this->setFlash('error', 'Data mata kuliah gagal dihapus.');
            }
        }

        header('Location: index.php?page=mata_kuliah');
        exit;
    }

    private function validateInput(array $input): array
    {
        $data = [
            'kode_mk' => trim($input['kode_mk'] ?? ''),
            'nama_mk' => trim($input['nama_mk'] ?? ''),
            'sks' => trim((string) ($input['sks'] ?? '')),
            'semester' => trim((string) ($input['semester'] ?? '')),
            'program_studi' => trim($input['program_studi'] ?? ''),
            'dosen_pengampu' => trim($input['dosen_pengampu'] ?? ''),
        ];

        foreach ($data as $value) {
            if ($value === '') {
                throw new InvalidArgumentException('Semua field wajib diisi.');
            }
        }

        if (!ctype_digit($data['sks']) || (int) $data['sks'] < 1 || (int) $data['sks'] > 6) {
            throw new InvalidArgumentException('SKS harus berupa angka antara 1 sampai 6.');
        }
        if (!ctype_digit($data['semester']) || (int) $data['semester'] < 1 || (int) $data['semester'] > 14) {
            throw new InvalidArgumentException('Semester harus berupa angka antara 1 sampai 14.');
        }

        $data['sks'] = (int) $data['sks'];
        $data['semester'] = (int) $data['semester'];
        return $data;
    }

    private function setFlash(string $type, string $message): void
    {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }
}
