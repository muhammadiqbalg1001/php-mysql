<?php

    include("connection.php");

    $id = $_GET["id"];

    try {
        $db->query("DELETE FROM pegawai WHERE id = $id");
        header("Location:index.php");
    } catch(Exception $e) {
        echo "Gagal menghapus data" . $e->getMessage();
    }