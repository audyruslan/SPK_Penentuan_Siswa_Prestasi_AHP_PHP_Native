<?php
session_start();
require '../functions.php';

function tambah($data)
{
    global $conn;

    $nilai = $data['jum_nilai'];
    $keterangan_nilai = $data['ket_nilai'];

    // tambahkan data ke database
    mysqli_query($conn, "INSERT INTO nilai
        VALUES
        ('','$nilai','$keterangan_nilai')");

    return mysqli_affected_rows($conn);
}

//Jika Tombol Tambah Ditekan
if (isset($_POST["tambah"])) {

    if (tambah($_POST) > 0) {
        $_SESSION['status'] = "Data Preferensi";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../nilai_preferensi.php");
    } else {
        $_SESSION['status'] = "Data Preferensi";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../nilai_preferensi.php");
    }
}