<?php
//error_reporting(0);
session_start(); //kuncinya ada disini, tulis diawal script sebelum menulis yang lain

$server = 'localhost';
$user_db = 'root';
$password_db = '';
$nama_db = 'ms';

/* Koneksi database*/
mysql_connect( $server, $user_db, $password_db ) or die( mysql_error() );
mysql_select_db( $nama_db ) or die( mysql_error() );

/* Ambil variabel */
$user_id = $_POST['user_id'];
$pass = $_POST['pass'];


		//<script>
			//alert ('Mohon Jangan dikosongi..!!!');
		//	location.href='../admin';
		//</script>";


$cek_log=mysql_query("select * from user where username='$user_id' and password='$pass'");
$hitung=mysql_num_rows($cek_log);
 $j=mysql_fetch_array($cek_log);
 $user=$j['username'];
 $pass=$j['password'];


if ($hitung > 0){
 $_SESSION['ID']=$user;
 $_SESSION['PASS']=$pass;
header('location=admin.php');
?>
<script>
			alert ('Login success..!!!');
			location.href='admin.php';
		</script>";
		<?php
}

else{
header('location=index.php');
}
?>