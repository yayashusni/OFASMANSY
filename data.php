<?php
include "koneksi.php";
$tanggal="";
$jumlah=null;
$get_MONTH=mysqli_query($koneksi,"SELECT MONTH(tanggal_upload), COUNT(*) AS total from maintenance_yayas GROUP BY MONTH(tanggal_upload) ORDER BY MONTH(tanggal_upload) asc ");

while ($data=mysqli_fetch_array($get_MONTH)) {
    $tgl=$data['MONTH(tanggal_upload)'];
    $tanggal.="'$tgl'".",";

    $jml=$data['total'];
    $jumlah.="'$jml'".",";
    
}

?>
