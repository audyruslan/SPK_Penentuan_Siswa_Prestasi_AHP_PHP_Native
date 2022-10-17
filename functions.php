<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "ahp2");
// link
$base_url = "http://localhost/sipres2";
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Format Tanggal Indo
function tanggal_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"]; //$email isi dng session email.
    //cocokan data pengguna berdasarkan $email.
    $data = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    //ambil data hasil pencocokan.
    $pengguna = mysqli_fetch_assoc($data);

    //data ini hanya untuk level admin
    if ($_SESSION["role_id"] == "1") {
        //hitung semua pengguna
        $count = mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC");
        $totalPengguna = mysqli_num_rows($count); //total pengguna
        //hitung semua admin
        $count = mysqli_query($conn, "SELECT * FROM user WHERE role_id='1'");
        $totalAdmin = mysqli_num_rows($count); //total admin
        //hitung semua user
        $count = mysqli_query($conn, "SELECT * FROM user WHERE role_id='2'");
        $totalUser = mysqli_num_rows($count); //total user
    } else {
        //hitung semua pengguna
        $count = mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC");
        $totalPengguna = mysqli_num_rows($count); //total pengguna
        //hitung semua admin
        $count = mysqli_query($conn, "SELECT * FROM user WHERE role_id='1'");
        $totalAdmin = mysqli_num_rows($count); //total admin
        //hitung semua user
        $count = mysqli_query($conn, "SELECT * FROM user WHERE role_id='2'");
        $totalUser = mysqli_num_rows($count); //total user

    }
}

// Hapus Data User
function hapus_user($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM user WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Alternatif
function hapus_alternatif($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM data_alternatif WHERE id_alternatif = '$id'");
    return mysqli_affected_rows($conn);
}
// Hapus Data preferensi
function hapus_preferensi($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM nilai WHERE id_nilai = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Kriteria
function hapus_kriteria($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM data_kriteria WHERE id_kriteria = '$id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Nilai Awal
function hapus_nilai_awal($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM nilai_awal WHERE id_nilai_awal = '$id'");
    return mysqli_affected_rows($conn);
}

function avatar($character)
{
    $path = "image/" . time() . ".png";
    $image = imagecreate(200, 200);
    $red = rand(0, 255);
    $green = rand(0, 255);
    $blue = rand(0, 255);
    imagecolorallocate($image, $red, $green, $blue);
    $textcolor = imagecolorallocate($image, 255, 255, 255);

    $font = dirname(__FILE__) . "/dist/font/arial.ttf";

    imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
    imagepng($image, $path);
    imagedestroy($image);
    return $path;
}