<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "chatbot");

// ambil data pesan dari index.html
$pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

// ambil data dari database
$cek_data = mysqli_query($conn, "SELECT jawaban FROM chat WHERE pertanyaan LIKE '%$pesan%' ");

// eksekusi apabila berhasil mengambil data dari database
if (mysqli_num_rows($cek_data) > 0) {
    $data = mysqli_fetch_assoc($cek_data);

    // kirim jawaban / balasan 
    $balasan = $data['jawaban'];
    echo $balasan;
} else {

    // jika pertanyaan tidak /belum ada di dalam database
    echo "Maaf, saya tidak mengerti apa yang anda maksud";
}
