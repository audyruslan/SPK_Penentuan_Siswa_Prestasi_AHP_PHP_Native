<?php
session_start();
$title = "Tabel Analisa Kriteria - Sipres";
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
include_once('includes/bobot.inc.php');
include_once('includes/kriteria.inc.php');

$bobotObj = new Bobot($db);
$count = $bobotObj->countAll(); 

if (isset($_POST['submit'])) {
    echo "heyehye";
    $kriteriaObj = new Kriteria($db);
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

    $no = 1;
    foreach ($r as $k => $v) {
        for ($i = 1; $i <= $v; $i++) {
            $pcs = explode("C", $k);
            $nid = "C" . ($pcs[1] + $i);

            if ($bobotObj->insert($_POST[$k . $no], $_POST['nl' . $no], $_POST[$nid . $no])) {
                // ...
            } else {
                $bobotObj->update($_POST[$k . $no], $_POST['nl' . $no], $_POST[$nid . $no]);
            }

            if ($bobotObj->insert($_POST[$nid . $no], 1 / $_POST['nl' . $no], $_POST[$k . $no])) {
                // ...
            } else {
                $bobotObj->update($_POST[$nid . $no], 1 / $_POST['nl' . $no], $_POST[$k . $no]);
            }
            $no++;
        }
    } 

    
}

if (isset($_POST['hapus'])) {
    $bobotObj->delete();
    header("location: analisa-kriteria.php");
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
                        <li class="breadcrumb-item"><a href="analisa-kriteria.php">Analisa Kriteria</a></li>
                        <li class="breadcrumb-item active">Tabel Analisa Kriteria</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card bg-gradient-secondary card-outline card-secondary">
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Antar Kriteria</th>
                                    <?php $bobots1 = $bobotObj->readAll2();
                                    while ($row = $bobots1->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <th><?= $row['nama_kriteria'] ?></th>
                                    <?php endwhile; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $bobots2 = $bobotObj->readAll2();
                                while ($baris = $bobots2->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr>
                                    <th class="active"><?= $baris['nama_kriteria'] ?></th>
                                    <?php $bobots3 = $bobotObj->readAll2();
                                        while ($kolom = $bobots3->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <td>
                                        <?php
                                                if ($baris['id_kriteria'] == $kolom['id_kriteria']) {
                                                    echo '1';
                                                    if ($bobotObj->insert($baris['id_kriteria'], '1', $kolom['id_kriteria'])) {
                                                        // ...
                                                    } else {
                                                        $bobotObj->update($baris['id_kriteria'], '1', $kolom['id_kriteria']);
                                                    }
                                                } else {
                                                    $bobotObj->readAll1($baris['id_kriteria'], $kolom['id_kriteria']);
                                                    echo number_format($bobotObj->kp, 4, '.', ',');
                                                }
                                                ?>
                                    </td>
                                    <?php endwhile; ?>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr class="info">
                                    <th>Jumlah</th>
                                    <?php $stmt5 = $bobotObj->readAll2();
                                    while ($row = $stmt5->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <th>
                                        <?php
                                            $bobotObj->readSum1($row['id_kriteria']);
                                            echo number_format($bobotObj->nak, 4, '.', ',');
                                            $bobotObj->insert3($bobotObj->nak, $row['id_kriteria']);
                                            ?>
                                    </th>
                                    <?php endwhile; ?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card bg-gradient-secondary card-outline card-secondary">
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Perbandingan</th>
                                    <?php $bobots1x = $bobotObj->readAll2();
                                    while ($row2x = $bobots1x->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <th><?= $row2x['nama_kriteria'] ?></th>
                                    <?php endwhile; ?>
                                    <th class="info">Jumlah</th>
                                    <th class="success">Rata-rata</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $tot = 0;
                                $bobots2x = $bobotObj->readAll2();
                                while ($baris = $bobots2x->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr>
                                    <th class="active"><?= $baris['nama_kriteria'] ?></th>
                                    <?php $stmt4x = $bobotObj->readAll2();
                                        while ($kolom = $stmt4x->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <td>
                                        <?php
                                            if ($baris['id_kriteria'] == $kolom['id_kriteria']) {
                                                $c = 1 / $kolom['jumlah_kriteria'];
                                                $bobotObj->insert2($c, $baris['id_kriteria'], $kolom['id_kriteria']);
                                                echo number_format($c, 4, '.', ',');
                                            } else {
                                                $bobotObj->readAll1($baris['id_kriteria'], $kolom['id_kriteria']);
                                                $c = $bobotObj->kp / $kolom['jumlah_kriteria'];
                                                $bobotObj->insert2($c, $baris['id_kriteria'], $kolom['id_kriteria']);
                                                echo number_format($c, 4, '.', ',');
                                            }
                                        ?>
                                    </td>
                                    <?php endwhile; ?>
                                    <th class="info">
                                        <?php
                                            $bobotObj->readSum2($baris['id_kriteria']);
                                            $j = $bobotObj->hak;
                                            echo number_format($j, 4, '.', ',');
                                            ?>
                                    </th>
                                    <th class="success">
                                        <?php
                                            $bobotObj->readAvg($baris['id_kriteria']);
                                            $b = $bobotObj->hak;
                                            $bobotObj->insert4($b, $baris['id_kriteria']);
                                            echo number_format($b, 4, '.', ',');
                                            ?>
                                        <?php $tot += $b; ?>
                                    </th>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr class="success">
                                    <th colspan="6"></th>
                                    <th><?php
                                        echo $tot; ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card bg-gradient-secondary card-outline card-secondary">
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Rasio Konsistensi</th>
                                    <th class="info">Jumlah</th>
                                    <th class="success">Prioritas</th>
                                    <th class="warning">Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0;
                                $bobots1z = $bobotObj->readAll2();
                                while ($row1 = $bobots1z->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr>
                                    <th class="active"><?= $row1["nama_kriteria"] ?></th>
                                    <?php 
                                        $bobotObj->readSum1($row1['id_kriteria']); ?>

                                    <th class="info">
                                        <?php
                                        echo number_format($bobotObj->nak, 4, '.', ',');
                                    ?>
                                    </th>
                                    <th class="success"><?= number_format($row1["bobot_kriteria"], 4, '.', ','); ?></th>
                                    <?php $jumlah = $bobotObj->nak * $row1["bobot_kriteria"]; ?>
                                    <th class="warning"><?= number_format($jumlah, 4, '.', ','); ?></th>
                                    <?php $total += $jumlah; ?>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr class="danger">
                                    <th colspan="3">Rata-rata</th>
                                    <th><?php $rata = $total;
                                        echo number_format($rata, 4, '.', ','); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card bg-gradient-secondary card-outline card-secondary">
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th>N (kriteria)</th>
                                    <td><?= $count ?></td>
                                </tr>
                                <tr>
                                    <th>Hasil Akhir (X maks)</th>
                                    <td>
                                        <?php echo $hasil_akhir = number_format($rata, 4, '.', ','); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>IR</th>
                                    <td><?php echo $ir = number_format($bobotObj->getIr($count),2, '.', ','); ?></td>
                                </tr>
                                <tr>
                                    <th>CI</th>
                                    <td><?php $ci = ($rata - $count) / ($count - 1);
                                        echo number_format($ci, 4, '.', ','); ?></td>
                                </tr>
                                <tr>
                                    <th>CR</th>
                                    <td><?php $cr = $ci / $ir;
                                        echo number_format($cr, 4, '.', ','); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php $bobotObj->insert5($hasil_akhir, $ir, $ci, $cr); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
require 'layouts/footer.php'; ?>