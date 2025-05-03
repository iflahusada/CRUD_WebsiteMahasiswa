<?php

$title = 'Akun';
include 'layout/header-register.php';


//If tap button "Tambah" run this script
if (isset($_POST['tambah'])) {
    if (register_akun($_POST) > 0) {
        echo "<script>
                alert('Data akun berhasil ditambahkan');
                document.location.href = 'login.php';
                </script>";
    } else {
        echo "<script>
                    alert('Data akun gagal ditambahkan');
                    document.location.href = 'login.php';
                </script>";
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="register.php">Register Akun</a></li>
                        <li class="breadcrumb-item active">Register</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <figcaption class="blockquote-footer text-lg display-2">
            <cite title="Source Title">Akun akan digunakan untuk login</cite>
            </figcaption>
            <hr>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama anda..." required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username anda..." required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email anda..." required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="level">Level</label>
                    <select name="level" id="level" class="form-control" required>
                        <option value="">-- pilih role --</option>
                        <option value="1">Admin</option>
                        <option value="2">Operator Mahasiswa</option>
                    </select>
                </div>

                <button type="submit" name="tambah" class="btn btn-primary"><i class='fas fa-plus'></i><span class="mx-1">Tambah</span></button>
                <a href="index.php" class="btn btn-success"><i class='fas fa-cancel'></i><span class="mx-1">Batal</span></a>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>




<?php include 'layout/footer.php'; ?>