<?php
include 'koneksi.php';
$kd_matkul = $_GET['kd_matkul'];

$query = mysql_query("delete from matkul where kd_matkul='$kd_matkul'") or die(mysql_error());

if ($query) {
	 echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='./admin.php?p=L_Matakuliah';
		</script>";
}
?>
