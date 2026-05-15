<?php
    include("connection.php");

    $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]) : '';

    $sql = "SELECT * FROM pegawai WHERE nama LIKE :keyword OR alamat LIKE :keyword OR status_perkawinan LIKE :keyword ORDER BY nama ASC";
    $stmt = $db->prepare($sql);

    $searchTerm = '%' . $keyword . '%';
    $stmt->bindValue(':keyword', $searchTerm, PDO::PARAM_STR);
    
    $stmt->execute();
    $result = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian: <?= htmlspecialchars($keyword) ?></title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        table, th, td { border: 1px solid #d1d5db; padding: 10px; }
        th { background-color: #f3f4f6; }
        .search-container { margin-bottom: 20px; display: flex; gap: 10px; align-items: center; }
    </style>
</head>
<body>
    <h1>Hasil Pencarian</h1>
    
    <?php if($keyword != ''): ?>
        <p style="color: #4b5563;">Menampilkan hasil pencarian untuk: <strong>"<?= htmlspecialchars($keyword) ?>"</strong></p>
    <?php endif; ?>

    <div class="search-container">
        <form method="GET" action="search.php" style="margin: 0; display: flex; gap: 10px;">
            <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>" placeholder="Ketikkan pencarian ..." style="padding: 6px 10px; border: 1px solid #d1d5db; border-radius: 4px;">
            <button type="submit" style="padding: 6px 12px; cursor: pointer;">Cari Lagi</button>
        </form>
        
        <a href="index.php" style="text-decoration: none;">
            <button type="button" style="cursor: pointer; padding: 6px 12px; background-color: #6b7280; color: white; border: none; border-radius: 4px;">
                &larr; Kembali ke Semua Data
            </button>
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($result) > 0): ?>
                <?php foreach($result as $index => $pegawai) : ?>
                    <tr>
                        <td style="text-align: center;">
                            <?= $index + 1?>
                        </td>
                        <td>
                            <?= htmlspecialchars($pegawai["nama"]) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($pegawai["jenis_kelamin"]) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($pegawai["alamat"]) ?>
                        </td>
                        <td style="display: flex; justify-content: center; gap: 0.5rem; border: none;">
                            <a href="profile.php?id=<?= $pegawai["id"] ?>" style="text-decoration: none;">
                                <button type="button" style="cursor: pointer; padding: 4px 8px; background-color: blue; color: white; border: none; border-radius: 4px;">
                                    Detail
                                </button>
                            </a>
                            <a href="edit.php?id=<?= $pegawai["id"] ?>" style="text-decoration: none;">
                                <button type="button" style="cursor: pointer; padding: 4px 8px; background-color: #f59e0b; color: white; border: none; border-radius: 4px;">
                                    Edit
                                </button>
                            </a>
                            <a href="delete.php?id=<?= $pegawai["id"] ?>" style="text-decoration: none;" onclick="return confirm('Yakin ingin menghapus?');">
                                <button type="button" style="cursor: pointer; padding: 4px 8px; background-color: red; color: white; border: none; border-radius: 4px;">
                                    Hapus
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: red; padding: 20px;">
                        Pencarian "<?= htmlspecialchars($keyword) ?>" tidak ditemukan.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>