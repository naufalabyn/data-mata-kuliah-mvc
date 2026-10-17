<?php
function e(mixed $value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$isEdit = $mataKuliah !== null;
$value = static fn(string $key, mixed $default = '') => e($mataKuliah[$key] ?? $default);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $isEdit ? 'Edit' : 'Tambah' ?> Mata Kuliah</title>
    <style>
        body{font-family:Arial,sans-serif;margin:36px;background:#f4f6f9;color:#202938}
        main{max-width:650px;margin:auto;background:white;padding:24px;border-radius:12px}
        label{display:block;margin-top:14px;font-weight:bold}input{box-sizing:border-box;width:100%;padding:10px;margin-top:6px;border:1px solid #cbd5e1;border-radius:5px}
        button,.btn{display:inline-block;margin-top:18px;padding:10px 14px;border:0;border-radius:5px;background:#2457a7;color:white;text-decoration:none;cursor:pointer}
        .notice{padding:12px;margin:16px 0;border-radius:6px;background:#fdecec}
    </style>
</head>
<body>
<main>
    <h1><?= $isEdit ? 'Edit' : 'Tambah' ?> Mata Kuliah</h1>
    <?php if ($flash): ?><div class="notice"><?= e($flash['message']) ?></div><?php endif; ?>
    <form method="post" action="index.php?page=mata_kuliah&action=<?= e($formAction) ?>">
        <?php if ($isEdit): ?><input type="hidden" name="id" value="<?= (int) $mataKuliah['id'] ?>"><?php endif; ?>
        <label for="kode_mk">Kode Mata Kuliah</label>
        <input id="kode_mk" name="kode_mk" maxlength="20" required value="<?= $value('kode_mk') ?>">
        <label for="nama_mk">Nama Mata Kuliah</label>
        <input id="nama_mk" name="nama_mk" maxlength="100" required value="<?= $value('nama_mk') ?>">
        <label for="sks">SKS (1–6)</label>
        <input id="sks" name="sks" type="number" min="1" max="6" required value="<?= $value('sks') ?>">
        <label for="semester">Semester (1–14)</label>
        <input id="semester" name="semester" type="number" min="1" max="14" required value="<?= $value('semester') ?>">
        <label for="program_studi">Program Studi</label>
        <input id="program_studi" name="program_studi" maxlength="100" required value="<?= $value('program_studi', 'Sistem Informasi') ?>">
        <label for="dosen_pengampu">Dosen Pengampu</label>
        <input id="dosen_pengampu" name="dosen_pengampu" maxlength="100" required value="<?= $value('dosen_pengampu') ?>">
        <button type="submit"><?= $isEdit ? 'Simpan Perubahan' : 'Simpan Data' ?></button>
        <a class="btn" href="index.php?page=mata_kuliah">Kembali</a>
    </form>
</main>
</body>
</html>
