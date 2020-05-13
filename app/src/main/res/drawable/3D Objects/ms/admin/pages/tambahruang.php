<?php
include "koneksi.php";
$kd_ruang=$_POST['kd_ruang'];
 //memindah nilai input kd_dosen dari objek form kedalam variabel $kd_dosen 
 $kapasitas=$_POST['kapasitas']; 
 // kita bisa tambahkan pengecekan isi masing2 varibel untuk memastikan semuanya sudah diisi 
 $cekdata="select kd_ruang from ruang WHERE kd_ruang = '$kd_ruang'"; 
	$ada=mysql_query($cekdata) or die(mysql_error()); 
	
	if(mysql_num_rows($ada)>0 && $kd_ruang!="" ) {
		 echo "
		 <script>
			alert ('Duplicate Entry kode Ruang Pak..!!!');
			location.href='../admin.php?p=ADD_Ruang';
		 </script>"; 
		 
		 } else{
 //buat susunan query sql sementara dalam variabel 
 $query="INSERT INTO ruang (kd_ruang, kapasitas) VALUES ('$kd_ruang','$kapasitas');";
   
   echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='../admin.php?p=ADD_Ruang';
		</script>";
  //jalankan query 
  mysql_query($query) or die("Gagal menyimpan karena :".mysql_error()); //or die digunakan untuk memunculkan email jika query gagal dijalankan echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //email tulisan dengan format H2 ini akan muncul jika berhasil } else { echo "<h2 align=\"center\">Isikan data dengan benar</h2>";
 //tulisan dengan format H2 ini akan muncul jika form kosong 
 } ?>
