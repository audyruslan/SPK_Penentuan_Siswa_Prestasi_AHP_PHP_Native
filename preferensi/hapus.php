<?php
session_start(); 
require '../functions.php';

$id = $_GET["id"];

if (hapus_preferensi($id) > 0) {
    $_SESSION['status'] = "Data Preferensi";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil Dihapus";
    header("Location: ../nilai_preferensi.php");
} else {
    $_SESSION['status'] = "Data Preferensi";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal Dihapus";
    header("Location: ../nilai_preferensi.php");
}