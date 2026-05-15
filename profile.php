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
    <title>Detail Pegawai - <?= $pegawai["nama"]; ?></title>
    <style>
        input[readonly], textarea[readonly] {
            cursor: not-allowed;
            border: 1px solid #d1d5db;
            padding: 8px;
            width: 100%;
            margin-bottom: 15px;
            border-radius: 4px;
            background-color: #f9fafb;
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
            border: 1px solid #e5e7eb;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .profile-photo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 0 auto 20px auto;
            border: 3px solid #d1d5db;
        }
        .no-photo {
            width: 150px;
            height: 150px;
            background-color: #e5e7eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            color: #6b7280;
            font-size: 0.8rem;
            text-align: center;
            border: 3px solid #d1d5db;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" style="text-decoration: none;">
            <button type="button" style="cursor: pointer; padding: 4px 10px; margin-bottom: 1rem;">
                &larr; Kembali
            </button>
        </a>

        <?php if (!empty($pegawai["foto"]) && file_exists("uploads/foto-profil/" . $pegawai["foto"])): ?>
            <img src="uploads/foto-profil/<?= $pegawai["foto"]; ?>" alt="Foto <?= $pegawai["nama"]; ?>" class="profile-photo">
        <?php else: ?>
            <div class="no-photo">
                Tidak ada foto
            </div>
        <?php endif; ?>

        <h1 style="text-align: center; margin-top: 0;"><?= $pegawai["nama"] ?></h1>
        <p style="text-align: center; color: #6b7280; margin-bottom: 2rem;">Profil Pegawai</p>
        
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