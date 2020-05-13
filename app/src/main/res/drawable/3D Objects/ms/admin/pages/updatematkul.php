<?php
include "koneksi.php";
$kd_matkul1=$_POST['kd_matkul1'];
$kd_matkul2=$_POST['kd_matkul2'];
 //memindah nilai input kd_dosen dari objek form kedalam variabel $kd_dosen 
 $nm_matkul=$_POST['nm_matkul']; 
 $sks=$_POST['sks'];
 $semester=$_POST['semester'];
 $jml_pngambil=$_POST['jml_pengambil']; // kita bisa tambahkan pengecekan isi masing2 varibel untuk memastikan semuanya sudah diisi 

 if($kd_matkul2!="" && $kd_matkul1!="" && $nm_matkul!="") 
 { //buat susunan query sql sementara dalam variabel 
 $query= "update matkul set kd_matkul = '$kd_matkul2', nm_matkul = '$nm_matkul', sks = '$sks', semester = '$semester', jml_pngambil = '$jml_pngambil' where kd_matkul = '$kd_matkul1'";
   
   echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='./admin.php?p=L_Matakuliah';
		</script>";
  //jalankan query 
  mysql_query($query) or die("Gagal menyimpan karena :".mysql_error()); //or die digunakan untuk memunculkan email jika query gagal dijalankan echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //email tulisan dengan format H2 ini akan muncul jika berhasil } else { echo "<h2 align=\"center\">Isikan data dengan benar</h2>";
 //tulisan dengan format H2 ini akan muncul jika form kosong 
 
 } ?>
