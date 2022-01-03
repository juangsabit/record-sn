<?php
// Membuat variabel, ubah sesuai dengan nama host dan database pada hosting 
$host	= "10.14.81.14";
$user	= "general";
$pass	= "Avi123!";
$db	    = "recordsn";

//Menggunakan objek mysqli untuk membuat koneksi dan menyimpan nya dalam variabel $mysqli	
$mysqli = new mysqli($host, $user, $pass, $db);

?>