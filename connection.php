<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=kepegawaian", "root", "");
} catch (Exception $e) {
    echo $e->getMessage();
}
