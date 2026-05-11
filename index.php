<?php

include("connection.php");

$query = mysqli_query($connection, "SELECT * FROM pegawai");
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

echo "<pre>";
print_r($result);