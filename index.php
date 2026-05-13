<?php

include("connection.php");

$query = mysqli_query($connection, "SELECT * FROM pegawai");
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai</title>
    <style>
        tr > td {
            margin: 1rem;
        }
    </style>
</head>
<body>
    <h1>Data Pegawai</h1>
    <a href="add.php" style="text-decoration: none;">
        <button type="button" style="cursor: pointer; padding: 4px 6px;">
            Tambah Data
        </button>
    </a>
    <br>
    <br>
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