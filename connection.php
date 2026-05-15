<?php

try {
    $db = new PDO("mysql:host=localhost:3307;dbname=kepegawaian", "root", "");
} catch (Exception $e) {
    echo $e->getMessage();
}
