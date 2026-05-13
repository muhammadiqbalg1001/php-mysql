<?php

    include("connection.php");
    
    $id = $_GET["id"];
    $query = mysqli_query($connection, "SELECT * FROM pegawai WHERE id = $id");
    $pegawai = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pegawai - <?= $pegawai["nama"]; ?></title>
    <style>
        input[readonly], textarea[readonly] {
            cursor: not-allowed;
            border: 1px solid #d1d5db;
            padding: 8px;
            width: 100%;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .container {
            max-width: 500px;
            margin: 20px auto;
            font-family: sans-serif;
        }
        .button-nav {
            padding: 1rem;
            display: inline-flexbox;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= $pegawai["nama"] ?> - Profil Pegawai</h1>
        <div class="button-nav">
            <a href="index.php" style="text-decoration: none;">
                <button type="button" style="cursor: pointer; padding: 4px 6px;">
                    Kembali
                </button>
            </a>
            <a href="index.php" style="text-decoration: none;">
                <button type="button" style="cursor: pointer; padding: 4px 6px;">
                    Kembali
                </button>
            </a>
        </div>
        <form>
            <label for="">Nama</label>
            <input type="text" value="<?= $pegawai["nama"]; ?>" readonly>
            
            <label for="">Jenis Kelamin</label>
            <input type="text" value="<?= $pegawai["jenis_kelamin"]; ?>" readonly>
            
            <label for="">Alamat</label>
            <textarea rows="4" readonly><?= $pegawai["alamat"]; ?></textarea>
            
            <label for="">Tempat Lahir</label>
            <input type="text" value="<?= $pegawai["tempat_lahir"]; ?>" readonly>
            
            <label for="">Tanggal Lahir</label>
            <input type="date" value="<?= $pegawai["tanggal_lahir"]; ?>" readonly>
            
            <label for="">No. Seluler</label>
            <input type="text" value="<?= $pegawai["nomor_seluler"]; ?>" readonly>
            
            <label for="">Status Perkawinan</label>
            <input type="text" value="<?= $pegawai["status_perkawinan"]; ?>" readonly>
        </form>
    </div>
</body>
</html>
