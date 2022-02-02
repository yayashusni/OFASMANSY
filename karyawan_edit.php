<?php
include "koneksi.php";

// session 
session_start();
if (empty($_SESSION['email']) and empty($_SESSION['password'])) {
    header('location:login.php');
}

$tampil = mysqli_query($koneksi, " SELECT * FROM user_yayas WHERE email='$_SESSION[email]'");
$data = mysqli_fetch_array($tampil);


// update data
if (isset($_POST['submit'])) {

    mysqli_query($koneksi, "UPDATE user_yayas SET nama='$_POST[nama]',alamat='$_POST[alamat]',tempat_lahir='$_POST[tempat_lahir]',tanggal_lahir='$_POST[tanggal_lahir]',jk='$_POST[jk]',kode_karyawan='$_POST[kode_karyawan]',email='$_POST[email]' WHERE id='$_GET[id]'");

    try {
        header('location:karyawan.php');
    } catch (\Throwable $th) {
        echo "gagal simpan" . $th;
    }
}

// tampil data 
$query=mysqli_query($koneksi,"SELECT * FROM user_yayas WHERE id='$_GET[id]'");
$result=mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Karyawan</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

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
                                <h2 class="text-white pb-2 fw-bold">Edit result karyawan</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row mt--2">
                        <div class="col-lg-12">
                            <div class="card full-height">
                                <div class="card-body">
                                    <form action="" method="POST">
                                        
                                        <div class="form-group">
                                            <label for="">Kode Karyawan</label>
                                            <input type="text" class="form-control" name="kode_karyawan" readonly value="<?= $result['kode_karyawan']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama" required value="<?=$result['nama']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <input type="text" class="form-control" name="alamat" required value="<?=$result['alamat']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir" required value="<?=$result['tempat_lahir']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tanggal_lahir" required value="<?=$result['tanggal_lahir']?>">
                                        </div>
                                        <div class="form-check" required>
                                            <label>Jenis Kelamin</label><br>
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="jk" value="Laki-laki" <?= $result['jk']=='Laki-laki'?'checked':''?> >
                                                <span class="form-radio-sign">Laki-laki</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="jk" value="Perempuan" <?= $result['jk']=='Perempuan'?'checked':''?>>
                                                <span class="form-radio-sign">Perempuan</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="">E-mail</label>
                                            <input type="email" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId" value="<?=$result['email']?>">
                                        </div>
                                        <div class="card-action">
                                            <input type="submit" name="submit" value="update" class="btn btn-sm btn-success">
                                            <input type="reset" class="btn btn-danger btn-sm">
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