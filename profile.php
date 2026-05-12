<?php

    include("connection.php");
    
    $id = $_GET["id"];
    $query = mysqli_query($connection, "SELECT * FROM pegawai WHERE id = $id");
    $pegawai = mysqli_fetch_assoc($query);

    echo "<pre>";
    print_r($pegawai);
