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

    $foto_lama = isset($_POST["foto_lama"]) ? $_POST["foto_lama"] : "";

    $foto_untuk_db = $foto_lama;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        // PERBAIKAN: Sesuaikan dengan folder di insert.php
        $folder_tujuan = "uploads/foto-profil/";
        
        if (!is_dir($folder_tujuan)) {
            mkdir($folder_tujuan, 0777, true);
        }

        $ekstensi = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nama_bersih = strtolower(str_replace(' ', '_', $nama));
        $nama_file_baru = $nama_bersih . "_" . time() . "." . $ekstensi;
        
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $folder_tujuan . $nama_file_baru)) {
            // PERBAIKAN: Gunakan variabel $foto_untuk_db
            $foto_untuk_db = $nama_file_baru;
            
            if (!empty($foto_lama) && file_exists($folder_tujuan . $foto_lama)) {
                unlink($folder_tujuan . $foto_lama);
            }
        }
    }

    try {
        // PERBAIKAN: Tambahkan foto='$foto_untuk_db' ke dalam query
        $db->query( 
            "UPDATE pegawai SET 
                nama='$nama', 
                jenis_kelamin='$jenis_kelamin',
                alamat='$alamat',
                tempat_lahir='$tempat_lahir',
                tanggal_lahir='$tanggal_lahir',
                nomor_seluler='$nomor_seluler',
                status_perkawinan='$status_perkawinan',
                foto='$foto_untuk_db'
            WHERE id = $id"
        );
        header("Location:index.php");
    } catch(Exception $e) {
        echo "Gagal update ke database: " . $e->getMessage();
    }
?>