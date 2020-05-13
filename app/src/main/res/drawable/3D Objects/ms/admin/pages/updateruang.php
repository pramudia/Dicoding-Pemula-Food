<?php
include "koneksi.php";
$kd_ruang1=$_POST['kd_ruang1'];
$kd_ruang2=$_POST['kd_ruang2'];
 //memindah nilai input kd_ruang dari objek form kedalam variabel $kd_ruang 
 $kapasitas=$_POST['kapasitas']; 
  // kita bisa tambahkan pengecekan isi masing2 varibel untuk memastikan semuanya sudah diisi 

 if($kd_ruang2!="" && $kd_ruang1!="") 
 { //buat susunan query sql sementara dalam variabel 
 $query= "update ruang set kd_ruang = '$kd_ruang2', kapasitas = '$kapasitas' where kd_ruang = '$kd_ruang1'";
   
   echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='./admin.php?p=L_Ruang';
		</script>";
  //jalankan query 
  mysql_query($query) or die("Gagal menyimpan karena :".mysql_error()); //or die digunakan untuk memunculkan email jika query gagal dijalankan echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //email tulisan dengan format H2 ini akan muncul jika berhasil } else { echo "<h2 align=\"center\">Isikan data dengan benar</h2>";
 //tulisan dengan format H2 ini akan muncul jika form kosong 
 
 } ?>
