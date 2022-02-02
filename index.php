<?php
session_start();
if (empty($_SESSION['email']) and empty($_SESSION['password'])) {
    header('location:login.php');
}
include "koneksi.php";
include "data.php";
$tampil = mysqli_query($koneksi, " SELECT * FROM user_yayas WHERE email='$_SESSION[email]'");
$data = mysqli_fetch_array($tampil);

// karyawan
$queryKaryawan = mysqli_query($koneksi, " SELECT COUNT(*) AS karyawan FROM user_yayas WHERE level='1' ");
$dataKaryawan = mysqli_fetch_array($queryKaryawan);

// maintenance data 
$queryMaintenance = mysqli_query($koneksi, " SELECT COUNT(*) AS maintenance FROM maintenance_yayas ");
$dataMaintenance = mysqli_fetch_array($queryMaintenance);


// repairing data 
$repairing = mysqli_query($koneksi, " SELECT COUNT(*) AS repair FROM maintenance_yayas WHERE status_perbaikan!='selesai' ");
$repair = mysqli_fetch_array($repairing);

// repairing data finish
$finishData = mysqli_query($koneksi, " SELECT COUNT(*) AS finished_maintenance FROM maintenance_yayas WHERE status_perbaikan='selesai' ");
$finishedMaintaining = mysqli_fetch_array($finishData);
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
                                <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                                <h5 class="text-white op-7 mb-2">Office Asset Maintenance System</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="icon-people text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Karyawan</p>
                                                <h4 class="card-title"><?= $dataKaryawan['karyawan'] ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="flaticon-technology-1 text-info"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Total Maintenance </p>
                                                <h4 class="card-title"><?= $dataMaintenance['maintenance'] ?> </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="icon-wrench text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Be Maintained</p>
                                                <h4 class="card-title"><?= $repair['repair'] ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="flaticon-interface-1 text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Finished Maintaining</p>
                                                <h4 class="card-title"><?= $finishedMaintaining['finished_maintenance'] ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

             
                    <div class="col">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Statistik Banyak Pemeliharaan Asset Kantor Perbulan</div>
								</div>
								<div class="card-body">
									<div class="chart-container"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
										<canvas id="LineChart" width="325" height="300" style="display: block; width: 325px; height: 300px;" class="chartjs-render-monitor"></canvas>
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