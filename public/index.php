<?php
declare(strict_types=1);
session_start();

require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/app/models/MataKuliah.php';
require_once dirname(__DIR__) . '/app/controllers/MataKuliahController.php';

try {
    $db = (new Database())->connect();
    $model = new MataKuliah($db);
    $controller = new MataKuliahController($model);

    $page = $_GET['page'] ?? 'mata_kuliah';
    $action = $_GET['action'] ?? 'index';

    if ($page !== 'mata_kuliah') {
        http_response_code(404);
        exit('Halaman tidak ditemukan.');
    }

    switch ($action) {
        case 'index':
            $controller->index();
            break;
        case 'create':
            $controller->create();
            break;
        case 'store':
            $controller->store();
            break;
        case 'edit':
            $controller->edit();
            break;
        case 'update':
            $controller->update();
            break;
        case 'delete':
            $controller->delete();
            break;
        default:
            http_response_code(404);
            exit('Action tidak ditemukan.');
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo 'Koneksi database gagal. Periksa konfigurasi pada config/database.php dan pastikan database sudah diimpor.';
}
