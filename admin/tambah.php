<?php
session_start();
require '../functions.php';

function tambah($data)
{
    global $conn;

    $nama_lengkap = $data['nama_lengkap'];
    $username = $data['username'];
    $jabatan = $data['jabatan'];
    $role_id = "1";
    $password = $data['password'];
    $img_dir = avatar($data['nama_lengkap'][0]);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user (username,nama_lengkap,jabatan,role_id,img_dir,password) VALUES('$username','$nama_lengkap','$jabatan','$role_id', '$img_dir','$password')");

    return mysqli_affected_rows($conn);
}

//Data Menu
if (isset($_POST["tambah"])) {

    if (tambah($_POST) > 0) {
        $_SESSION['status'] = "Admin Baru";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../add_role.php");
    } else {
        $_SESSION['status'] = "Admin Baru";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../add_role.php");
    }
}