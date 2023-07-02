<?php

// Fungsi koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "wisata_jabar");
// End

#######################################################################

// Fungsi Tanggal Indo 1
function tgl_indo($tanggal_indo)
{
	$bulan_indo = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan_indo = explode('-', $tanggal_indo);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan_indo[2] . ' ' . $bulan_indo[(int)$pecahkan_indo[1]] . ' ' . $pecahkan_indo[0];
}
// End

// Fungsi Tanggal Indo 1
function tgl_indo_2($tanggal_indo_2)
{
	$bulan_indo_2 = array(
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Aug',
		'Sep',
		'Okt',
		'Nov',
		'Des'
	);
	$pecahkan_indo_2 = explode('-', $tanggal_indo_2);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan_indo_2[2] . '-' . $bulan_indo_2[(int)$pecahkan_indo_2[1]] . '-' . $pecahkan_indo_2[0];
}
// End

######################################################################

// Fungsi Input wisata
function input_wisata($row_input_data_wisata)
{
	global $conn;

	date_default_timezone_set('Asia/Jakarta');
	$tanggal = date('Y-m-d');
	$jam = date('H:i:s');


	$name_tmp = $_FILES['foto']['name'];
	$file_tmp = $_FILES['foto']['tmp_name'];

	$row_input_data_wisata = array(
		'nama_wisata' 	=> addslashes($_POST["nama_wisata"]),
		'alamat' 		=> addslashes($_POST["alamat"]),
		'deskripsi' 	=> addslashes($_POST["deskripsi"]),
		'harga_tiket' 	=> addslashes($_POST["harga_tiket"]),
		'kategori' 		=> addslashes($_POST["kategori"]),
		'maps' 			=> addslashes($_POST["maps"]),
		'foto' 			=> $name_tmp,
		'tanggal' 		=> $tanggal,
		'waktu' 		=> $jam
	);

	// Pindah Ke dalam Folder
	move_uploaded_file($file_tmp, '../file/' . $name_tmp);

	foreach ($row_input_data_wisata as $key => $value) {
		# code...
		$k[] = $key;
		$v[] = "'" . $value . "'";
	}

	$k = implode(",", $k);
	$v = implode(",", $v);

	$conn->query("INSERT INTO tbl_wisata ($k) VALUES ($v)");
	return mysqli_affected_rows($conn);
}
// End

#######################################################################
// Fungsi Input saran
function input_saran($row_input_saran)
{
	global $conn;
	date_default_timezone_set('Asia/Jakarta');
	$tanggal = date('Y-m-d');
	$jam = date('H:i:s');

	$row_input_saran = array(
		'nama' 				=> addslashes($_POST["nama"]),
		'email' 			=> addslashes($_POST["email"]),
		'no_telp' 			=> $_POST["no_telp"],
		'saran' 			=> addslashes($_POST["saran"]),
		'tanggal' 			=> $tanggal,
		'waktu' 			=> $jam,
	);


	foreach ($row_input_saran as $key => $value) {
		# code...
		$k[] = $key;
		$v[] = "'" . $value . "'";
	}

	$k = implode(",", $k);
	$v = implode(",", $v);

	$conn->query("INSERT INTO tbl_saran ($k) VALUES ($v)");
	return mysqli_affected_rows($conn);
}
// End

#######################################################################

// Fungsi tampilkan data wisata
function tampil_wisata()
{
	global $conn;

	$result_tampil_wisata = $conn->query("SELECT * FROM tbl_wisata ORDER BY id_wisata DESC");
	$rows_wisata = [];
	while ($row_wisata = mysqli_fetch_assoc($result_tampil_wisata)) {
		$rows_wisata[] = $row_wisata;
	}
	return $rows_wisata;
}
// End

#######################################################################

// Fungsi tampilkan data saran
function tampil_saran()
{
	global $conn;

	$result_tampil_saran = $conn->query("SELECT * FROM tbl_saran ORDER BY id_saran DESC");
	$rows_saran = [];
	while ($row_saran = mysqli_fetch_assoc($result_tampil_saran)) {
		$rows_saran[] = $row_saran;
	}
	return $rows_saran;
}
// End

