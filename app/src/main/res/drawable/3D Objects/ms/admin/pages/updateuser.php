<?php
include "koneksi.php";
$username1=$_POST['username1'];
$username2=$_POST['username2'];
$desc=$_POST['password'];
$password=md5($_POST['password']); 
 
  // kita bisa tambahkan pengecekan isi masing2 varibel untuk memastikan semuanya sudah diisi 

 if($username2 !="" && $username1!="") 
 { //buat susunan query sql sementara dalam variabel 
 $query= "update user set username = '$username2', password = '$password', deskripsi = '$desc' where username = '$username1'";
   
   echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='./admin.php?p=L_User';
		</script>";
  //jalankan query 
  mysql_query($query) or die("Gagal menyimpan karena :".mysql_error()); //or die digunakan untuk memunculkan email jika query gagal dijalankan echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //email tulisan dengan format H2 ini akan muncul jika berhasil } else { echo "<h2 align=\"center\">Isikan data dengan benar</h2>";
 //tulisan dengan format H2 ini akan muncul jika form kosong 
 
 } ?>
