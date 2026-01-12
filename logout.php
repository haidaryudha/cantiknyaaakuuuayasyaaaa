<?php
session_start(); // Mulai sesi
session_destroy(); // Hancurkan sesi (Hapus data login)
header("Location: login.php"); // Lempar balik ke halaman login
?>