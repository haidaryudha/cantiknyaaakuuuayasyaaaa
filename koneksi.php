<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "planmaster";  // <--- HAPUS 'db_' nya, samain kayak di phpMyAdmin

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Gagal Konek: " . mysqli_connect_error());
}
?>