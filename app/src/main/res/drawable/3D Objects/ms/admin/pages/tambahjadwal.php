<?php
include "koneksi.php";
$kd_matkul=$_POST['kd_matkul'];
 //memindah nilai input kd_dosen dari objek form kedalam variabel $kd_dosen 
 $kd_dosen=$_POST['kd_dosen']; 
 $kd_ruang=$_POST['kd_ruang'];
 $jam=$_POST['jam'];
 $hari=$_POST['hari'];
  $kelas=$_POST['kelas'];
   $waktu=$_POST['waktu'];
    $thn_ajaran=$_POST['thn_ajaran'];
	
	$cekdata="select kd_ruang, jam, hari, waktu, thn_ajaran from jadwal WHERE kd_ruang = '$kd_ruang' AND jam = '$jam' AND hari = '$hari' AND waktu = '$waktu' AND thn_ajaran = '$thn_ajaran'"; 
	$ada=mysql_query($cekdata) or die(mysql_error()); 
	
	if(mysql_num_rows($ada)>0 && $kd_ruang!="" && $jam!=""&& $hari!=""&& $waktu!="") {
		 echo "
		 <script>
			alert ('Duplicate Entry Boss..!!!');
			location.href='../admin.php?p=ADD_Jadwal';
		 </script>"; 
		 
		 } else{
	 // kita bisa tambahkan pengecekan isi masing2 varibel untuk memastikan semuanya sudah diisi 
  //buat susunan query sql sementara dalam variabel 
 $query="INSERT INTO jadwal VALUES('','$kd_matkul','$kd_dosen','$kd_ruang','$jam','$hari','$kelas','$waktu','$thn_ajaran');";
   
   echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='../admin.php?p=ADD_Jadwal';
		</script>";
  //jalankan query 
  mysql_query($query) or die("Gagal menyimpan karena :".mysql_error()); //or die digunakan untuk memunculkan email jika query gagal dijalankan echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //email tulisan dengan format H2 ini akan muncul jika berhasil } else { echo "<h2 align=\"center\">Isikan data dengan benar</h2>";
 //tulisan dengan format H2 ini akan muncul jika form kosong 
 } ?>
