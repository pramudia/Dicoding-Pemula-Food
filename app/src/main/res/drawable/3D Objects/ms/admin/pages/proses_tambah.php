<?php include("koneksi.php"); //memanggil file koneksi database 
$kd_dosen=$_POST['kd_d'];
 //memindah nilai input kd_dosen dari objek form kedalam variabel $kd_dosen 
 $nm_dosen=$_POST['nm_d']; 
 $no_telp=$_POST['Telp'];
 $email=$_POST['email']; // kita bisa tambahkan pengecekan isi masing2 varibel untuk memastikan semuanya sudah diisi 
 $cekdata="select kd_dosen from dosen WHERE kd_dosen = '$kd_dosen'"; 
	$ada=mysql_query($cekdata) or die(mysql_error()); 
	
	if(mysql_num_rows($ada)>0) {
		 echo "
		 <script>
			alert ('Duplicate Entry kode Dosen Pak..!!!');
			location.href='../admin.php?p=ADD_Dosen';
		 </script>"; 
		 
		 } else{

 $query="INSERT INTO dosen(kd_dosen, nm_dosen, no_telp, email) VALUES('$kd_dosen','$nm_dosen','$no_telp','$email');";
   
   echo "
		<script>
			alert ('BERHASIL..!!!');
			location.href='../admin.php?p=ADD_Dosen';
		</script>";
  //jalankan query 
  mysql_query($query) or die("Gagal menyimpan karena :".mysql_error()); //or die digunakan untuk memunculkan email jika query gagal dijalankan echo "<h2 align=\"center\">Data berhasil disimpan</h2>"; //email tulisan dengan format H2 ini akan muncul jika berhasil } else { echo "<h2 align=\"center\">Isikan data dengan benar</h2>";
 //tulisan dengan format H2 ini akan muncul jika form kosong 
 } 
 

 
 ?> 