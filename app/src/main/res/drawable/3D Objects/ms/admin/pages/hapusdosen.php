<?php
include 'koneksi.php';
$kd_dosen = $_GET['kd_dosen'];

$query = mysql_query("delete from dosen where kd_dosen='$kd_dosen'") or die(mysql_error());

if ($query) {
	 echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='./admin.php?p=L_Dosen';
		</script>";
}
?>
