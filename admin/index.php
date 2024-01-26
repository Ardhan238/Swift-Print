<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
</head>

<?php
// Jika form disubmit
if (isset($_POST['hapus_dokumen'])) {
    // Ambil data dari form
    $id_dokumen = $_POST['id_dokumen'];

    // Query untuk menyimpan data ke database
    $query = "DELETE FROM dokumen WHERE id_dokumen = '$id_dokumen'";

    if (mysqli_query($conn, $query)) {
        $script = "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Dokumen berhasil dihapus!',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                </script>
            ";
    } else {
        $script = "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Dokumen Gagal Dihapus!',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                </script>
            ";
    }
}



?>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "topbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Dokumen</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataX" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>No Telp</th>
                                            <th>Email</th>
                                            <th>Metode Pengambilan</th>
                                            <th>File</th>
                                            <th>Tanggal Pengambilan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dokumen = mysqli_query($conn, "SELECT * FROM dokumen");
                                        $i = 1;
                                        ?>
                                        <?php foreach ($dokumen as $td) : ?>
                                        <tr>
                                            <td><?= $i;
                                                    $i++; ?></td>
                                            <td><?= $td['nama_lengkap'] ?></td>
                                            <td><?= $td['alamat'] ?></td>
                                            <td><?= $td['notelp'] ?></td>
                                            <td><?= $td['email'] ?></td>
                                            <td><?= $td['metode_pengambilan'] ?></td>
                                            <td><a href="../dokumen/<?= $td['nama_file']; ?>" download="">Unduh File</a>
                                            </td>
                                            <td>
                                                <?= date('d F, Y', strtotime($td['tanggal_pengambilan'])); ?>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <?php 
                                                            $notelp = $td['notelp'];
                                                            $nama_lengkap = $td['nama_lengkap'];
                                                        ?>
                                                    <a href="https://web.whatsapp.com/send?phone=<?= $notelp; ?>&text=Halo,%20<?= $nama_lengkap; ?>"
                                                        target="_blank" class="btn btn-info">Konfirmasi</a>
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="id_dokumen"
                                                            value="<?= $td['id_dokumen']; ?>">
                                                        <button type="submit" name="hapus_dokumen"
                                                            class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "footer.php"; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include "plugin.php"; ?>
    <?php
    if (isset($script)) {
        echo $script;
    }
    ?>

    <script>
    $(document).ready(function() {
        $('#dataX').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sLast": "Terakhir",
                    "sNext": "Selanjutnya",
                    "sPrevious": "Sebelumnya"
                },
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "sSearch": "Cari:",
                "sEmptyTable": "Tidak ada data yang tersedia dalam tabel",
                "sLengthMenu": "Tampilkan _MENU_ data",
                "sZeroRecords": "Tidak ada data yang cocok dengan pencarian Anda"
            }
        });
    });
    </script>
</body>

</html>