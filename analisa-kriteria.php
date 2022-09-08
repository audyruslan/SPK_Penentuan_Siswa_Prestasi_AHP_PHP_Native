<?php
session_start();
$title = "Analisa Kriteria - Sipres";
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
                    window.location="' . $base_url . '/' . $_SESSION["role"] . '/";
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
include_once('includes/kriteria.inc.php');
include_once('includes/nilai.inc.php');

$kriteriaObj = new Kriteria($db);
$nilaiObj = new Nilai($db);

$kriteriaCount = $kriteriaObj->countAll();

$r = [];
$kriterias = $kriteriaObj->readAll();
while ($row = $kriterias->fetch(PDO::FETCH_ASSOC)) {
    $kriteriass = $kriteriaObj->readSatu($row['id_kriteria']);
    while ($roww = $kriteriass->fetch(PDO::FETCH_ASSOC)) {
        $pcs = explode("C", $roww['id_kriteria']);
        $c = $kriteriaCount - $pcs[1];
    }
    if ($c >= 1) {
        $r[$row['id_kriteria']] = $c;
    }
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Analisa Kriteria</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Analisa Kriteria</li>
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
                    <form method="post" action="analisa-kriteria-tabel.php">
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
                        <?php for ($i = 1; $i <= $v; $i++) : ?>
                        <?php $rows = $kriteriaObj->readSatu($k);
                                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <?php $rows = $kriteriaObj->readSatu($k);
                                                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <input type="text" class="form-control" value="<?= $row['nama_kriteria'] ?>"
                                        readonly />
                                    <input type="hidden" name="<?= $k ?><?= $no ?>"
                                        value="<?= $row['id_kriteria'] ?>" />
                                    <?php endwhile; ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="nl<?= $no ?>">
                                        <?php $rows = $nilaiObj->readAll();
                                                    while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                                        <option value="<?= $row['jum_nilai'] ?>"><?= $row['jum_nilai'] ?> -
                                            <?= $row['ket_nilai'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <?php $pcs = explode("C", $k);
                                                $nid = "C" . ($pcs[1] + $i); ?>
                                    <?php $rows = $kriteriaObj->readSatu($nid);
                                                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <input type="text" class="form-control" value="<?= $row['nama_kriteria'] ?>"
                                        readonly />
                                    <input type="hidden" name="<?= $nid ?><?= $no ?>"
                                        value="<?= $row['id_kriteria'] ?>" />
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>

                        <?php endwhile;
                                $no++; ?>
                        <?php endfor; ?>
                        <?php endforeach; ?>
                        <button type="submit" name="submit" class="btn btn-dark mb-3"> Selanjutnya <span
                                class="fa fa-arrow-right"></span>
                        </button>
                </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>