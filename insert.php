<?php
    
    include("connection.php");

    $nama = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $alamat = $_POST["alamat"];
    $tempat_lahir = $_POST["tempat_lahir"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $nomor_seluler = $_POST["nomor_seluler"];
    $status_perkawinan = $_POST["status_perkawinan"];

    $foto = "";

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $ekstensi = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nama_file = strtolower(str_replace(' ', '-', $nama));
        $nama_file_baru = $nama_file . "-" . time() . "." . $ekstensi;
        
        $folder_tujuan = "uploads/foto-profil/" . $nama_file_baru;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $folder_tujuan)) {
            $foto = $nama_file_baru;
        }
    }

    try {
        $db->query(
            "INSERT INTO pegawai (
                nama, 
                jenis_kelamin,
                alamat,
                tempat_lahir,
                tanggal_lahir,
                nomor_seluler,
                status_perkawinan),
                foto
            ) VALUES (
                '$nama',
                '$jenis_kelamin',
                '$alamat',
                '$tempat_lahir',
                '$tanggal_lahir',
                '$nomor_seluler',
                '$status_perkawinan',
                '$foto'
            )"
        );
        header("Location:index.php");
    } catch(Exception $e) {
        echo "Gagal insert ke database: " . $e->getMessage();
    }