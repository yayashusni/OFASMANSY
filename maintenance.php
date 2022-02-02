<?php
session_start();
if (empty($_SESSION['email']) and empty($_SESSION['password'])) {
    header('location:login.php');
}
include "koneksi.php";
$tampil = mysqli_query($koneksi, " SELECT * FROM user_yayas WHERE email='$_SESSION[email]'");
$data = mysqli_fetch_array($tampil);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Maintenance</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- custom css  -->
    <link rel="stylesheet" href="custom.css">
</head>

<body>
    <div class="wrapper">
        <?php include "layout/header.php"; ?>
        <?php include "layout/sidebar.php"; ?>

        <div class="main-panel">
            <div class="content">
                <div class="panel-header" style="background-color: #6861ce;">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">Maintenance</h2>
                                <h5 class="text-white op-7 mb-2">Office Asset Maintenance System</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
								<a href="maintenance_input.php" class="btn btn-white btn-border btn-round btn-sm" >Add Maintenance</a>
							</div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row mt--2">
                        <div class="col-lg-12">
                            <div class="card full-height">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <form action="" method="GET">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" name="cari" placeholder="key word" class="form-control form-control-sm" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                            <div class="input-group-prepend">
                                                                <input class="btn btn-sm" name="submit" style="background-color: #6861ce;color:aliceblue" type="submit" value="search">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
                                                <a href="maintenance.php" class="btn btn-sm mt-2" style="background-color: #6861ce;color:aliceblue"><i class="fas fa-redo"></i> Refresh</a>
                                                <button type="button" name="filter" class=" mt-2 btn btn-sm" style="background-color: #6861ce;color:aliceblue" data-toggle="modal" data-target="#filter">
                                                    <i class="fas fa-sort"></i> Filter
                                                </button>
                                                <?php if($_SESSION['level']=='0'){?>
                                                <button class="btn  btn-sm mt-2" data-toggle="modal" data-target="#laporan" style="background-color: #6861ce;color:aliceblue"><i class="fas fa-print"></i> Report</button>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered " style="border-top: 1px solid #dee2e6;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama&nbsp;&nbsp;Barang</th>
                                                    <th>Jenis&nbsp;&nbsp;Kerusakan</th>
                                                    <th>Spot&nbsp;&nbsp;Area&nbsp;&nbsp;/&nbsp;&nbsp;Tempat</th>
                                                    <th>Kode Karyawan</th>
                                                    <th>Foto</th>
                                                    <th>Status&nbsp;selesai</Selesai>
                                                    <?php if($_SESSION['level']=='0'){?>
                                                    <th colspan="2" class="text-center">Action</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include "koneksi.php";


                                                // pagination 

                                                $batas = 5;
                                                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
                                                $sebelumnya = $halaman - 1;
                                                $selanjutnya = $halaman + 1;
                                                $sql = mysqli_query($koneksi, "SELECT * FROM maintenance_yayas");
                                                $jumlah_data = mysqli_num_rows($sql);
                                                $total_halaman = ceil($jumlah_data / $batas);
                                                $nomor = -1 + $halaman_awal + 1;

                                                // query view 
                                                if (isset($_GET['submit'])) {
                                                    $tampil = mysqli_query($koneksi, "SELECT * from maintenance_yayas WHERE 
                                                    nama_barang like '%" . $_GET['cari'] . "%' OR 
                                                    jenis_kerusakan like '%" . $_GET['cari'] . "%' OR 
                                                    spot_area like '%" . $_GET['cari'] . "%' OR
                                                    kode_karyawan like '%" . $_GET['cari'] . "%' ");
                                                } else if (isset($_GET['filter'])) {
                                                    $tampil = mysqli_query($koneksi, "SELECT * from maintenance_yayas WHERE status_perbaikan ='$_GET[status_perbaikan]'  ");
                                                } else {
                                                    $tampil = mysqli_query($koneksi, "SELECT * from maintenance_yayas order by id desc limit $halaman_awal, $batas  ");
                                                }
                                                while ($data = mysqli_fetch_array($tampil)) {
                                                    $nomor++; ?>

                                                    <tr>
                                                        <td><?= $nomor ?></td>
                                                        <td><?= $data['nama_barang'] ?></td>
                                                        <td><?= $data['jenis_kerusakan'] ?></td>
                                                        <td><?= $data['spot_area'] ?></td>
                                                        <td><?= $data['kode_karyawan'] ?></td>
                                                        <td><a href="file/<?= $data['nama_file'] ?>"><?= $data['nama_file'] ?></a></td>
                                                        <td>

                                                            <?php
                                                            if ($data['status_perbaikan'] == 'selesai') {
                                                                echo $data['status_perbaikan'] . ' <i class="fas fa-check text-success"></i>';
                                                            } else if ($data['status_perbaikan'] == 'pending') {
                                                                echo $data['status_perbaikan'] . ' <i class="fas fa-spinner text-warning"></i>';
                                                            } else {
                                                                echo $data['status_perbaikan'] . ' <i class="fas fa-wrench text-secondary"></i>';
                                                            }

                                                            ?>
                                                        </td>
                                                        <?php if($_SESSION['level']=='0'){?>
                                                        <td class="text-center" width="200px">
                                                            <a href="maintenance_hapus.php?id=<?= $data['id'] ?>" class="btn btn-xs btn-danger m-1">hapus</a>
                                                            <a href="maintenance_edit.php?id=<?= $data['id'] ?>" class="btn btn-xs btn-info m-1">edit</a>
                                                        </td>
                                                        <?php }?>      
                                                    </tr>
                                                <?php  } ?>
                                            </tbody>
                                        </table>

                                        <!-- paginatin  -->
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-end">
                                                <li class="page-item  <?= $halaman == 1 ? 'disabled' : '' ?> ">
                                                    <a class="page-link" <?php if ($halaman > 1) {
                                                                                echo "href='?halaman=$sebelumnya'";
                                                                            } ?>>Previous</a>
                                                </li>
                                                <?php for ($i = 1; $i < $total_halaman; $i++) {  ?>
                                                    <li class="page-item "><a class="page-link <?= $halaman == $i ? 'bg-secondary text-white' : '' ?>" href="?halaman=<?php echo $i ?>"><?php echo $i; ?></a></li>
                                                <?php } ?>
                                                <li class="page-item  <?= $halaman == 'last' ? 'active' : '' ?> ">
                                                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                                echo "href='?halaman=$selanjutnya'";
                                                                            } ?>>Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal filter  -->
                    <div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Filter Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="GET">
                                        <div class="form-group">
                                            <label for="">Status perbaikan</label>
                                            <select class="form-control" name="status_perbaikan" id="">
                                                <option value="pending">Pending</option>
                                                <option value="perbaikan">Perbaikan</option>
                                                <option value="selesai">Selesai</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="filter" class="btn btn-sm" style="background-color: #6861ce;color:aliceblue">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal report  -->
                    <div class="modal fade" id="laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Laporan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label for="">Laporan Keseluruhan</label>
                                    <a href="maintenance_laporan1.php" class="btn btn-sm btn-secondary btn-block">Cetak</a>
                                </div>
                                <div class="modal-footer"></div>
                                <div class="modal-body">
                                    <label for="">Laporan Per Tanggal</label>
                                    <form class="form-inline" action="maintenance_laporan2.php" method="post">
                                        <div class="form-group">
                                            <div for="">Tanggal awal</div> &nbsp;&nbsp;
                                            <input type="date" name="tgl_awal" id="" class="form-control form-control-sm" placeholder="" aria-describedby="helpId">
                                        </div>
                                        <div class="form-group">
                                            <div for="">Tanggal akhir</div>&nbsp;&nbsp;
                                            <input type="date" name="tgl_akhir" id="" class="form-control form-control-sm" placeholder="" aria-describedby="helpId">
                                        </div>
                                            <button type="submit" class="btn btn-block btn-sm btn-secondary">Cetak</button>
                                    </form>
                                </div>
                                <div class="modal-footer"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php include "layout/footer.php"; ?>
        </div>
    </div>
    <?php include "layout/file_js.php"; ?>


</body>

</html>