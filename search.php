<?php

    include("connection.php");

    $keyword = $_GET["keyword"];

    $query = mysqli_query($connection, "SELECT * FROM pegawai WHERE nama LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR status_perkawinan LIKE '%$keyword%' ");
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Pegawai</title>
    <style>
        tr > td {
            margin: 1rem;
        }
    </style>
</head>
<body>
    <h1>Data Pegawai</h1>
    <form method="GET" action="search.php" style="margin-bottom: 1rem;">
        <input type="text" name="keyword" placeholder="Ketikan pencarian ..." style="padding: 4px 6px;">
        <button type="submit" style="padding: 4px 6px;">Cari</button>
    </form>
    <a href="index.php" style="text-decoration: none;">
        <button type="button" style="cursor: pointer; padding: 4px 6px; margin-bottom: 1rem;">
            Kembali
        </button>
    </a>
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
            <?php foreach($result as $index => $pegawai) : ?>
                <tr>
                    <td>
                        <?= $index + 1?>
                    </td>
                    <td>
                        <?= $pegawai["nama"]?>
                    </td>
                    <td>
                        <?= $pegawai["jenis_kelamin"]?>
                    </td>
                    <td>
                        <?= $pegawai["alamat"]?>
                    </td>
                    <td style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
                        <a href="profile.php?id=<?= $pegawai["id"] ?>" style="text-decoration: none;">
                            <button type="button" style="cursor: pointer; padding: 4px 8px; background-color: blue; color: white;">
                                Detail
                            </button>
                        </a>
                        <a href="edit.php?id=<?= $pegawai["id"] ?>" style="text-decoration: none;">
                            <button type="button" style="cursor: pointer; padding: 4px 8px; background-color: yellow;">
                                Edit
                            </button>
                        </a>
                        <a href="delete.php?id=<?= $pegawai["id"] ?>" style="text-decoration: none;">
                            <button type="button" style="cursor: pointer; padding: 4px 8px; background-color: red; color: white;">
                                Hapus
                            </button>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>