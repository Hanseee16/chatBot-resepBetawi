<!-- <?php
require 'functions/pesan.php';
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Resep BETAWI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&family=Inter&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg fixed-top py-2" style="background-color: #202024">
        <div class="container">
            <a class="navbar-brand text-white fs-3 fw-normal" href="#">Resep<span>BETAWI</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                <div class="logout">
                    <a href="login/login.php" target="_blank">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- content -->
    <div class="container content" style="background-color: #202024">
        <div class="row custom">
            <div class="col-md-12">
                <div class="form">
                    <div class="bot-message">
                        <div class="message">Selamat Datang</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->

    <!-- footer -->
    <footer class="d-flex justify-content-center gap-3 fixed-bottom py-3">
        <div class="position-relative w-50">
            <input type="text" class="focus-ring focus-ring-primary" id="input"
                placeholder="Resep makanan apa yang ingin ditanyakan?" />
            <button id="send-btn" class="btnKirim focus-ring focus-ring-primary"><i
                    class="bi bi-send-fill"></i></button>
        </div>
    </footer>
    <!-- end footer -->

    <script>
    $(document).ready(function() {
        $("#send-btn").on("click", function() {
            // ambil data
            $input = $("#input").val();

            // masukkan data ke form
            $message = '<div class="user-message"><p>' + $input + "</p></div>";

            // masukkan data
            $(".form").append($message);

            // hapus pesan yang sudah di kirim
            $("#input").val("");

            // ajax
            $.ajax({
                url: "functions/pesan.php",
                type: "POST",
                data: "pesan=" + $input,
                success: function(result) {
                    // jika sukses minta balasan
                    $balasan =
                        '<div class="bot-message"><div class="icon"><i class="bi bi-robot"></i></div><div class="message"><p>' +
                        result + "</p></div></div>";
                    $balasan = '<div class="bot-message"><div class="message"><p>' +
                        result + "</p></div></div>";

                    // masukkan ke form
                    $(".form").append($balasan);

                    // scroll pesan ke ke bawah setelah mengirim
                    $(".form").scrollTop($(".form")[0].scrollHeight);
                },
            });
        });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>