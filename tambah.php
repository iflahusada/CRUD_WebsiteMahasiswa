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

$title = 'Tambah Data';
include 'layout/header.php';


// Button tap check
if(isset($_POST['tambah'])) {
    if(create_datamhs($_POST) > 0 ){
        echo "<script>
                alert('Data mahasiswa berhasil ditambahkan');
                document.location.href = 'index.php';
             </script>";
    } else {
        echo "<script>
                alert('Data mahasiswa gagal ditambahkan');
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
          <h1 class="m-0"><i class="fas fa-plus"></i>Tambah Data Mahasiswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Data Mahasiswa</a></li>
            <li class="breadcrumb-item active">Tambah Barang</li>
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
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM anda..."
            required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama anda..."
            required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat anda..."
            required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No HP anda..."
            required>
        </div>

        <div class="mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
            required>
        </div>

        <button type="submit" name="tambah" class="btn btn-primary"><i class='bx bx-plus-circle'></i><span class="mx-1">Tambah</span></button>
        <a href="index.php" class="btn btn-success"><i class='bx bx-x' ></i><span class="mx-1">Batal</span></a>
    </form>
    </div>
  </section>
  <!-- /.content -->
</div>




<?php include 'layout/footer.php'; ?>