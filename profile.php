<?php 
session_start();
if(empty($_SESSION['email']) AND empty($_SESSION['password'])){ 
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
    <title>Profile</title>
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
</head>

<body>
    <div class="wrapper">
        <?php include "layout/header.php"; ?>
        <?php include "layout/sidebar.php"; ?>

        <div class="main-panel">
            <div class="content">
                <div class="row"  >
            	<div class="col-lg-10" style="margin: 0 auto;">
							<div class="card card-profile bg-dark2 text-white mt-2">
								<div class="card-header text-center">
                                    <h1 class="text-purple" style="vertical-align: middle;">Profile</h1 class="text-purple">
									<div class="profile-picture">
										<div class="avatar avatar-xl">
											<img src="foto/<?=$data['nama_file']?>" alt="..." class="avatar-img rounded-circle">
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="user-profile text-center">
										<div class="job"><?=$data['kode_karyawan']?></div>
										<div class="name"><?=$data['nama']?></div>
										<div class="desc">Alamat : <?=$data['alamat']?></div>
										<div class="desc">Tempat Lahir : <?=$data['tempat_lahir']?></div>
										<div class="desc">Tanggal Lahir : <?=$data['tanggal_lahir']?></div>
										<div class="desc">Jenis Kelamin : <?=$data['jk']?></div>										
									</div>
								</div>
								<div class="card-footer"></div>
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