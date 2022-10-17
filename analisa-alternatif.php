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
                    <h1 class="m-0">Analisa Alternatif</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Analisa Alternatif</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">

            <a href="hitung-analisa-alternatif.php" class="btn btn-primary mb-3">Hitung Analisa Alternatif</a>

            <div class="card card-outline card-secondary p-3">
                <table class="table table-bordered table-hover" id="table1" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Nilai</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <?php
                        $i = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM data_alternatif
                                            JOIN nilai_awal
                                            ON data_alternatif.id_alternatif = nilai_awal.id_alternatif");
                        while ($row = mysqli_fetch_assoc($sql)) {
                        ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row['id_alternatif']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['nilai']; ?></td>
                        <td>
                            <?php
                                if ($row['keterangan'] == "B") {
                                    echo "Baik";
                                } elseif ($row['keterangan'] == "C") {
                                    echo "Cukup";
                                } else {
                                    echo "Kurang";
                                }
                                ?>
                        </td>
                    </tr>

                    <?php $i++; ?>
                    <?php } ?>
                </table>
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
    $("#table1").DataTable();
    $("#table2").DataTable();
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