<?php

    include("connection.php");

    $id = $_GET["id"];
    $query = $db->query("SELECT * FROM pegawai WHERE id = $id");
    $pegawai = $query->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pegawai</title>
    <style>
        input, textarea, select {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Data Pegawai</h1>
        <a href="index.php" style="text-decoration: none;">
            <button type="button" style="cursor: pointer; padding: 4px 6px;">
                Kembali
            </button>
        </a>
        <br>
        <br>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?= $pegawai["id"]; ?>">

            <label for="nama">Nama</label>
            <input type="text" name="nama" value="<?= $pegawai["nama"]; ?>">
            
            <label for="jenis kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin">
                <option 
                    value="Pria"
                    <?php 
                        if($pegawai["jenis_kelamin"] == "Laki-Laki")
                        echo "selected";
                    ?>
                >
                    Pria
                </option>
                <option 
                    value="Wanita"
                    <?php 
                        if($pegawai["jenis_kelamin"] == "Wanita")
                        echo "selected";
                    ?>
                >
                    Wanita
                </option>
            </select>
            
            <label for="alamat">Alamat</label>
            <textarea name="alamat" rows="4"><?= $pegawai["alamat"]; ?></textarea>
            
            <label for="tempat lahir">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" value="<?= $pegawai["tempat_lahir"]; ?>">
            
            <label for="tanggal lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="<?= $pegawai["tanggal_lahir"]; ?>">
            
            <label for="nomor seluler">Nomor Seluler</label>
            <input type="text" name="nomor_seluler" value="<?= $pegawai["nomor_seluler"]; ?>">
            
            <label for="status perkawinan">Status Perkawinan</label>
            <select name="status_perkawinan">
                <option 
                    value="Belum Menikah"
                    <?php 
                        if($pegawai["status_perkawinan"] == "Belum Menikah")
                        echo "selected";
                    ?>
                >
                    Belum Menikah
                </option>
                <option 
                    value="Menikah"
                    <?php 
                        if($pegawai["status_perkawinan"] == "Menikah")
                        echo "selected";
                    ?>
                >
                    Menikah
                </option>
            </select>
            
            <button type="submit">Update Data</button>
        </form>
    </div>
</body>
</html>