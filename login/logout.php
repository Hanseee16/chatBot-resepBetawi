<?php
// menghilangkan session
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('satu', '', time() - 3600);
setcookie('dua', '', time() - 3600);

header("Location: ../index.php");
