<?php
    include("connection.php");

    $limit = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = ($page < 1) ? 1 : $page;
    $offset = ($page - 1) * $limit;

    $filter_huruf = isset($_GET['huruf']) ? $_GET['huruf'] : '';
    $filter_jk = isset($_GET['jk']) ? $_GET['jk'] : '';

    $query_where = " WHERE 1=1";
    $params = [];

    if ($filter_huruf != '') {
        $query_where .= " AND nama LIKE :huruf";
        $params[':huruf'] = $filter_huruf . '%';
    }

    if ($filter_jk != '') {
        $query_where .= " AND jenis_kelamin = :jk";
        $params[':jk'] = $filter_jk;
    }

    $stmt_count = $db->prepare("SELECT COUNT(*) FROM pegawai" . $query_where);
    $stmt_count->execute($params);
    $total_records = $stmt_count->fetchColumn();
    $total_pages = ceil($total_records / $limit);

    $sql = "SELECT * FROM pegawai" . $query_where . " ORDER BY nama ASC LIMIT :limit OFFSET :offset";
    
    $stmt = $db->prepare($sql);

    foreach ($params as $key => $val) {
        $stmt->bindValue($key, $val);
    }

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
    $stmt->execute();
    $result = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai - Halaman <?= $page ?></title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        table, th, td { border: 1px solid #d1d5db; padding: 10px; }
        th { background-color: #f3f4f6; }
        .filter-container { background-color: #f9fafb; padding: 15px; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 20px; display: flex; gap: 15px; align-items: center; }
        
        .pagination { display: flex; gap: 5px; justify-content: center; margin-top: 20px; }
        .pagination a, .pagination span { padding: 8px 12px; border: 1px solid #d1d5db; text-decoration: none; border-radius: 4px; color: #374151; }
        .pagination a:hover { background-color: #f3f4f6; }
        .pagination .active { background-color: blue; color: white; border-color: blue; }
        .pagination .disabled { color: #9ca3af; cursor: not-allowed; }
    </style>
</head>
<body>
    <h1>Data Pegawai</h1>
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <form method="GET" action="search.php">
            <input type="text" name="keyword" placeholder="Ketikan pencarian ..." style="padding: 4px 6px;">
            <button type="submit">Cari</button>
        </form>
        <a href="add.php"><button type="button">+ Tambah Data</button></a>
    </div>

    <div class="filter-container">
        <form method="GET" action="index.php" style="display: flex; gap: 10px;">
            <select name="huruf">
                <option value="">Semua Alfabet</option>
                <?php foreach(range('A', 'Z') as $char): ?>
                    <option value="<?= $char ?>" <?= ($filter_huruf == $char) ? 'selected' : '' ?>>Awalan <?= $char ?></option>
                <?php endforeach; ?>
            </select>

            <select name="jk">
                <option value="">Semua Jenis Kelamin</option>
                <option value="Pria" <?= ($filter_jk == 'Pria') ? 'selected' : '' ?>>Pria</option>
                <option value="Wanita" <?= ($filter_jk == 'Wanita') ? 'selected' : '' ?>>Wanita</option>
            </select>

            <button type="submit">Terapkan</button>
            <a href="index.php"><button type="button">Reset</button></a>
        </form>
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
                        <td style="text-align: center;"><?= $offset + $index + 1 ?></td>
                        <td><?= $pegawai["nama"] ?></td>
                        <td><?= $pegawai["jenis_kelamin"] ?></td>
                        <td><?= $pegawai["alamat"] ?></td>
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
                <tr><td colspan="5" style="text-align: center;">Data tidak ditemukan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($total_pages > 1): ?>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="index.php?page=<?= $page - 1 ?>&huruf=<?= $filter_huruf ?>&jk=<?= $filter_jk ?>">&laquo; Prev</a>
        <?php else: ?>
            <span class="disabled">&laquo; Prev</span>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="index.php?page=<?= $i ?>&huruf=<?= $filter_huruf ?>&jk=<?= $filter_jk ?>" 
               class="<?= ($i == $page) ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="index.php?page=<?= $page + 1 ?>&huruf=<?= $filter_huruf ?>&jk=<?= $filter_jk ?>">Next &raquo;</a>
        <?php else: ?>
            <span class="disabled">Next &raquo;</span>
        <?php endif; ?>
    </div>
    <p style="text-align: center; font-size: 0.9rem; color: #6b7280;">
        Menampilkan <?= count($result) ?> dari <?= $total_records ?> data pegawai.
    </p>
    <?php endif; ?>

</body>
</html>