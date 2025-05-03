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
$title = 'Edit Data';
include 'layout/header.php';

//Catch id from url
$id = (int)$_GET['id'];

$db_mhs = select("SELECT * FROM mahasiswa WHERE nim = '$id'")[0];


// Button tap check
if(isset($_POST['edit'])) {
    if(update_datamhs($_POST) > 0 ){
        echo "<script>
                alert('Data mahasiswa berhasil di edit');
                document.location.href = 'index.php';
             </script>";
    } else {
        echo "<script>
                alert('Data mahasiswa gagal di edit');
                document.location.href = 'index.php';
             </script>";
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><i class="fas fa-edit"></i>Ubah Data Mahasiswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Data Mahasiswa</a></li>
            <li class="breadcrumb-item active">Ubah Barang</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form action="" method="post">
        <div class="mb-3">
          <input type="hidden" class="form-control" id="nim" name="nim" value="<?= $db_mhs['nim']; ?>" placeholder="Masukkan NIM anda..." required>
        </div>

        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?= $db_mhs['nama']; ?>" placeholder="Masukkan nama anda..." required>
        </div>

        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $db_mhs['alamat']; ?>" placeholder="Masukkan alamat anda..." required>
        </div>

        <div class="mb-3">
          <label for="no_hp" class="form-label">No HP</label>
          <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $db_mhs['no_hp']; ?>" placeholder="Masukkan No HP anda..." required>
        </div>

        <div class="mb-3">
          <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
          <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $db_mhs['tgl_lahir']; ?>" required>
        </div>

        <button type="submit" name="edit" class="btn btn-primary"><i class='bx bx-edit'></i><span class="mx-1">Edit</span></button>
        <a href="index.php" class="btn btn-success"><i class='bx bx-x'></i><span class="mx-1">Batal</span></a>
      </form>
    </div>
  </section>
  <!-- /.content -->
</div>

<?php
include 'layout/footer.php';
?>