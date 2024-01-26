<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
</head>

<?php
// Jika form disubmit
if (isset($_POST['kirim'])) {
    // Ambil data dari form
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $notelp = $_POST['notelp'];
    $email = $_POST['email'];
    $metode_pengambilan = $_POST['metode_pengambilan'];
    $tanggal_pengambilan = $_POST['tanggal_pengambilan'];

    // Handle upload file
    $nama_file = $_FILES['nama_file']['name'];
    $file_tmp = $_FILES['nama_file']['tmp_name'];
    $file_type = $_FILES['nama_file']['type'];

    // Tentukan lokasi penyimpanan file
    $upload_dir = '../dokumen/'; // Ubah sesuai dengan direktori penyimpanan Anda

    // Buat nama file unik untuk menghindari duplikasi
    $unique_file_name = uniqid() . '_' . $nama_file;

    // Pindahkan file ke direktori penyimpanan
    move_uploaded_file($file_tmp, $upload_dir . $unique_file_name);

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO dokumen (id_user, nama_lengkap, alamat, notelp, email, metode_pengambilan, nama_file, tanggal_pengambilan) VALUES ('$id_user', '$nama_lengkap', '$alamat', '$notelp', '$email', '$metode_pengambilan', '$unique_file_name', '$tanggal_pengambilan')";

    if (mysqli_query($conn, $query)) {
        $script = "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Dokumen berhasil dikirim!',
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
                        title: 'Dokumen Gagal Ditambahkan!',
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
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Tempat</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataX" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Info</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>OSLEN Photocopy & Printing</td>
                                            <td>
                                                Jl. Pendidikan No. 27, Kel. Klabulu, Malaimsimsa, Kota Sorong
                                            </td>
                                            <td>
                                                <button class="btn btn-info" data-toggle="modal" data-target="#hargaModal">Informasi Harga</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#dokumenModal">Kirim Dokumen</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.container-fluid -->
                <!-- Modal Informasi Harga -->
                <div class="modal fade" id="hargaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Informasi Harga</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <h5>Jasa yang disediakan:</h5>
                                <ol>
                                    <li>Photocopy: Rp. 400 / lembar</li>
                                    <li>Print:
                                        <ul>
                                            <li>biasa: Rp. 2.000 / lembar</li>
                                            <li>color: Rp. 3.000 / lembar</li>
                                            <li>full color: Rp. 6.000 / lembar</li>
                                        </ul>
                                    </li>
                                    <li>Jilid:
                                        <ul>
                                            <li>soft cover: Rp. 40.000</li>
                                            <li>spiral:
                                                <ul>
                                                    <li>plastik: Rp. 5.000</li>
                                                    <li>besi: Rp. 5.000</li>
                                                </ul>
                                            </li>
                                            <li>hard cover: Rp. 85.000</li>
                                        </ul>
                                    </li>
                                    <li>Laminating:
                                        <ul>
                                            <li>kartu: Rp. 3.000 / lembar</li>
                                            <li>dokumen A4: Rp. 6.000 / lembar</li>
                                            <li>dokumen F4: Rp. 7.000 / lembar</li>
                                        </ul>
                                    </li>
                                    <li>Scanning:
                                        <ul>
                                            <li>dokumen A4: Rp. 6.000 / lembar</li>
                                            <li>dokumen F4: Rp. 7.000 / lembar</li>
                                        </ul>
                                    </li>
                                    <li>Cetak Foto:
                                        <ul>
                                            <li>2x3: Rp. 3.000 / lembar</li>
                                            <li>3x4: Rp. 4.000 / lembar</li>
                                            <li>4x6: Rp. 5.000 / lembar</li>
                                            <li>4R: Rp. 5.000 / lembar</li>
                                        </ul>
                                    </li>
                                </ol>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Dokumen -->
                <div class="modal fade" id="dokumenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Kirim Dokumen</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" class="form-control">
                                    <label>No Telp</label>
                                    <input type="number" name="notelp" class="form-control">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                    <label>Metode Pengambilan</label>
                                    <select name="metode_pengambilan" class="form-control">
                                        <option value="Diantar">Diantar</option>
                                        <option value="Ambil Sendiri">Ambil Sendiri</option>
                                    </select>
                                    <label>Tambahkan File</label>
                                    <input type="file" name="nama_file" class="form-control">
                                    <label>Tanggal Pengambilan</label>
                                    <input type="date" name="tanggal_pengambilan" class="form-control"> <br>
                                    <button type="submit" name="kirim" class="btn btn-success w-100">Kirim</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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