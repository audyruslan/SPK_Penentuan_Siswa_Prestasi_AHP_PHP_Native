<?php
session_start();
require '../functions.php';

function tambah($data)
{
    global $conn;

    $id_alternatif = $data['id_alternatif'];
    $kelas = $data['kelas'];
    $nama_lengkap = $data['nama_lengkap'];
    $nis = $data['nis'];
    $tmp_lahir = $data['tmp_lahir'];
    $tgl_lahir = $data['tgl_lahir']; 
    $jenis_kelamin = $data["jenis_kelamin"];
    $alamat = $data["alamat"];

    // tambahkan data ke database
    mysqli_query($conn, "INSERT INTO data_alternatif 
        VALUES
        ('$id_alternatif','$kelas','$nis','$nama_lengkap','$tmp_lahir','$tgl_lahir','$jenis_kelamin','$alamat','')");

    return mysqli_affected_rows($conn);
}

//Jika Tombol Tambah Ditekan
if (isset($_POST["tambah"])) {

    if (tambah($_POST) > 0) {
        $_SESSION['status'] = "Data Alternatif";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../alternatif.php");
    } else {
        $_SESSION['status'] = "Data Alternatif";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../alternatif.php");
    }
}