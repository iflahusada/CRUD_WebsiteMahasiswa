<?php 
session_start();
// Limited before login
if(!isset($_SESSION['login'])) {
    echo "<script>
            alert('Silahkan Login dulu');
            document.location.href = 'login.php';
          </script>";
    exit;
}

include 'config/app.php';


//receive id data
$id = (int)$_GET['id'];


if(delete($id) > 0){
    echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = 'index.php';
         </script>";
} 
else
{
    echo "<script>
            alert('Data gagal dihapus');
            document.location.href = 'index.php';
         </script>";
} 