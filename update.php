<?php

    include("connection.php");

    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $alamat = $_POST["alamat"];
    $tempat_lahir = $_POST["tempat_lahir"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $nomor_seluler = $_POST["nomor_seluler"];
    $status_perkawinan = $_POST["status_perkawinan"];

    try {
        $db->query( 
            "UPDATE pegawai SET 
                nama='$nama', 
                jenis_kelamin='$jenis_kelamin',
                alamat='$alamat',
                tempat_lahir='$tempat_lahir',
                tanggal_lahir='$tanggal_lahir',
                nomor_seluler='$nomor_seluler',
                status_perkawinan='$status_perkawinan'
            WHERE id = $id");
        header("Location:index.php");
    } catch(Exception $e) {
        echo "Gagal update ke database: " . $e->getMessage();
    }