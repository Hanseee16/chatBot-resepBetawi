<?php
require 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="login-box">
                    <form method="post">
                        <h1 class="text-center fs-4 text-white mb-5 fw-medium">Daftar</h1>
                        <div class="user-box">
                            <input type="text" name="nama" required="" />
                            <label>Nama</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="username" required="" />
                            <label>Username</label>
                        </div>
                        <div class="user-box">
                            <input type="password" name="password" required="" />
                            <label>Password</label>
                        </div>
                        <div class="user-box">
                            <input type="password" name="password2" required="" />
                            <label>Konfirmasi Password</label>
                        </div>
                        <div class="text-center text-white">
                            <p>
                                Sudah punya akun? <a href="../index.php"
                                    class="text-decoration-none text-white daftar"><span>Masuk</span></a>
                            </p>
                        </div>
                        <center>
                            <button type="submit" name="daftar">Daftar <span></span></button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>