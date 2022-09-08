<?php
session_start();
require '../functions.php';

function ubah($data)
{
    global $conn;
    $id = $data["id_password"];
    $password1 = $data['password1'];
    $password2 = $data['password2'];

    if ($password1 == $password2) {
        // enkripsi password
        $password1 = password_hash($password1, PASSWORD_DEFAULT);

        $query = "UPDATE user
                SET
				password = '$password1'
                WHERE id = $id
			";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    } else {
        $_SESSION['error'] = "<strong>Password Salah!</strong>";
    }
}

// Ubah Data
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah"])) {

    // cek apakah data berhasil diubah atau tidak
    if (ubah($_POST) > 0) {
        $_SESSION['status'] = "Password Anda";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Diubah";
        header("Location: ../acount.php");
    } else {
        $_SESSION['status'] = "Password Anda";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Diubah";
        header("Location: ../acount.php");
    }
}