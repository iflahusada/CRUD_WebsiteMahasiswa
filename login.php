<?php
session_start();

include("config/app.php");

// check if the login button is pressed
if (isset($_POST['login'])) {
    //catch input username & password
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Check username
    $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username'");

    // if there is a user
    if (mysqli_num_rows($result) == 1) {
        //Check password
        $hasil = mysqli_fetch_assoc($result);
        if (password_verify($password, $hasil['password'])) {
            //set session
            $_SESSION['login']      = true;
            $_SESSION['id_akun']    = $hasil['id_akun'];
            $_SESSION['nama']       = $hasil['nama'];
            $_SESSION['username']   = $hasil['username'];
            $_SESSION['email']      = $hasil['email'];
            $_SESSION['level']      = $hasil['level'];

            header("Location: index.php");
        }
    }
    $error = true;

};
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />


    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        .line-with-text {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }

        .line-with-text::before,
        .line-with-text::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #000;
        }

        .line-with-text::before {
            margin-right: 10px;
        }

        .line-with-text::after {
            margin-left: 10px;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <div class="container">
        <main class="form-signin">
            <form action="" method="POST">
                <!-- <h1 class="h3 mb-3 display-4">Login</h1> -->
                <div class="typewriter mb-3">
                    <h1 id="typing-text" class="h3"></h1>
                </div>
                <figcaption class="blockquote-footer">
                    Sesuai dengan data <cite title="Source Title">akun yang didaftarkan</cite>
                </figcaption>
                <hr>

                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger text-center">
                        <b>Username/Password SALAH</b>
                    </div>
                <?php endif; ?>

                <div class="form-floating mb-2">
                    <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username..." required>
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" id="floatingPassword" name="password" class="form-control" placeholder="Password" required>
                    <i id="togglePassword" class="far fa-eye" style="position:absolute; right: 10px; top: 20px; padding: 1px; cursor: pointer;"></i>
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>

                <div class="line-with-text">Or</div>
                <div class="text-center">
                    <a href="register.php" class="fs-6">Belum punya akun?</a>
                </div>
                <p class="mt-5 mb-3 text-muted">Copyright &copy; <i>Kelompok 7</i> <?= date('Y') ?></p>
            </form>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const text1 = "Silahkan Login!";
            const typingTextElement = document.getElementById("typing-text");
            let index = 0;
            const speed = 100; // kecepatan ketik dalam milidetik
            const delayBeforeRestart = 2000; // jeda sebelum mengulangi animasi dalam milidetik

            function type() {
                if (index < text1.length) {
                    typingTextElement.innerHTML += text1.charAt(index);
                    index++;
                    setTimeout(type, speed);
                } else {
                    setTimeout(() => {
                        typingTextElement.innerHTML = '';
                        index = 0;
                        type();
                    }, delayBeforeRestart);
                }
            }

            type();
        });



        // Show hide pw
        document.getElementById('togglePassword').addEventListener('click', function (e) {
        const passwordField = document.getElementById('floatingPassword');
        const toggleIcon = e.target;

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });


    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>