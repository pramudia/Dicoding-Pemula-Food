<?php
include "koneksi.php";
$kd_matkul=$_POST['kd_matkul'];
 //memindah nilai input kd_dosen dari objek form kedalam variabel $kd_dosen 
 $nm_matkul=$_POST['nm_matkul']; 
 $sks=$_POST['sks'];
 $semester=$_POST['semester'];
 $jml_pngambil=$_POST['jml_pngambil']; // kita bisa tambahkan pengecekan isi masing2 varibel untuk memastikan semuanya sudah diisi 


 $cekdata="select kd_matkul from matkul WHERE kd_matkul = '$kd_matkul'"; 
	$ada=mysql_query($cekdata) or die(mysql_error()); 
	
	if(mysql_num_rows($ada)>0) {
		 echo "
		 <script>
			alert ('Duplicate Entry kode Matakuliah Pak..!!!');
			location.href='../admin.php?p=ADD_Matakuliah';
		 </script>"; 
		 
		 } else{
 //buat susunan query sql sementara dalam variabel 
 $query="INSERT INTO matkul(kd_matkul,nm_matkul,sks,semester,jml_pngambil) VALUES('$kd_matkul','$nm_matkul','$sks','$semester','$jml_pngambil');";
   
   echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='../admin.php?p=ADD_Matakuliah';
		</script>";
  //jalankan query 
  mysql_query($query) or die("Gagal menyimpan karena :".mysql_error()); //or die digunakan untuk memunculkan email jika query gagal dijalankan echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //email tulisan dengan format H2 ini akan muncul jika berhasil } else { echo "<h2 align=\"center\">Isikan data dengan benar</h2>";
 //tulisan dengan format H2 ini akan muncul jika form kosong 
 } ?>