#######################################################################

// Fungsi tampilkan data wisata
function tampil_wisata_2($sql_produl)
{
	global $conn;

	$result_tampil_wisata = $conn->query($sql_produl);
	$rows_wisata = [];
	while ($row_wisata = mysqli_fetch_assoc($result_tampil_wisata)) {
		$rows_wisata[] = $row_wisata;
	}
	return $rows_wisata;
}
// End

#######################################################################

// Fungsi tampilkan kategori gunung
function kategori_gunung()
{
	global $conn;

	$result_kategori_gunung = $conn->query("SELECT * FROM tbl_wisata WHERE kategori = 'Gunung' ORDER BY id_wisata DESC");
	$rows_wisata = [];
	while ($row_wisata = mysqli_fetch_assoc($result_kategori_gunung)) {
		$rows_wisata[] = $row_wisata;
	}
	return $rows_wisata;
}
// End

#######################################################################

// Fungsi tampilkan kategori pantai
function kategori_pantai()
{
	global $conn;

	$result_kategori_pantai = $conn->query("SELECT * FROM tbl_wisata WHERE kategori = 'Pantai' ORDER BY id_wisata DESC");
	$rows_wisata = [];
	while ($row_wisata = mysqli_fetch_assoc($result_kategori_pantai)) {
		$rows_wisata[] = $row_wisata;
	}
	return $rows_wisata;
}
// End

#######################################################################

// Fungsi tampilkan kategori curug
function kategori_curug()
{
	global $conn;

	$result_kategori_curug = $conn->query("SELECT * FROM tbl_wisata WHERE kategori = 'Curug' ORDER BY id_wisata DESC");
	$rows_wisata = [];
	while ($row_wisata = mysqli_fetch_assoc($result_kategori_curug)) {
		$rows_wisata[] = $row_wisata;
	}
	return $rows_wisata;
}
// End

#######################################################################

