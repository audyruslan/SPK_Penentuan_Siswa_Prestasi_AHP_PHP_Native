<?php
session_start();
$title = "Analisa Alternatif - Sipres";
require 'layouts/header.php';
require 'layouts/navbar.php';
require 'functions.php';
if (!isset($_SESSION["username"])) {
    echo '<script>
                    alert("Mohon login dahulu !");
                    window.location="' . $base_url . '/";
                </script>';
    return false;
}

if ($_SESSION["role_id"] != "1") {
    echo '<script>
                    alert("Maaf Anda Tidak Berhak Ke Halaman ini !");
                    window.location="' . $base_url . '/login.php";
                    </script>';
    return false;
}

// Redirect Halaman ke Analisa Kriteria
$query = mysqli_query($conn, "SELECT * FROM hasil_kriteria");
$hasil_akhir = mysqli_fetch_assoc($query);

if($hasil_akhir["cr_kriteria"] >= 0.1){   
    echo '<script>
    alert("Nilai CR Tidak Konsisten!");
    window.location="analisa-kriteria.php";
    </script>';
    return false;
}


$user = $_SESSION["username"];
$query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");
$admin = mysqli_fetch_assoc($query);
require 'layouts/sidebar.php';

include("includes/config.php");
$config = new Config();
$db = $config->getConnection();
include_once('includes/skor.inc.php');
include_once('includes/alternatif.inc.php');
include_once('includes/kriteria.inc.php');
include_once('includes/nilai.inc.php');

$altObj = new Alternatif($db);
$skoObj = new Skor($db);
$kriObj = new Kriteria($db);
$nilObj = new Nilai($db);

$altCount = $altObj->countByFilter();

$no = 1;
$r = [];
$nid = [];
$alt1 = $altObj->readByFilter();
while ($row = $alt1->fetch(PDO::FETCH_ASSOC)) {
    $alt2 = $altObj->readByFilter();
    while ($roww = $alt2->fetch(PDO::FETCH_ASSOC)) {
        $nid[$row['id_alternatif']][] = $roww['id_alternatif'];
    }
    $total = $altCount - $no;
    if ($total >= 1) {
        $r[$row['id_alternatif']] = $total;
    }
    $no++;
}

$ni = 1;
foreach ($nid as $key => $value) {
    array_splice($nid[$key], 0, $ni++);
}
$ne = count($nid) - 1;
array_splice($nid, $ne, 1);
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Hitung Alternatif</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Hitung Alternatif</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-outline card-secondary">
                <div class="container">
                    <form method="post" action="analisa-alternatif-tabel.php">
                        <div class="row text-center p-3">
                            <div class="col-md-3">
                                <label for="">Pilih Kriteria</label>
                            </div>
                            <div class="col-md-9">
                                <select onchange="myFunction(event)" class="form-control" id="kriterias"
                                    name="kriteria">
                                    <?php $kri2 = $kriObj->readAll();
                                    while ($row = $kri2->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <option data-select="<?= $row['nama_kriteria'] ?>"
                                        value="<?= $row['id_kriteria'] ?>"><?= $row['nama_kriteria'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Kriteria Pertama</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Penilaian</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Kriteria Kedua</label>
                                </div>
                            </div>
                        </div>

                        <?php $no = 1;
                        foreach ($r as $k => $v) : ?>
                        <?php $j = 0;
                            for ($i = 1; $i <= $v; $i++) : ?>
                        <?php $rows = $altObj->readSatu($k);
                                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <?php $rows = $skoObj->readAlternatif($k);?>
                                    <?php while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <input type="text" class="form-control"
                                        value="<?= $row['nama'] . ' - ' . $row['nilai'] ?>" readonly />
                                    <input type="hidden" name="<?= $k ?><?= $no ?>"
                                        value="<?= $row['id_alternatif'] ?>" />
                                    <?php endwhile; ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="nl<?= $no ?>">
                                        <?php $stmt1 = $nilObj->readAll();
                                                    while ($row2 = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>
                                        <option value="<?= $row2['jum_nilai'] ?>"><?= $row2['jum_nilai'] ?> -
                                            <?= $row2['ket_nilai'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <?php $rows = $skoObj->readAlternatif($nid[$k][$j]);
                                                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <input type="text" class="form-control"
                                        value="<?= $row['nama'] . ' - ' . $row['nilai'] ?>" readonly />
                                    <input type="hidden" name="<?= $nid[$k][$j] ?><?= $no ?>"
                                        value="<?= $row['id_alternatif'] ?>" />
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile;
                                $no++;
                                $j++; ?>
                        <?php endfor; ?>
                        <?php endforeach; ?>
                        <button type="submit" name="submit" class="btn btn-dark mb-3"> Selanjutnya <span
                                class="fa fa-arrow-right"></span></button>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>\
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<!-- Datatable -->
<script>
$(function() {
    $("#analisa1").DataTable();
    $("#analisa-alternatif").DataTable();
});
</script>
<script>
function myFunction(e) {
    var x = document.getElementById("kriterias").value;
    if (x == "C4") {
        document.getElementById("myText").value = "C4";
    } else if (x == "C3") {
        document.getElementById("myText").value = "C3";
    }
}
</script>
</body>

</html>