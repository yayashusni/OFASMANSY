<?php
include "koneksi.php";
session_start();
if (!empty($_SESSION['email']) and !empty($_SESSION['password'])) {
    header('location:index.php');
} else {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $tampil = mysqli_query($koneksi, " SELECT * FROM user_yayas WHERE email='$email' AND password='$password'");
        $data = mysqli_fetch_array($tampil);

        if (empty($data['email'])) {
            echo "<script>alert('gagal login');
                    window.location='login.php';
                 </script>";
        } else {
            $_SESSION['email'] = $data['email'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['jk'] = $data['jk'];
            $_SESSION['level'] = $data['level'];
            $_SESSION['tanggal_lahir'] = $data['tanggal_lahir'];
            $_SESSION['tempat_lahir'] = $data['tempat_lahir'];
            $_SESSION['alamat'] = $data['alamat'];
            $_SESSION['kode_karyawan'] = $data['kode_karyawan'];
            $_SESSION['nama_file'] = $data['nama_file'];
            echo "<script>alert('Berhasil Login');
            window.location='index.php';</script>";
        }
    }

?>
    <html>

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Login</title>
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

    <body class="bg-dark2 curves-shadow ">


        <div class="card card-default col-md-4 mt-5" style="margin: 0 auto;">
            <div class="card-body bg-gradient">
                <h1>OFASMASNSY</h1>
                <hr>
                <form class="form" method="post">
                    
                    <div class="form-group form-floating-label">
                        <input id="inputFloatingLabel" type="text" name="email" class="form-control input-border-bottom form-control-sm text-white" required="">
                        <h4 class="placeholder text-white">Username</h4>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="inputFloatingLabel" type="password" name="password" class="form-control input-border-bottom form-control-sm text-white" required="">
                        <h4 class="placeholder text-white">Password</h4>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login" class="btn btn-light btn-block btn-border">Login</button>
                    </div>

                </form>
            </div>
        </div>

    </body>

    </html>
<?php } ?>