<?php
session_start();
$title = "Nilai Preferensi - Sipres";
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
require 'layouts/sidebar.php'; ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nilai Prefrensi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Nilai Prefrensi</li>
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
                            Tambah Nilai Prefrensi
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
                                    <form id="Formpreferensi" action="preferensi/tambah.php" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nilai">Nilai</label>
                                                <input type="text" autocomplete="off" class="form-control" id="nilai"
                                                    name="nilai" placeholder="Nilai">
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan_nilai">Keterangan Nilai</label>
                                                <input type="text" autocomplete="off" class="form-control"
                                                    id="keterangan_nilai" name="keterangan_nilai"
                                                    placeholder="Masukkan Keterangan Nilai">
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
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                $sql = mysqli_query($conn, "SELECT * FROM nilai");
                                while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['jum_nilai']; ?></td>
                                    <td><?= $row['ket_nilai']; ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-sm hapus_preferensi"
                                            href="preferensi/hapus.php?id=<?= $row['id_nilai']; ?>"><i
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
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>