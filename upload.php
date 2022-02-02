<?php
$target_dir = "file/";
$target_file = $target_dir . basename($_FILES["nama_file"]["name"]);
$nama_file = basename($_FILES["nama_file"]["name"]);
$ukuran_file = $_FILES["nama_file"]["size"];
$jenis_file = $_FILES["nama_file"]["type"];
$upload_berhasil = 1;
$tipe_file = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Cek Ukuran File, ukuran dalam byte 
if ($ukuran_file > 50000000) {
    echo "Maaf, Ukuran file terlalu besar.";
    $upload_berhasil = 0;
}
// Mengizinkan file dengan format tertentu 
if ($tipe_file != "jpg" && $tipe_file != "png") {
    echo "Maaf file tidak diizinkan";
    $upload_berhasil = 0;
}
// Cek apakah $upload_berhasil nilainya 0 dan menampilkan pesan kesalahan 
if ($upload_berhasil == 0) {
    echo "Maaf file tidak bisa diupload";
    // Jika $upload_berhasil = 1 maka coba upload file 
} else {
    if (move_uploaded_file($_FILES["nama_file"]["tmp_name"], $target_file)) {
        include "koneksi.php";
    
        $simpan = mysqli_query($koneksi, "INSERT INTO maintenance_yayas(nama_barang,jenis_kerusakan,spot_area,kode_karyawan,status_perbaikan,nama_file,tanggal_upload) VALUES('$_POST[nama_barang]','$_POST[jenis_kerusakan]','$_POST[spot_area]','$_POST[kode_karyawan]','pending','$nama_file',curdate())");
        if ($simpan) {
            header("location:maintenance.php");
        } else {
            echo "data tidak tersimpan";
        }
    } else {
        echo "Maaf, Upload file gagal";
    }
}
