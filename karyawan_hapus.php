<?php
include "koneksi.php";

$query = mysqli_query($koneksi, "DELETE FROM user_yayas WHERE id='$_GET[id]'");
try {
    header('location:karyawan.php');
} catch (\Throwable $th) {
    echo "Gagal hapus" . $th;
}
