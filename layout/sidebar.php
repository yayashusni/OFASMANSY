  <!-- Sidebar -->
  <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <?php 
                            $tampil = mysqli_query($koneksi, " SELECT * FROM user_yayas WHERE email='$_SESSION[email]'");
                            $data = mysqli_fetch_array($tampil);
                            ?>
                            <img src="foto/<?=$data['nama_file']?>" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                        
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
									<?=$data['nama']?>
									<span class="user-level"><?=$_SESSION['level']=='1'?'Karyawan':'Administrator'?></span>
                                <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="profile.php">
                                            <span class="link-collapse">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="setting.php">
                                            <span class="link-collapse">Settings</span>
                                        </a>
                                       
                                    </li>
                                    <li>
                                        <a href="logout.php">
                                            <span class="link-collapse">Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <li class="nav-item">
                            <a href="index.php">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item ">
							<a data-toggle="collapse" href="#pemeliharaan" class="collapsed" aria-expanded="false">
								<i class="fas fa-toolbox"></i>
								<p>Maintenance</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="pemeliharaan" >
								<ul class="nav nav-collapse">
									<li>
										<a href="maintenance_input.php">
											<span class="sub-item">Tambah</span>
										</a>
									</li>
									<li>
										<a href="maintenance.php">
											<span class="sub-item">Data pemeliharaan</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
                        <li class="nav-item ">
							<a data-toggle="collapse" href="#karyawan" class="collapsed" aria-expanded="false">
								<i class="fas fa-users"></i>
								<p>Karyawan</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="karyawan" >
								<ul class="nav nav-collapse">
                                    <?php if($_SESSION['level']=='0'){?>
									<li>
										<a href="karyawan_input.php">
											<span class="sub-item">Tambah</span>
										</a>
									</li>
                                    <?php } ?>
									<li>
										<a href="karyawan.php">
											<span class="sub-item">Data karyawan</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->
