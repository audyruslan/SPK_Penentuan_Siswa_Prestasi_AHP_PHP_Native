<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "ahp2";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
    echo 'Gagal melakukan koneksi ke Database :  ' . mysqli_connect_error();
}

require '../fpdf/fpdf.php';

$pdf = new FPDF('L', 'mm', 'Letter');
$pdf->AddPage('L', 'A4');

$sql =  mysqli_query($koneksi, "SELECT * FROM data_alternatif");
$no_hasil = 1;

$judul = "LAPORAN CALON SISWA BERPRESTASI PADA SMAN 2 BALAESANG";
$header = array(
    array("label" => "No.", "length" => 10, "align" => "C"),
    array("label" => "Kelas", "length" => 35, "align" => "C"),
    array("label" => "Nama Siswa", "length" => 60, "align" => "C"),
    array("label" => "Jenis Kelamin", "length" => 40, "align" => "C"),
    array("label" => "Alamat", "length" => 80, "align" => "C"),
    array("label" => "Rangking", "length" => 60, "align" => "C")
);

#sertakan library FPDF dan bentuk objek

#gambar kop
$pdf->Image('kop.png', 10, 10, 277);

#tampilkan judul laporan
$pdf->SetFont('Arial', 'B', '16');
$pdf->Cell(0, 45, '', '0', 1, 'C');
$pdf->Cell(0, 15, $judul, '0', 1, 'C');

#buat header tabel
$pdf->SetFont('Arial', 'B', '12');
$pdf->SetFillColor(67, 72, 77);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(0, 0, 0);
foreach ($header as $kolom) {
    $pdf->Cell($kolom['length'], 8, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();

#tampilkan data tabelnya
$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill = false;
while ($row = mysqli_fetch_array($sql)) {
    $id_tampil = $row['id_alternatif'];
    $sql_1 =  mysqli_query($koneksi, "SELECT * FROM data_alternatif WHERE id_alternatif='$id_tampil'");
    while ($row_1 = mysqli_fetch_array($sql_1)) {
        $pdf->Cell(10, 8, $no_hasil++ . '.', 1, '0', 'C', $fill);
        $pdf->Cell(35, 8, $row_1['id_kelas'], 1, '0', 'C', $fill);
        $pdf->Cell(60, 8, $row_1['nama'], 1, '0', 'C', $fill);
        $pdf->Cell(40, 8, $row_1['kelamin'], 1, '0', 'C', $fill);
        $pdf->Cell(80, 8, $row_1['alamat'], 1, '0', 'C', $fill);
        $pdf->Cell(60, 8, $row_1['hasil_akhir'], 1, '1', 'C', $fill);
    }
    $fill = !$fill;
}

#output file PDF
$pdf->Output('I');