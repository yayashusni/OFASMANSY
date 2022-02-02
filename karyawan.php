
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
    <title>Karyawan</title>
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
                                <h2 class="text-white pb-2 fw-bold">Karyawan</h2>
                                <h5 class="text-white op-7 mb-2">Office Asset Maintenance System</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
								<a href="karyawan_input.php" class="btn btn-white btn-border btn-round btn-sm" >Tambah Karyawan</a>
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
                                                <a href="karyawan.php" class="btn btn-sm mt-2" style="background-color: #6861ce;color:aliceblue"><i class="fas fa-redo"></i> Refresh</a>
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
                                                    <th>Kode Karyawan</th>
                                                    <th >Nama&nbsp;&nbsp;Lengkap</th>
                                                    <th>Alamat</th>
                                                    <th>Tempat Lahir</th>
                                                    <th>Tanggal&nbsp;&nbsp;Lahir</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Level</th>
                                                    <th>E-mail</th>
                                                    <th>Foto</th>
                                                    <th>Ukuran</th>
                                                    <th>Jenis</th>
                                                    <?php if($_SESSION['level']=='0'){?>
                                                    <th colspan="2"  class="text-center">Action</th>
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
                                                $sql = mysqli_query($koneksi, "SELECT * FROM user_yayas");
                                                $jumlah_data = mysqli_num_rows($sql);
                                                $total_halaman = ceil($jumlah_data / $batas);
                                                $nomor = -1 + $halaman_awal + 1;

                                                // query view 
                                                if (isset($_GET['submit'])) {
                                                    $tampil = mysqli_query($koneksi, "SELECT * from user_yayas WHERE 
                                                    nama like '%".$_GET['cari']."%' OR alamat like '%".$_GET['cari']."%' OR tempat_lahir like '%".$_GET['cari']."%' OR jk like '%".$_GET['cari']."%'");
                                                } else {
                                                    $tampil = mysqli_query($koneksi, "SELECT * from user_yayas order by kode_karyawan asc limit $halaman_awal, $batas ");
                                                }
                                                while ($data = mysqli_fetch_array($tampil)) {
                                                    $nomor++; ?>

                                                    <tr>
                                                        <td><?= $nomor ?></td>
                                                        <td><?= $data['kode_karyawan'] ?></td>
                                                        <td ><?= $data['nama'] ?></td>
                                                        <td><?= $data['alamat'] ?></td>
                                                        <td><?= $data['tempat_lahir'] ?></td>
                                                        <td><?= $data['tanggal_lahir'] ?></td>
                                                        <td><?= $data['jk'] ?></td>
                                                        <td><?= $data['level']=='1'?'Karyawan':'Admin' ?></td>
                                                        <td><?= $data['email'] ?></td>
                                                        <td><a href="foto/<?= $data['nama_file'] ?>" class="download"><?= $data['nama_file'] ?></a> </td>
                                                        <td><?= $data['ukuran_file'] ?></td>
                                                        <td><?= $data['jenis_file'] ?></td>
                                                        <?php if($_SESSION['level']=='0'){?>
                                                        <td class="text-center" width="500px">
                                                            <a href="karyawan_hapus.php?id=<?= $data['id'] ?>" class="btn btn-xs btn-danger m-1">hapus</a>
                                                            <a href="karyawan_edit.php?id=<?= $data['id'] ?>" class="btn btn-xs btn-info m-1">edit</a>
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
                                    <a href="karyawan_laporan1.php" class="btn btn-sm btn-secondary btn-block">Cetak</a>
                                </div>
                                <div class="modal-footer"></div>
                                <div class="modal-body">
                                    <label for="">Laporan Per jenis kelamin</label>
                                    <form class="form-inline" action="karyawan_laporan2.php" method="post">
                                        <div class="form-group">
                                          <label for="">Jenis kelamin</label>&nbsp;&nbsp;
                                          <select class="form-control form-control-sm" name="jk" id="">
                                            <option  value="Laki-laki">Laki-laki</option>
                                            <option  value="Perempuan">Perempuan</option>
                                          </select>
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