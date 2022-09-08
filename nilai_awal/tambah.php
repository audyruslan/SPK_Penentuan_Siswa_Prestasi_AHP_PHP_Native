<?php
session_start();
require '../functions.php';

function getRange($n)
{
    if ($n >= 88 and $n < 100) {
        return "A";
    } else if ($n >= 77 and $n < 88) {
        return "B";
    } else if ($n >= 60 and $n < 77) {
        return "C";
    } else {
        return "K";
    }
}

function tambah($data)
{
    global $conn;

    $kriteria = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_kriteria ORDER BY id_kriteria ASC"));

    $siswa = $data["siswa"];
    $nilai = (array_sum($data["kriteria"]) / $kriteria);
    $keterangan_nilai = getRange($nilai);
    $periode = $data["periode"];

    // tambahkan data ke tabel Nilai Awal
    mysqli_query($conn, "INSERT INTO nilai_awal 
        VALUES
        ('','$siswa','$nilai','$keterangan_nilai','$periode')");

    // tambahkan data ke tabel Nilai Awal Detail
    $last_id = mysqli_insert_id($conn);
    foreach ($data["kriteria"] as $k => $v) {
        $id_nilai = $last_id;
        $id_kriteria = $k;
        $nilai = $data["kriteria"][$k];

        mysqli_query($conn, "INSERT INTO nilai_awal_detail
                VALUES 
                ('','$id_nilai','$id_kriteria','$nilai')");
    }


    return mysqli_affected_rows($conn);
}

//Jika Tombol Tambah Ditekan
if (isset($_POST["tambah"])) {

    if (tambah($_POST) > 0) {
        $_SESSION['status'] = "Data Nilai Awal";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../nilai_awal.php");
    } else {
        $_SESSION['status'] = "Data Nilai Awal";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../nilai_awal.php");
    }
}