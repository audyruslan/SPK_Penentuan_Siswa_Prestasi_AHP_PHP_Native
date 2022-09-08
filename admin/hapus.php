<?php
session_start();
require '../functions.php';

$id = $_GET["id"];

// Query Data Admin
$sql = mysqli_query($conn, "SELECT * FROM user
                    WHERE id = '$id'");
$image = mysqli_fetch_assoc($sql);

// Hapus Gambar Admin
$gambar = $image['img_dir'];
if (file_exists("$gambar")) {
    unlink("$gambar");
}

if (hapus_user($id) > 0) {
    $_SESSION['status'] = "Data Pengguna";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil Dihapus";
    header("Location: ../add_role.php");
} else {
    $_SESSION['status'] = "Data Pengguna";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal Dihapus";
    header("Location: ../add_role.php");
}