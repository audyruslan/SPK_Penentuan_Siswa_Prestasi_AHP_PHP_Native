  <?php
    session_start();
    $title = "Dashboard Admin - Sipres";
    require 'layouts/header.php';
    require 'layouts/navbar.php';
    require 'functions.php';
    if (!isset($_SESSION["username"])) {
        echo '<script>
                    alert("Mohon login dahulu !");
                    window.location="' . $base_url . '/login.php";
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
      $role_id = $_SESSION["role_id"];
    $query = mysqli_query($conn, "SELECT * FROM user 
                                 JOIN role
                                 ON user.role_id = role.id WHERE username = '$user' AND role_id = '$role_id'");
    $admin = mysqli_fetch_assoc($query);
    require 'layouts/sidebar.php';
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Dashboard</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                  <div class="col">
                      <div class="alert alert-dark alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h3>Selamat Datang <b><?= $admin["nama_lengkap"]; ?></b>!
                          </h3>
                          Anda Masuk Sebagai <b><?= $admin["role"]; ?></b>.
                      </div>
                  </div>
              </div>
              <div class="row">
                  <?php
                    // Count Data Alternatif
                    $countAlternatif = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_alternatif"));
                    // Count Data Alternatif
                    $countKriteria = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_kriteria"));
                    // Count Data Alternatif
                    $countAwal = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM nilai"));
                    // Count Data Alternatif
                    $countUser = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user"));
                    ?>
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                          <div class="inner">
                              <h3><?= $countAlternatif; ?></h3>

                              <p>Data Alternatif</p>
                          </div>
                          <div class="icon">
                              <i class="ion ion-bag"></i>
                          </div>
                          <a href="alternatif.php" class="small-box-footer">More info <i
                                  class="fas fa-arrow-circle-right"></i></a>
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                          <div class="inner">
                              <h3><?= $countKriteria; ?></h3>

                              <p>Data Kriteria</p>
                          </div>
                          <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                          </div>
                          <a href="kriteria.php" class="small-box-footer">More info <i
                                  class="fas fa-arrow-circle-right"></i></a>
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                          <div class="inner">
                              <h3><?= $countAwal; ?></h3>

                              <p>Data Preferensi</p>
                          </div>
                          <div class="icon">
                              <i class="ion ion-person-add"></i>
                          </div>
                          <a href="nilai_preferensi.php" class="small-box-footer">More info <i
                                  class="fas fa-arrow-circle-right"></i></a>
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                          <div class="inner">
                              <h3><?= $countUser; ?></h3>

                              <p>Data Admin</p>
                          </div>
                          <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                          </div>
                          <a href="add_role.php" class="small-box-footer">More info <i
                                  class="fas fa-arrow-circle-right"></i></a>
                      </div>
                  </div>
                  <!-- ./col -->
              </div>
              <!-- 
              <div class="row">
                  <div class="col">
                      <div class="callout callout-danger">
                          <h3>
                              <i class="fas fa-bullhorn"></i> Sistem Pendukung Keputusan!
                          </h3>
                          <p>Aplikasi <b>Sipres</b> merupakan sebuah <b>Sistem Pedukung Keputusan (SPK)</b> Pemilihan
                              Siswa
                              Berprestasi dengan menggunakan Metode <b>AHP
                                  (Analytical Hierarchy Process)</b> berbasis Website, menggunakan bahasa pemograman PHP
                              Native.
                          </p>
                      </div>
                  </div>
              </div> -->
              <!-- /.row -->
          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
  <?php
    require 'layouts/footer.php';
    ?>