<?php
include 'koneksi.php';
$id = $_GET['id'];

$query = mysql_query("delete from jadwal where id='$id'") or die(mysql_error());

if ($query) {
	 echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='./admin.php?p=L_Jadwal';
		</script>";
}
?>
