<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "chatbot");

#######################################################################

// Fungsi Input chat
function input_chat($row_input_chat)
{
  global $conn;

  $row_input_chat = array(
    'pertanyaan'    => addslashes($_POST["pertanyaan"]),
    'jawaban'       => addslashes($_POST["jawaban"]),

  );

  foreach ($row_input_chat as $key => $value) {
    # code...
    $k[] = $key;
    $v[] = "'" . $value . "'";
  }

  $k = implode(",", $k);
  $v = implode(",", $v);

  $conn->query("INSERT INTO chat ($k) VALUES ($v)");
  return mysqli_affected_rows($conn);
}
// End
#######################################################################

// Fungsi tampilkan data chat
function tampil_chat()
{
  global $conn;

  $result_tampil_chat = $conn->query("SELECT * FROM chat ORDER BY id DESC");
  $rows_chat = [];
  while ($row_chat = mysqli_fetch_assoc($result_tampil_chat)) {
    $rows_chat[] = $row_chat;
  }
  return $rows_chat;
}
// End
#######################################################################

// Fungsi edit chat
function edit_chat()
{
  global $conn;

  $id = $_POST['id'];
  $pertanyaan = $_POST['pertanyaan'];
  $jawaban = $_POST['jawaban'];

  // Update
  $conn->query("UPDATE chat SET

				pertanyaan = '$pertanyaan',
				jawaban = '$jawaban'
				
				WHERE id = '$id'");

  return mysqli_affected_rows($conn);
}
// End
######################################################################

// Fungsi hapus resep
function hapus_resep()
{
  global $conn;

  $id = $_POST['id'];
  $conn->query("DELETE FROM chat WHERE id = $id");

  return mysqli_affected_rows($conn);
}
// End
#######################################################################

// Tampil semua data resep
$sql_resep = $conn->query("SELECT * FROM chat");
$jml_resep = mysqli_num_rows($sql_resep);

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
  $result = mysqli_query($conn, "SELECT username FROM tbl_user WHERE username = '$username'");
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
  mysqli_query($conn, "INSERT INTO tbl_user VALUES ('', '$nama', '$username', '$password')");
  return mysqli_affected_rows($conn);
}
// End

// ketika tombol daftar di klik
if (isset($_POST["daftar"])) {
  if (registrasi($_POST) > 0) {
    echo "
				<script>
				alert('Registrasi berhasil, silakan login terlebih dahulu!');
				document.location.href='../index.php';
				</script>
			";
    // exit;
  }
}

// End
#######################################################################

//tombol Input chat
if (isset($_POST['input_chat'])) {
  if (input_chat($_POST) > 0) {
    echo "
					<script>
					alert('Data berhasil ditambahkan!');
					document.location.href='data_resep.php';
					</script>
				";
  }
}
// End

#######################################################################

//tombol Hapus resep
if (isset($_POST['hapus_resep'])) {
  if (hapus_resep($_POST) > 0) {
    echo "
					<script>
					alert('Data berhasil dihapus!');
					document.location.href='data_resep.php';
					</script>
				";
  }
}

// End
#######################################################################

//tombol edit chat
if (isset($_POST['edit_chat'])) {
  if (edit_chat($_POST) > 0) {
    echo "
					<script>
					alert('Data berhasil diubah!');
					document.location.href='data_resep.php';
					</script>
				";
  }
}

	// End
#######################################################################