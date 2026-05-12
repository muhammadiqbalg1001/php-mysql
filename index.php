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
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Action</th>
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
                    <td>
                        <a href="profile.php?id=<?= $pegawai["id"] ?>" style="text-decoration: none; color: black;">
                            Detail
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>