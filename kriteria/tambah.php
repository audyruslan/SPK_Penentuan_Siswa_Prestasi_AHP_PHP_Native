<?php
session_start();
require '../functions.php';

function tambah($data)
{
    global $conn;

    $id_kriteria = $data['id_kriteria'];
    $nama_kriteria = $data['nama_kriteria'];
    $bobot_kriteria = $data['bobot_kriteria'];

    // tambahkan data ke database
    mysqli_query($conn, "INSERT INTO data_kriteria 
        (id_kriteria,nama_kriteria,jumlah_kriteria,bobot_kriteria)
        VALUES
        ('$id_kriteria','$nama_kriteria','','$bobot_kriteria')");

    return mysqli_affected_rows($conn);
}

//Jika Tombol Tambah Ditekan
if (isset($_POST["tambah"])) {

    if (tambah($_POST) > 0) {
        $_SESSION['status'] = "Data Kriteria";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../kriteria.php");
    } else {
        $_SESSION['status'] = "Data Kriteria";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../kriteria.php");
    }
}