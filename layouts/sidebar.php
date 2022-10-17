  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="admin.php" class="brand-link">
          <img src="dist/img/Logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">Sipres</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <?php 
            if (!empty($_SESSION["username"])) {
            ?>
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="admin/<?= $admin["img_dir"]; ?>" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="acount.php" class="d-block"><?= $admin["nama_lengkap"]; ?></a>
              </div>
          </div>
          <?php } ?>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <?php 
                if ($_SESSION["role_id"] == "1") {
            ?>
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item menu-open">
                      <a href="admin.php" class="nav-link active">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="nilai_preferensi.php" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Preferensi
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="alternatif.php" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Data Alternatif
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="kriteria.php" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Data Kriteria
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="nilai_awal.php" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Nilai Awal
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Perbandingan
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="analisa-kriteria.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Kriteria</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="analisa-alternatif.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Alternatif</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="hasil_akhir.php" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Hasil Akhir
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">All Setting</li>
                  <li class="nav-item">
                      <a href="rangking.php" class="nav-link">
                          <i class="nav-icon far fa-calendar-alt"></i>
                          <p>
                              Laporan
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Pengaturan
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="acount.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Akun</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="add_role.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Pengguna</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="logout.php" class="nav-link">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>
                              Logout
                          </p>
                      </a>
                  </li>
              </ul>
              <?php 
                } else {
              ?>
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item menu-open">
                      <a href="user.php" class="nav-link active">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Perbandingan
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="analisa-kriteria_user.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Kriteria</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="analisa-alternatif_user.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Alternatif</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="hasil_akhir_user.php" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Hasil Akhir
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">All Setting</li>
                  <li class="nav-item">
                      <a href="rangking_user.php" class="nav-link">
                          <i class="nav-icon far fa-calendar-alt"></i>
                          <p>
                              Laporan
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Pengaturan
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="acount_user.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Akun</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="logout.php" class="nav-link">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>
                              Logout
                          </p>
                      </a>
                  </li>
              </ul>
              <?php 
                }
              ?>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>