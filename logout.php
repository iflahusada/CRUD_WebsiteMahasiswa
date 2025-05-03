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

// Clear user
$_SESSION = [];

session_unset();
session_destroy();
header("Location: login.php");

?>