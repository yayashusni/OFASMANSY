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
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no'  name='viewport' />

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
                                <h2 class="text-white pb-2 fw-bold">Add data maintenance</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row mt--2">
                        <div class="col-lg-12">
                            <div class="card full-height">
                                <div class="card-body">
                                    <form action="upload.php"  method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                            <label for="">Kode Karyawan</label>
                                            <input type="text" class="form-control"  name="kode_karyawan" readonly required value="<?=$_SESSION['kode_karyawan']?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Barang</label>
                                            <input type="text" class="form-control"  name="nama_barang" required > 
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kerusakan</label>
                                            <input type="text" class="form-control"  name="jenis_kerusakan" required > 
                                        </div>
                                        <div class="form-group">
                                            <label for="">Spot Area</label>
                                            <input type="text" class="form-control"  name="spot_area" required > 
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="">Foto</label>
                                            <input type="file" class="form-control"  name="nama_file" required > 
                                        </div>
                                        
                                        
                                        <div class="card-action">
                                            <input type="submit" class="btn btn-success btn-sm">
                                            <input type="reset" class="btn btn-danger btn-sm ">
                                        </div>
                                    </form>
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