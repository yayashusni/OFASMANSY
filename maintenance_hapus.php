<?php
include "koneksi.php";

$query = mysqli_query($koneksi, "DELETE FROM maintenance_yayas WHERE id='$_GET[id]'");
try {
    header('location:maintenance.php');
} catch (\Throwable $th) {
    echo "Gagal hapus" . $th;
}

$tampil = mysqli_query($koneksi, "SELECT * from maintenance_yayas WHERE 
nama_barang like '%" . $_GET['cari'] . "%' OR 
jenis_kerusakan like '%" . $_GET['cari'] . "%' OR 
spot_area like '%" . $_GET['cari'] . "%' OR
kode_karyawan like '%" . $_GET['cari'] . "%' ");
