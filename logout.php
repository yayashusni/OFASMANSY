<?php 
session_start();
session_destroy();
echo "<script>alert('anda telah keluar');
     window.location='login.php'</script>";