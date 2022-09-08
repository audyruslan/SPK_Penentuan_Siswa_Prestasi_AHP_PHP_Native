<?php
session_start();
$title = "Hasil Akhir - Sipres";
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
include_once 'includes/alternatif.inc.php';
include_once 'includes/kriteria.inc.php';
include_once 'includes/ranking.inc.php';
 
$altObj = new Alternatif($db);

$kriObj = new Kriteria($db);

$ranObj = new Ranking($db);
$stmt = $ranObj->readKhusus();
$stmty = $ranObj->readKhusus();
$count = $ranObj->countAll();
$stmtx1y = $ranObj->readBob();
$stmtx2y = $ranObj->readBob();
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Hasil Akhir</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Hasil Akhir</li>
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
                        <table width="100%" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center active">Alternatif</th>
                                    <th colspan="<?php $kri1b = $kriObj->readAll(); echo $kri1b->rowCount(); ?>"
                                        class="text-center">Kriteria</th>
                                    <th rowspan="2" class="text-center warning">Hasil Akhir</th>
                                </tr>
                                <tr>
                                    <?php $kri2b = $kriObj->readAll(); while ($row = $kri2b->fetch(PDO::FETCH_ASSOC)): ?>
                                    <th><?=$row['nama_kriteria']?></th>
                                    <?php endwhile; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $alt1b = $altObj->readByFilter(); while ($row1 = $alt1b->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr>
                                    <th class="active"><?=$row1['nama']?></th>
                                    <?php $a1 = $row1['id_alternatif']; ?>
                                    <?php $kri2b = $kriObj->readAll(); while ($row2 = $kri2b->fetch(PDO::FETCH_ASSOC)): ?>
                                    <?php $b2 = $row2['id_kriteria']; ?>
                                    <?php $ran1b = $ranObj->readR($a1, $b2); while ($row3 = $ran1b->fetch(PDO::FETCH_ASSOC)): ?>
                                    <td>
                                        <?php
                                        $norx = $row3['skor_alt_kri'] * $row2['bobot_kriteria'];
										//pow($row3['skor_alt_kri'],$bobot);
										echo number_format($norx, 4, '.', ',');
										$ranObj->ia = $a1;
										$ranObj->ik = $b2;
										$ranObj->nn4 = $norx;
										$ranObj->normalisasi1();
	              	?>
                                    </td>
                                    <?php endwhile; ?>
                                    <?php endwhile; ?>
                                    <td class="warning">
                                        <?php
							$stmthasil = $ranObj->readHasil1($a1);
							$hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
							echo number_format($hasil['bbn'], 4, '.', ',');
							$ranObj->ia = $a1;
							$ranObj->has1 = $hasil['bbn'];
							$ranObj->hasil1();
							?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>