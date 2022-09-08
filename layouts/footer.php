 <!-- /.content-wrapper -->
 <footer class="main-footer">
     <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
     All rights reserved.
     <div class="float-right d-none d-sm-inline-block">
         <b>Version</b> 3.2.0
     </div>
 </footer>

 <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
     <!-- Control sidebar content goes here -->
 </aside>
 <!-- /.control-sidebar -->
 </div>
 <!-- ./wrapper -->

 <!-- jQuery -->
 <script src="plugins/jquery/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="plugins/jquery-ui/jquery-ui.min.js"></script>\
 <!-- Bootstrap 4 -->
 <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- ChartJS -->
 <script src="plugins/chart.js/Chart.min.js"></script>
 <!-- Sparkline -->
 <script src="plugins/sparklines/sparkline.js"></script>
 <!-- JQVMap -->
 <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
 <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
 <!-- jQuery Knob Chart -->
 <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
 <!-- daterangepicker -->
 <script src="plugins/moment/moment.min.js"></script>
 <script src="plugins/daterangepicker/daterangepicker.js"></script>
 <!-- Tempusdominus Bootstrap 4 -->
 <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
 <!-- Summernote -->
 <script src="plugins/summernote/summernote-bs4.min.js"></script>
 <!-- overlayScrollbars -->
 <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- AdminLTE App -->
 <script src="dist/js/adminlte.js"></script>
 <!-- Sweetalert -->
 <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
 <!-- DataTables  & Plugins -->
 <script src="plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
 <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
 <!-- Datatable -->
 <!-- jquery-validation -->
 <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
 <script src="plugins/jquery-validation/additional-methods.min.js"></script>
 <script>
$(function() {
    $("#alternatif").DataTable();
    $("#preferensi").DataTable();
    $("#kriteria").DataTable();
    $("#nilai_awal").DataTable();
    $("#add_role").DataTable();
});
 </script>
 <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
 <script>
Swal.fire({
    title: '<?= $_SESSION['status'];  ?>',
    icon: '<?= $_SESSION['status_icon'];  ?>',
    text: '<?= $_SESSION['status_info'];  ?>'
});
 </script>
 <?php
        unset($_SESSION['status']);
    }
    ?>

 <script>
// Hapus User
$(document).on('click', '.hapus_admin', function(e) {

    e.preventDefault();
    var href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data User!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }

    })

});

// Hapus Nilai Preferensi
$(document).on('click', '.hapus_preferensi', function(e) {

    e.preventDefault();
    var href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data Nilai Prefensi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }

    })

});

// Hapus Alternatif
$(document).on('click', '.hapus_alternatif', function(e) {

    e.preventDefault();
    var href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data Alternatif!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }

    })

});

// Hapus Kriteria
$(document).on('click', '.hapus_kriteria', function(e) {

    e.preventDefault();
    var href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data Kriteria!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }

    })

});

// Hapus Nilai Awal
$(document).on('click', '.hapus_nilai_awal', function(e) {

    e.preventDefault();
    var href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data Nilai Awal!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }

    })

});
 </script>
 <!--Form Validation Data Kriteria -->
 <script>
$(function() {
    $('#Formpreferensi').validate({
        rules: {
            keterangan_nilai: {
                required: true,
            },
            nilai: {
                required: true,
                pattern: /^[0-9.]+$/
            }
        },
        messages: {
            keterangan_nilai: {
                required: "Nama Kriteria Tidak Boleh Kosong",
            },
            nilai: {
                pattern: "Isi hanya boleh angka",
                required: "Bobot Kriteria Tidak Boleh Kosong",
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
    $('#Formkriteria').validate({
        rules: {
            nama_kriteria: {
                required: true,
            },
            bobot_kriteria: {
                required: true,
                pattern: /^[0-9.]+$/
            }
        },
        messages: {
            nama_kriteria: {
                required: "Nama Kriteria Tidak Boleh Kosong",
            },
            bobot_kriteria: {
                required: "Bobot Kriteria Tidak Boleh Kosong",
                pattern: "Inputan Hanya Boleh Angka dan titik"

            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
    $('#Formnilai_awal').validate({
        rules: {
            "siswa": {
                required: true,
            },
            "periode": {
                required: true,
            },
            "kriteria[C1]": {
                required: true,
            },
            "kriteria[C2]": {
                required: true,
            },
            "kriteria[C3]": {
                required: true,
            },
            "kriteria[C4]": {
                required: true,
            },
        },
        messages: {
            "siswa": {
                required: "Siswa belum dipilih",
            },
            "periode": {
                required: "Periode belum dipilih",
            },
            "kriteria[C1]": {
                required: "Nilai Sikap Tidak Boleh Kosong",
            },
            "kriteria[C2]": {
                required: "Nilai Akademik Tidak Boleh Kosong",
            },
            "kriteria[C3]": {
                required: "Nilai Ekstrakulikuler Tidak Boleh Kosong",
            },
            "kriteria[C4]": {
                required: "Nilai Absensi Tidak Boleh Kosong",
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
    $('#Formalternatif').validate({
        rules: {
            "kelas": {
                required: true,
            },
            "nama_lengkap": {
                required: true,
            },
            "nis": {
                required: true,
                pattern: /^[0-9.]+$/
            },
            "tmp_lahir": {
                required: true,
            },
            "tgl_lahir": {
                required: true,
            },
            "jenis_kelamin": {
                required: true,
            },
            "alamat": {
                required: true,
            },
        },
        messages: {
            "kelas": {
                required: "Kelas belum dipilih",
            },
            "nama_lengkap": {
                required: "Nama Lengkap tidak boleh kosong",
            },
            "nis": {
                required: "Nomor Induk Siswa Tidak Boleh Kosong",
                pattern: "Hanya Boleh angka"
            },
            "tmp_lahir": {
                required: "Tempat Lahir Tidak Boleh Kosong",
            },
            "tgl_lahir": {
                required: "Tanggal Lahir Tidak Boleh Kosong",
            },
            "jenis_kelamin": {
                required: "Jenis Kelamin Tidak Boleh Kosong",
            },
            "alamat": {
                required: "Alamat Tidak Boleh Kosong",
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
 </script>
 </body>

 </html>