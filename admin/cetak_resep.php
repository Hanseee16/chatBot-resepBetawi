<?php
// Koneksi
require '../functions/functions.php';
?>
<!DOCTYPE html>
<html>

<head>
    <!-- <title>Export Data Ke Excel Dengan PHP</title> -->

</head>

<body>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Resep Makanan.xls");
    ?>

    <table border="1">
        <tr>
            <th>No</th>
            <th class="text-center">Pertanyaan</th>
            <th class="text-center">Jawaban</th>
        </tr>
        <?php

        // menampilkan data wisata
        $data = mysqli_query($conn, "SELECT * FROM chat");
        $no = 1;
        while ($d = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['pertanyaan']; ?></td>
            <td><?= $d['jawaban']; ?></td>

        </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>