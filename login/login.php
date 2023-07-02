<?php
// session
session_start();

// menghubungkan koneksi database pada file function
require '../functions/functions.php';

// mengecek ada cookie atau tidak
if (isset($_COOKIE['satu']) && isset($_COOKIE['dua'])) {
  $satu = $_COOKIE['satu'];
  $dua = $_COOKIE['dua'];

  // mengambil username berdasarkan id
  $result = mysqli_query($conn, "SELECT username FROM tbl_user WHERE id = $satu");
  $row = mysqli_fetch_assoc($result);

  // cek cookie dan username
  if ($dua === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
  }
}

// mengecek ada session atau tidak
if (isset($_SESSION["login"])) {
  header("Location: ../admin/dashboard.php");
  exit;
}

// ketika tombol login di klik
if (isset($_POST["login"])) {

  $username = addslashes($_POST["username"]);
  $password = addslashes($_POST["password"]);
  $result = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username = '$username'");

  // cek username
  if (mysqli_num_rows($result) === 1) {

    // cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {

      // set session
      $_SESSION["login"] = true;

      // cek remember me
      if (isset($_POST['remember'])) {

        // membuat cookie
        setcookie('satu', $row['id'], time() + 60);
        setcookie('dua', hash('sha256', $row['username']), time() + 60);
      }

      // ketika login berhasil, maka pindah ke file index.php
      echo "
            <script>
            alert('Login Berhasil!');
            document.location.href='../admin/dashboard.php';
            </script>
        ";
      exit;
    }
  }
  $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/login.css" />
</head>

<!-- pesan ketika error -->
<?php if (isset($error)) : ?>
<script>
alert('Maaf, Username atau Password salah!')
</script>
<?php endif; ?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="login-box">
                    <form action="" method="post">
                        <h1 class="text-center fs-4 text-white mb-5 fw-medium">Login</h1>
                        <div class="user-box">
                            <input type="text" name="username" required="" />
                            <label>Username</label>
                        </div>
                        <div class="user-box">
                            <input type="password" name="password" required="" />
                            <label>Password</label>
                        </div>
                        <!-- <div class="text-center text-white">
              <p>
                Tidak punya akun? <a href="./layout/register.php" class="text-decoration-none text-white daftar"><span>Daftar</span></a>
              </p>
            </div> -->
                        <center>
                            <button type="submit" name="login">Login <span></span></button>
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