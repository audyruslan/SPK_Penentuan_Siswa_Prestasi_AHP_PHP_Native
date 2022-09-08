<?php
session_start();
$title = "Tambah Pengguna - Sipres";
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
                    <h1 class="m-0">Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Admin</li>
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
                            Tambah Admin
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="admin/tambah.php" method="post">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="nama_lengkap">Nama Lengkap</label>
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            id="nama_lengkap" name="nama_lengkap"
                                                            placeholder="Nama Lengkap">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Jabatan</label>
                                                        <select class="form-control" name="jabatan" id="jabatan">
                                                            <option>-- Silahkan Pilih-- </option>
                                                            <option value="Kepala Sekolah">Kepala Sekolah</option>
                                                            <option value="Guru ">Guru</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            id="username" name="username"
                                                            placeholder="Masukkan Username">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" autocomplete="off" class="form-control"
                                                            id="password" name="password"
                                                            placeholder="Masukkan Password">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label for="">Role</label>
                                                        <select class="form-control" name="role_id" id="role_id">
                                                            <option>-- Silahkan Pilih-- </option>
                                                            <?php
                                                            $sql = mysqli_query($conn, "SELECT * FROM role");
                                                            while ($role = mysqli_fetch_assoc($sql)) {
                                                            ?>
                                                            <option value="<?= $role["id"]; ?>"><?= $role["role"]; ?>
                                                            </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div> -->
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
                            <table class="table table-bordered table-hover" id="add_role" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                $sql = mysqli_query($conn, "SELECT * FROM user");
                                while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['nama_lengkap']; ?></td>
                                    <td><?= $row['username']; ?></td>
                                    <td><?= $row['jabatan']; ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-sm hapus_admin"
                                            href="admin/hapus.php?id=<?= $row["id"]; ?>"><i
                                                class="fas fa-trash"></i></a>
                                        <a class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#EditModal<?= $row["id"]; ?>"><i class="fas fa-edit"></i> </a>
                                    </td>
                                </tr>

                                <!-- Edit Data Pengguna -->
                                <div class="modal fade" id="EditModal<?= $row["id"]; ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="EditModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="EditModalLabel">Edit Data Pengguna</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="admin/edit.php" method="POST">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="hidden" class="form-control" name="id" id="id"
                                                                value="<?= $row["id"] ?>">
                                                            <div class="form-group">
                                                                <label for="nama_lengkap">Nama Lengkap</label>
                                                                <input type="text" value="<?= $row["nama_lengkap"]; ?>"
                                                                    autocomplete="off" class="form-control"
                                                                    id="nama_lengkap" name="nama_lengkap"
                                                                    placeholder="Nama Lengkap">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Kembali</button>
                                                    <button type="submit" name="ubah"
                                                        class="btn btn-primary">Edit</button>
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