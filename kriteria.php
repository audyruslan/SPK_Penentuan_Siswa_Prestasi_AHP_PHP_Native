<?php
session_start();
$title = "Data Kriteria - Sipres";
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

include_once 'includes/kriteria.inc.php';
$kriObj = new Kriteria($db);

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kriteria</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Kriteria</li>
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
                            Tambah Kriteria
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai Prefrensi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="Formkriteria" action="kriteria/tambah.php" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="id_kriteria">ID Kriteria</label>
                                                <input type="text" autocomplete="off" class="form-control"
                                                    id="id_kriteria" name="id_kriteria" placeholder="Nama Kriteria"
                                                    value="<?= $kriObj->getNewID() ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_kriteria">Nama Kriteria</label>
                                                <input type="text" autocomplete="off" class="form-control"
                                                    id="nama_kriteria" name="nama_kriteria" placeholder="Nama Kriteria">
                                            </div>
                                            <div class="form-group">
                                                <label for="bobot_kriteria">Bobot Kriteria</label>
                                                <input type="text" autocomplete="off" class="form-control"
                                                    id="bobot_kriteria" name="bobot_kriteria"
                                                    placeholder="Bobot Kriteria">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Kembali</button>
                                            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered table-hover" id="preferensi" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kriteria</th>
                                        <th>Bobot</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                $sql = mysqli_query($conn, "SELECT * FROM data_kriteria");
                                while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['nama_kriteria']; ?></td>
                                    <td><?= $row['bobot_kriteria']; ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-sm hapus_kriteria"
                                            href="kriteria/hapus.php?id_kriteria=<?= $row["id_kriteria"]; ?>"><i
                                                class="fas fa-trash"></i></a>
                                        <!-- <a class="btn btn-success btn-sm ubah" data-toggle="modal"
                                            data-target="#EditModal<?= $row["id_kriteria"]; ?>"><i
                                                class="fas fa-edit"></i> </a> -->
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="EditModal<?= $row["id_kriteria"]; ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="#EditModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="EditModalLabel">Edit Kriteria</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="kriteria/edit.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_kriteria" id="id_kriteria"
                                                        value="<?= $row["id_kriteria"]; ?>">
                                                    <div class="form-group">
                                                        <label for="nama_kriteria">Nama Kriteria</label>
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            id="nama_kriteria" name="nama_kriteria"
                                                            value="<?= $row["nama_kriteria"]; ?>"
                                                            placeholder="Nama Kriteria">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bobot_kriteria">Bobot Kriteria</label>
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            id="bobot_kriteria" name="bobot_kriteria"
                                                            value="<?= $row["bobot_kriteria"]; ?>"
                                                            placeholder="Bobot Kriteria">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Kembail</button>
                                                    <button type="submit" name="ubah"
                                                        class="btn btn-success">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>