// Fungsi edit wisata
function edit_wisata()
{
	global $conn;

	$id_wisata = $_POST['id_wisata'];
	$nama_wisata = $_POST['nama_wisata'];
	$alamat = $_POST['alamat'];
	$deskripsi = $_POST['deskripsi'];
	$harga_tiket = $_POST['harga_tiket'];
	$kategori = $_POST['kategori'];
	$maps = $_POST['maps'];
	$coverLama = $_POST['coverLama'];

	// tangkap gambar
	$name_tmp = $_FILES['foto']['name'];
	$file_tmp = $_FILES['foto']['tmp_name'];

	// cek jika admin upload foto baru
	if ($name_tmp) {

		// kalau ada gambar baru, hapus gambar lama
		unlink('../file/' . $coverLama);

		// Pindah Ke dalam Folder
		move_uploaded_file($file_tmp, '../file/' . $name_tmp);

		// Update
		$conn->query("UPDATE tbl_wisata SET

				nama_wisata = '$nama_wisata',
				alamat = '$alamat',
				deskripsi = '$deskripsi',
				harga_tiket = '$harga_tiket',
				kategori = '$kategori',
				maps = '$maps',
				foto = '$name_tmp'

				WHERE id_wisata = '$id_wisata'");
	} else {

		// Update
		$conn->query("UPDATE tbl_wisata SET

				nama_wisata = '$nama_wisata',
				alamat = '$alamat',
				deskripsi = '$deskripsi',
				harga_tiket = '$harga_tiket',
				kategori = '$kategori',
				maps = '$maps'

				WHERE id_wisata = '$id_wisata'");
	}

	return mysqli_affected_rows($conn);
}
// End

######################################################################

// Fungsi hapus wisata
function hapus_wisata()
{
	global $conn;

	$id_wisata = $_POST['id_wisata'];
	$conn->query("DELETE FROM tbl_wisata WHERE id_wisata = $id_wisata");

	return mysqli_affected_rows($conn);
}
// End

#######################################################################

// Fungsi hapus saran
function hapus_saran()
{
	global $conn;

	$id_saran = $_POST['id_saran'];
	$conn->query("DELETE FROM tbl_saran  WHERE id_saran = $id_saran");

	return mysqli_affected_rows($conn);
}
// End

#######################################################################

// Fungsi registrasi
function registrasi($data)
{
	global $conn;

	$nama = strtolower(stripslashes($data["nama"]));
	$username = htmlspecialchars($data["username"]);
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek apakah username sudah terdaftar apa belum
	$result = mysqli_query($conn, "SELECT username FROM tbl_admin WHERE username = '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "
					<script>
						alert('Maaf, username sudah terdaftar!')
					</script>";
		return false;
	}

	// cek konfirmasi password
	if ($password !== $password2) {
		echo "
					<script>
						alert('Maaf, konfirmasi password tidak sesuai!')
					</script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// menambahkan user baru ke dalam database
	mysqli_query($conn, "INSERT INTO tbl_admin VALUES ('', '$nama', '$username', '$password')");
	return mysqli_affected_rows($conn);
}

// End

#######################################################################

// Tampil semua data wisata
$sql_wisata = $conn->query("SELECT * FROM tbl_wisata");
$jml_wisata = mysqli_num_rows($sql_wisata);

// End
#######################################################################

// Tampil Kategori gunung
$sql_kategori_gunung = $conn->query("SELECT * FROM tbl_wisata WHERE kategori = 'Gunung'");
$jml_kategori_gunung = mysqli_num_rows($sql_kategori_gunung);

// End
#######################################################################

// Tampil Kategori pantai
$sql_kategori_pantai = $conn->query("SELECT * FROM tbl_wisata WHERE kategori = 'Pantai'");
$jml_kategori_pantai = mysqli_num_rows($sql_kategori_pantai);

// End
#######################################################################

// Tampil Kategori curug
$sql_kategori_curug = $conn->query("SELECT * FROM tbl_wisata WHERE kategori = 'Curug'");
$jml_kategori_curug = mysqli_num_rows($sql_kategori_curug);

// End
#######################################################################

//tombol Input Wisata
if (isset($_POST['input_wisata'])) {
	if (input_wisata($_POST) > 0) {
		echo "
					<script>
					alert('Data wisata berhasil ditambahkan!');
					document.location.href='data_wisata.php';
					</script>
				";
	}
}

// End

#######################################################################

// tombol input saran
if (isset($_POST['input_saran'])) {
	if (input_saran($_POST) > 0) {
		echo "
					<script>
					alert('Saran telah terkirim, Terimakasih!');
					document.location.href='http://localhost/wisata_jabar/index.php';
					</script>
				";
	}
}

// End

#######################################################################

//tombol Hapus wisata
if (isset($_POST['hapus_wisata'])) {
	if (hapus_wisata($_POST) > 0) {
		echo "
					<script>
					alert('Data wisata berhasil dihapus!');
					document.location.href='data_wisata.php';
					</script>
				";
	}
}

// End

#######################################################################

//tombol Hapus saran
if (isset($_POST['hapus_saran'])) {
	if (hapus_saran($_POST) > 0) {
		echo "
					<script>
					alert('Data saran berhasil dihapus!');
					document.location.href='data_saran.php';
					</script>
				";
	}
}

// End

#######################################################################

//tombol edit wisata
if (isset($_POST['edit_wisata'])) {
	if (edit_wisata($_POST) > 0) {
		echo "
					<script>
					alert('Data wisata berhasil diubah!');
					document.location.href='data_wisata.php';
					</script>
				";
	}
}

	// End

#######################################################################

// function notif_wa()
// {

// 	$nama_pemesan = $_POST['nama_pemesan'];
// 	$alamat = $_POST['alamat'];
// 	$no_telpon = $_POST['no_telpon'];
// 	$jumlah = $_POST['jumlah'];
// 	$metode_pembayaran = $_POST['metode_pembayaran'];

// 	header('Location: https://api.whatsapp.com/send?phone=' . $nama_pemesan . '&text=NamaPemsan:%20' . $alamat . '%20%0DNoTelpon:%20' . $no_telpon . '%20%0DJumlah:%20' . $jumlah . '%20%0DMetodePembayaran:%20' . $metode_pembayaran);
// }