<?php
session_start();
// Limited before login
if (!isset($_SESSION['login'])) {
  echo "<script>
                alert('Silahkan Login dulu');
                document.location.href = 'login.php';
              </script>";
  exit;
}

// Limited before login
if ($_SESSION['level'] != 1 and $_SESSION['level'] != 2) {
  echo "<script>
                alert('Perhatian Anda tidak punya hak akses menghapus data!');
                document.location.href = 'akun.php';
              </script>";
  exit;
};

$title = 'Data Mahasiswa';
include 'layout/header.php';

$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY nim DESC");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="mx-2">Data Mahasiswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active mx-2">Data Mahasiswa</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Tabel Data Mahasiswa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <a href="tambah.php" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>Tambah</a>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>NO HP</th>
                        <th>Tanggal Lahir</th>
                        <th width="16%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      <?php foreach ($data_mahasiswa as $data_mhs) : ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $data_mhs['nim'] ?></td>
                          <td><?= $data_mhs['nama'] ?></td>
                          <td><?= $data_mhs['alamat'] ?></td>
                          <td><?= $data_mhs['no_hp'] ?></td>
                          <td><?= $data_mhs['tgl_lahir'] ?></td>
                          <td class="text-center">
                            <a href="edit.php?id=<?php echo $data_mhs['nim']; ?>" class="btn btn-success"><i class="fa-regular fa-pen-to-square"></i></a>

                            <a href="delete.php?id=<?php echo $data_mhs['nim']; ?>" onclick="return confirm('Yakin Ingin Menghapus data?');" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </section>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<?php
include 'layout/footer.php';
?>