<?php
session_start();
$title = "Pengaturan Acount - Sipres";
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

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengaturan Acount</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Pengaturan Acount</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-secondary">
                <div class="row p-3">
                    <div class="col-md-4">
                        <h5>Ubah Password <b><?= $admin["nama_lengkap"]; ?></b></h5>
                        <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $_SESSION['error'];  ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                        <?php } ?>
                        <form action="acount/edit.php" method="POST">
                            <input type="hidden" name="id_password" id="id_pasword" value="<?= $admin['id']; ?>">
                            <div class="form-group">
                                <label for="password1">Password</label>
                                <input type="password" class="form-control" name="password1" id="password1"
                                    autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password2">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="password2" id="password2"
                                    autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary" name="ubah">Ubah Password!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>