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

$title = 'Akun';
include 'layout/header.php';

// display all data
$data_akun = select("SELECT * FROM akun");

// display data 
$id_akun = $_SESSION['id_akun'];
$data_bylogin = select("SELECT * FROM akun WHERE id_akun = $id_akun");

//If tap button "Tambah" run this script
if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
                alert('Data akun berhasil ditambahkan');
                document.location.href = 'akun.php';
                </script>";
    } else {
        echo "<script>
                    alert('Data akun gagal ditambahkan');
                    document.location.href = 'akun.php';
                </script>";
    }
}

//If tap button "ubah" run this script
if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "<script>
                alert('Data akun berhasil diubah');
                document.location.href = 'akun.php';
                </script>";
    } else {
        echo "<script>
                    alert('Data akun gagal diubah');
                    document.location.href = 'akun.php';
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
                    <h1 class="mx-2">Data Akun</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active mx-2">Data Akun</li>
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
                                    <h3 class="card-title">Tabel Data Akun</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <?php if ($_SESSION['level'] == 1) : ?>
                                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class='fas fa-plus'></i><span class="mx-1">Tambah</span></button>
                                    <?php endif; ?>
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th width="16%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <!-- Display all data -->
                                            <?php if ($_SESSION['level'] == 1) : ?>
                                                <?php foreach ($data_akun as $akun) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $akun['nama']; ?></td>
                                                        <td><?= $akun['username']; ?></td>
                                                        <td><?= $akun['email']; ?></td>
                                                        <td>Password Ter-enkripsi</td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>"><i class='fas fa-edit'></i></button>

                                                            <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $akun['id_akun']; ?>"><i class='fas fa-trash'></i></button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <?php foreach ($data_bylogin as $akun) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $akun['nama']; ?></td>
                                                        <td><?= $akun['username']; ?></td>
                                                        <td><?= $akun['email']; ?></td>
                                                        <td>Password Ter-enkripsi</td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>"><i class='fas fa-edit'></i></button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Modal Tambah -->
                                <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="exampleModalLabel"><i class='bx bxs-user-plus'></i><span class="mx-1">Tambah Akun</span></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post">
                                                    <div class="mb-3">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" name="nama" id="nama" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="username">Username</label>
                                                        <input type="text" name="username" id="username" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" id="email" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="password">Password</label>
                                                        <input type="password" id="floatingPassword" name="password" class="form-control" placeholder="Password" required>
                                                        <i id="togglePassword" class="far fa-eye" style="position:absolute; right: 30px; top: 315px; padding: 1px; cursor: pointer;"></i>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="level">Level</label>
                                                        <select name="level" id="level" class="form-control" required>
                                                            <option value="">-- pilih role --</option>
                                                            <option value="1">Admin</option>
                                                            <option value="2">Operator Mahasiswa</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal Ubah -->
                                <?php foreach ($data_akun as $akun) : ?>
                                    <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel"><i class='bx bxs-edit'></i><span class="mx-1">Ubah Akun</span></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
                                                        <div class="mb-3">
                                                            <label for="nama">Nama</label>
                                                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $akun['nama']; ?>" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="username">Username</label>
                                                            <input type="text" name="username" id="username" class="form-control" value="<?= $akun['username']; ?>" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email" id="email" class="form-control" value="<?= $akun['email']; ?>" required>
                                                        </div>

                                                        <?php if ($_SESSION['level'] == 1) : ?>
                                                            <div class="mb-3">
                                                                <label for="password">Password <small>(Masukkan password baru/lama)</small></label>
                                                                <input type="password" id="HidePw" name="password" class="form-control" placeholder="Password" required>
                                                                <i id="hidePW" class="far fa-eye" style="position:absolute; right: 30px; top: 315px; padding: 1px; cursor: pointer;"></i>
                                                            </div>
                                                        <?php else : ?>
                                                            <div class="mb-3">
                                                                <label for="password">Password <small>(Masukkan password baru/lama)</small></label>
                                                                <input type="text" id="inp" name="password" class="form-control" placeholder="Password" required>
                                                                <i id="icon" class="far fa-eye" style="position:absolute; right: 30px; top: 280px; padding: 1px; cursor: pointer;"></i>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if ($_SESSION['level'] == 1) : ?>
                                                            <div class="mb-3">
                                                                <label for="level">Level</label>
                                                                <select name="level" id="level" class="form-control" required>
                                                                    <?php $level = $akun['level']; ?>
                                                                    <option value="1" <?= $level == '1' ? 'selected' : null ?>>Admin</option>
                                                                    <option value="2" <?= $level == '2' ? 'selected' : null ?>>Operator Mahasiswa</option>
                                                                </select>
                                                            </div>
                                                        <?php else : ?>
                                                            <input type="hidden" name="level" value="<?= $akun['level']; ?>">
                                                        <?php endif; ?>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                            <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <!-- Modal Hapus -->
                                <?php foreach ($data_akun as $akun) : ?>
                                    <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel"><i class='bx bxs-trash'></i><span class="mx-1">Hapus Akun</span></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Yakin Ingin Menghapus Data Akun: <?= $akun['nama']; ?> .?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                    <a href="hapus-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

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