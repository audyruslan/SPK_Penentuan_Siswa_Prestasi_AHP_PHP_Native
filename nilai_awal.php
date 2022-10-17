<?php
session_start();
$title = "Nilai Awal - Sipres";
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
$user = $_SESSION["username"];
$query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");
$admin = mysqli_fetch_assoc($query);
require 'layouts/sidebar.php'; ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nilai Awal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Nilai Awal</li>
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
                            Tambah Nilai Awal
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai Awal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="Formnilai_awal" action="nilai_awal/tambah.php" method="post">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="siswa">Siswa</label>
                                                        <select class="form-control" name="siswa" id="siswa"
                                                            autocomplete="off">
                                                            <option value="">-- Silahkan Pilih-- </option>
                                                            <?php
                                                            $sql = mysqli_query($conn, "SELECT * FROM data_alternatif");
                                                            while ($role = mysqli_fetch_assoc($sql)) {
                                                            ?>
                                                            <option value="<?= $role['id_alternatif']; ?>">
                                                                <?= $role["nama"]; ?>
                                                            </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php
                                                $kriteriasql = mysqli_query($conn, "SELECT * FROM data_kriteria ORDER BY id_kriteria ASC");
                                                while ($rowkri = mysqli_fetch_array($kriteriasql)) {
                                                ?>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="<?= $rowkri["nama_kriteria"] ?>"><?= ucfirst($rowkri["nama_kriteria"]) ?></label>
                                                        <input type="text" autocomplete="off"
                                                            name="kriteria[<?= $rowkri["id_kriteria"] ?>]"
                                                            id="kriteria[<?= $rowkri["id_kriteria"] ?>]"
                                                            autocomplete="off" class="form-control"
                                                            placeholder="Masukkan <?= $rowkri['nama_kriteria'] ?>">
                                                        <!-- <input type="text" autocomplete="off" class="form-control"
                                                            id="kriteriaC1" name="kriteriaC1"
                                                            value="<?= $row["nama_kriteria"]; ?>"
                                                            placeholder="Nama Sikap"> -->
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="periode">Periode</label>
                                                        <select class="form-control" name="periode" id="periode"
                                                            autocomplete="off">
                                                            <option value="">-- Silahkan Pilih-- </option>
                                                            <?php
                                                            for ($i = 2022; $i <= 2025; $i++) :
                                                            ?>
                                                            <option value="<?= $i; ?>"><?= $i; ?></option>
                                                            <?php
                                                            endfor;
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
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
                            <table class="table table-bordered table-hover" id="nilai_awal" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                        <th>Periode</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                $sql = mysqli_query($conn, "SELECT * FROM nilai_awal");
                                while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['nilai']; ?></td>
                                    <td><?php
                                            if ($row['keterangan'] == "A") {
                                                echo "Sangat Memuaskan";
                                            } elseif ($row['keterangan'] == "B") {
                                                echo "Baik";
                                            } elseif ($row['keterangan'] == "C") {
                                                echo "Cukup";
                                            } else {
                                                echo "Kurang";
                                            }
                                            ?></td>
                                    <td><?= $row['periode']; ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-sm hapus_nilai_awal"
                                            href="nilai_awal/hapus.php?id=<?= $row["id_nilai_awal"]; ?>"><i
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