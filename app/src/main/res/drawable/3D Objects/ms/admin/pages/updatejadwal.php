<?php
include "koneksi.php";
$id=$_POST['id'];
$kd_matkul2=$_POST['kd_matkul2'];
 //memindah nilai input kd_dosen dari objek form kedalam variabel $kd_dosen 
 $kd_dosen=$_POST['kd_dosen']; 
 $kd_ruang=$_POST['kd_ruang'];
 $jam=$_POST['jam'];
 $hari=$_POST['hari'];
 $kelas=$_POST['kelas'];
 $waktu=$_POST['waktu'];
 $thn_ajaran=$_POST['thn_ajaran']; // kita bisa tambahkan pengecekan isi masing2 varibel untuk memastikan semuanya sudah diisi 

 if($id!=""&& $kd_ruang!="" && $jam!="" && $hari!=""&& $waktu!="") 
 { //buat susunan query sql sementara dalam variabel 
 $query= "update jadwal set kd_matkul = '$kd_matkul2', kd_dosen = '$kd_dosen', kd_ruang = '$kd_ruang', jam = '$jam', hari = '$hari', kelas = '$kelas',waktu = '$waktu',thn_ajaran = '$thn_ajaran' where id = '$id'";
   
   echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='./admin.php?p=L_Jadwal';
		</script>";
  //jalankan query 
  mysql_query($query) or die("Gagal menyimpan karena :".mysql_error()); //or die digunakan untuk memunculkan email jika query gagal dijalankan echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //email tulisan dengan format H2 ini akan muncul jika berhasil } else { echo "<h2 align=\"center\">Isikan data dengan benar</h2>";
 //tulisan dengan format H2 ini akan muncul jika form kosong 
 
 } ?>
