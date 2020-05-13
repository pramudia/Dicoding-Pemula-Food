<?php
include "koneksi.php";
$kd_dosen1=$_POST['kd_dosen1'];
$kd_dosen2=$_POST['kd_dosen2'];
 //memindah nilai input kd_dosen dari objek form kedalam variabel $kd_dosen 
 $nm_dosen=$_POST['nm_dosen']; 
 $no_telp=$_POST['no_telp'];
 $email=$_POST['email'];
  // kita bisa tambahkan pengecekan isi masing2 varibel untuk memastikan semuanya sudah diisi 

 if($kd_dosen2!="" && $kd_dosen1!="" && $nm_dosen!="") 
 { //buat susunan query sql sementara dalam variabel 
 $query= "update dosen set kd_dosen = '$kd_dosen2', nm_dosen = '$nm_dosen', no_telp = '$no_telp', email = '$email' where kd_dosen = '$kd_dosen1'";
   
   echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='./admin.php?p=L_Dosen';
		</script>";
  //jalankan query 
  mysql_query($query) or die("Gagal menyimpan karena :".mysql_error()); //or die digunakan untuk memunculkan email jika query gagal dijalankan echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //email tulisan dengan format H2 ini akan muncul jika berhasil } else { echo "<h2 align=\"center\">Isikan data dengan benar</h2>";
 //tulisan dengan format H2 ini akan muncul jika form kosong 
 
 } ?>
