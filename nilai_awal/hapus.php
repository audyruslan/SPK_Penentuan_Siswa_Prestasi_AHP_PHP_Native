<?php
session_start(); 
require '../functions.php';

$id = $_GET["id"];

if (hapus_nilai_awal($id) > 0) {
    $_SESSION['status'] = "Data Nilai Awal";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil Dihapus";
    header("Location: ../nilai_awal.php");
} else {
    $_SESSION['status'] = "Data Nilai Awal";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal Dihapus";
    header("Location: ../nilai_awal.php");
}