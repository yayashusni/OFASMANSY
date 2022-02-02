<?php 
session_start();
if(empty($_SESSION['email']) AND empty($_SESSION['password'])){ 
    header('location:login.php');
    }

include "koneksi.php";

// update bio
if (isset($_POST['biodata'])) {

    $nama=mysqli_real_escape_string($koneksi,$_POST['nama']);
    $alamat=mysqli_real_escape_string($koneksi,$_POST['alamat']);
    $tempat_lahir=mysqli_real_escape_string($koneksi,$_POST['tempat_lahir']);
    $tanggal_lahir=mysqli_real_escape_string($koneksi,$_POST['tanggal_lahir']);
    $jk=mysqli_real_escape_string($koneksi,$_POST['jk']);

    mysqli_query($koneksi, "UPDATE user_yayas SET nama='$nama',alamat='$alamat',tempat_lahir='$tempat_lahir',tanggal_lahir='$tanggal_lahir',jk='$jk' WHERE email='$_SESSION[email]'");

    try {
        header('location:profile.php');
    } catch (\Throwable $th) {
        echo "gagal simpan" . $th;
    }
}
//  update password 
if (isset($_POST['updatePassword'])) {
    mysqli_query($koneksi, "UPDATE user_yayas SET password='$_POST[password]' WHERE email='$_SESSION[email]'");

    try {
        header('location:index.php');
    } catch (\Throwable $th) {
        echo "gagal simpan" . $th;
    }
}

// update foto 
if (isset($_POST['updateFoto'])) {
$target_dir = "foto/";
$target_file = $target_dir . basename($_FILES["nama_file"]["name"]);
$nama_file = basename($_FILES["nama_file"]["name"]);
$ukuran_file = $_FILES["nama_file"]["size"];
$jenis_file = $_FILES["nama_file"]["type"];
$upload_berhasil = 1;
$tipe_file = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Cek Ukuran File, ukuran dalam byte 
if ($ukuran_file > 50000000) {
    echo "<script>alert('Maaf file terlalu besar')
        window.location='setting.php';
    </script>";
    $upload_berhasil = 0;
}
// Mengizinkan file dengan format tertentu 
if ($tipe_file != "jpg" && $tipe_file != "png") {
    echo "<script>alert('Maaf file tidak diizinkan')
        window.location='setting.php';
    </script>";

    $upload_berhasil = 0;
}
// Cek apakah $upload_berhasil nilainya 0 dan menampilkan pesan kesalahan 
if ($upload_berhasil == 0) {
    echo "<script>alert('Maaf file tidak bisa di upload')
        window.location='setting.php';
    </script>";

    // Jika $upload_berhasil = 1 maka coba upload file 
} else {
    if (move_uploaded_file($_FILES["nama_file"]["tmp_name"], $target_file)) {
        include "koneksi.php";
    
        $simpan = mysqli_query($koneksi, "UPDATE user_yayas SET nama_file='$nama_file',ukuran_file='$ukuran_file',jenis_file='$jenis_file' WHERE email='$_SESSION[email]'");
        if ($simpan) {
            header("location:profile.php");
        } else {
            echo "<script>alert('data tidak tersimpan')
        window.location='setting.php';
    </script>";
        }
    } else {
        echo "Maaf, Upload file gagal";
    }
}

}


$tampil = mysqli_query($koneksi, " SELECT * FROM user_yayas WHERE email='$_SESSION[email]'");
$data = mysqli_fetch_array($tampil);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard</title>
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
                                <h2 class="text-white pb-2 fw-bold">Account Setting</h2>
                                <h5 class="text-white op-7 mb-2">Office Asset Maintenance System</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row mt--2">
                        <div class="col-lg-12">
                            <div class="card full-height">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h2 class="text-secondary">Ubah Biodata</h2>
                                            <form action="" method="POST">
                                                <div class="form-group">
                                                    <label for="">Nama Lengkap</label>
                                                    <input type="text" class="form-control form-control-sm" name="nama" required value="<?=$data['nama']?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Alamat</label>
                                                    <input type="text" class="form-control form-control-sm" name="alamat" required value="<?=$data['alamat']?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Tempat Lahir</label>
                                                    <input type="text" class="form-control form-control-sm" name="tempat_lahir" required value="<?=$data['tempat_lahir']?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Tanggal Lahir</label>
                                                    <input type="date" class="form-control form-control-sm" name="tanggal_lahir" required value="<?=$data['tanggal_lahir']?>">
                                                </div>
                                                <div class="form-check">
                                                    <label>Jenis Kelamin</label><br>
                                                    <label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" name="jk" value="Laki-laki" <?=$data['jk']=='Laki-laki'?'checked':''?>>
                                                        <span class="form-radio-sign">Laki-laki</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="jk" value="Perempuan" <?=$data['jk']=='Perempuan'?'checked':''?>>
                                                        <span class="form-radio-sign">Perempuan</span>
                                                    </label>
                                                </div>
                                                <div class="card-action">
                                                    <input type="submit" name="biodata" class="btn btn-sm btn-success">
                                                    <input type="reset" class="btn btn-sm btn-danger ">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-4 text-center">
                                        <h2 class="text-secondary">Ubah Foto</h2>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                              <label for="">foto</label>
                                              <input type="file" name="nama_file" id="" class="form-control form-control-sm" placeholder="" aria-describedby="helpId">
                                            </div>
                                            <div class="card-action">
                                                    <input type="submit" name="updateFoto" class="btn btn-sm btn-success">
                                                    <input type="reset" class="btn btn-sm btn-danger ">
                                                </div>
                                        </form>
                                        </div>
                                        <div class="col-lg-4 text-center">
                                        <h2 class="text-secondary">Ubah Password</h2>
                                        <form action="" method="post">
                                            <div class="form-group">
                                              <label for="">Password</label>
                                              <input type="password" name="password" id="" class="form-control form-control-sm" placeholder="" aria-describedby="helpId">
                                            </div>
                                            <div class="card-action">
                                                    <input type="submit" name="updatePassword" class="btn btn-sm btn-success">
                                                    <input type="reset" class="btn btn-sm btn-danger ">
                                                </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
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