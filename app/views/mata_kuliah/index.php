<?php
function e(mixed $value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mata Kuliah</title>
    <style>
        body{font-family:Arial,sans-serif;margin:36px;background:#f4f6f9;color:#202938}
        main{max-width:1100px;margin:auto;background:white;padding:24px;border-radius:12px}
        h1{margin-top:0}.btn,button{display:inline-block;padding:8px 12px;border:0;border-radius:5px;background:#2457a7;color:white;text-decoration:none;cursor:pointer}
        .delete{background:#b42318}.notice{padding:12px;margin:16px 0;border-radius:6px;background:#e8f7ec}
        .error{background:#fdecec}table{border-collapse:collapse;width:100%;margin-top:18px}th,td{padding:10px;border:1px solid #d8dee8;text-align:left}th{background:#edf2f8}
        form.inline{display:inline} .muted{color:#667085}
    </style>
</head>
<body>
<main>
    <h1>Daftar Mata Kuliah</h1>
    <p class="muted">Aplikasi CRUD PHP Native dengan pola Model-View-Controller.</p>
    <?php if ($flash): ?>
        <div class="notice <?= $flash['type'] === 'error' ? 'error' : '' ?>">
            <?= e($flash['message']) ?>
        </div>
    <?php endif; ?>
    <a class="btn" href="index.php?page=mata_kuliah&action=create">+ Tambah Mata Kuliah</a>
    <table>
        <thead><tr>
            <th>Kode MK</th><th>Nama Mata Kuliah</th><th>SKS</th><th>Semester</th>
            <th>Program Studi</th><th>Dosen Pengampu</th><th>Aksi</th>
        </tr></thead>
        <tbody>
        <?php if (!$mataKuliah): ?>
            <tr><td colspan="7">Belum ada data mata kuliah.</td></tr>
        <?php else: foreach ($mataKuliah as $mk): ?>
            <tr>
                <td><?= e($mk['kode_mk']) ?></td>
                <td><?= e($mk['nama_mk']) ?></td>
                <td><?= e($mk['sks']) ?></td>
                <td><?= e($mk['semester']) ?></td>
                <td><?= e($mk['program_studi']) ?></td>
                <td><?= e($mk['dosen_pengampu']) ?></td>
                <td>
                    <a class="btn" href="index.php?page=mata_kuliah&action=edit&id=<?= (int) $mk['id'] ?>">Edit</a>
                    <form class="inline" method="post" action="index.php?page=mata_kuliah&action=delete"
                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        <input type="hidden" name="id" value="<?= (int) $mk['id'] ?>">
                        <button class="delete" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</main>
</body>
</html>
