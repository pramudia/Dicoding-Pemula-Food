<?php
include 'koneksi.php';
$kd_ruang = $_GET['kd_ruang'];

$query = mysql_query("delete from ruang where kd_ruang='$kd_ruang'") or die(mysql_error());

if ($query) {
	 echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='./admin.php?p=L_Ruang';
		</script>";
}
?>
