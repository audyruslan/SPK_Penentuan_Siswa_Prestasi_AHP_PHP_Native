<?php
session_start();
$title = "Alternatif - Sipres";
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

// Connect DB
include("includes/config.php");
$config = new Config();
$db = $config->getConnection();

include_once 'includes/alternatif.inc.php';
$altObj = new Alternatif($db);
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Alternatif</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Alternatif</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-secondary">
                <div class="row">
                    <div class="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary ml-2 mt-3 mb-3" data-toggle="modal"
                            data-target="#tambahModal">
                            Tambah Alternatif
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Alternatif</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="Formalternatif" action="alternatif/tambah.php" method="post">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="hidden" name="id_alternatif" id="id_alternatif"
                                                        value="<?php echo $altObj->getNewID(); ?>">
                                                    <div class="form-group">
                                                        <label for="kelas">kelas</label>
                                                        <select class="form-control" name="kelas" id="kelas"
                                                            autocomplete="off">
                                                            <option value="">-- Silahkan Pilih-- </option>
                                                            <?php
                                                            $query = mysqli_query($conn, "SELECT * FROM kelas");
                                                            while ($kelas = mysqli_fetch_assoc($query)) {
                                                            ?>
                                                            <option value="<?= $kelas["id_kelas"]; ?>">
                                                                <?= $kelas["nama_kelas"]; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="nama_lengkap">Nama Lengkap</label>
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            id="nama_lengkap" name="nama_lengkap" value=""
                                                            placeholder="Nama Lengkap">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="nis">Nomor Induk Siswa</label>
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            id="nis" name="nis" placeholder="Nomor Induk Siswa">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="tmp_lahir">Tempat Lahir</label>
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            id="tmp_lahir" name="tmp_lahir" placeholder="Tempat Lahir">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                                        <input type="date" autocomplete="off" class="form-control"
                                                            id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                                        <select class="form-control" name="jenis_kelamin"
                                                            id="jenis_kelamin" autocomplete="off" id="jenis_kelamin">
                                                            <option value="">-- Silahkan Pilih-- </option>
                                                            <option value="Laki-laki">Laki-laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea class="form-control" name="alamat" id="alamat"
                                                            autocomplete="off" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Kembali</button>
                                            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered table-hover" id="alternatif" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelas</th>
                                        <th>Nama Lengkap</th>
                                        <th>NIS</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                $sql = mysqli_query($conn, "SELECT * FROM data_alternatif");
                                while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['id_kelas']; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['nis']; ?></td>
                                    <td><?= $row['tempat_lahir']; ?></td>
                                    <td><?= tanggal_indo($row['tanggal_lahir']); ?></td>
                                    <td><?= $row['kelamin']; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-sm hapus_alternatif"
                                            href="alternatif/hapus.php?id=<?= $row["id_alternatif"]; ?>"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>

                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</div>
</section>
</div>

<?php
require 'layouts/footer.php'; ?>