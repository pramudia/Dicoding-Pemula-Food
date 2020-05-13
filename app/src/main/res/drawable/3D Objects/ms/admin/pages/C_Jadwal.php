<?php
ini_set("display_errors","Off");
session_start(); //kuncinya ada disini, tulis diawal script sebelum menulis yang lain
?>
<!-------------------------------------------------------------------------->
        <div class="page-region">
        
        <div class="page-region-content">
                     <?php
/* cek udah login pa blun */
/*
session_is_registered() sebaiknya tidak digunakan (Deprecated Function)
if( !session_is_registered( 'ID' ) || !session_is_registered( 'PASS' ) )
*/
if( !isset($_SESSION['ID']) || !isset($_SESSION['PASS']) ) {
 die( 'Illegal Acces' );
}
?>
<?php include("koneksi.php");
?>
<?php
$kd_ruang=$_POST['kd_ruang'];
					$jam=$_POST['jam'];
					$hari=$_POST['hari'];
					$waktu=$_POST['waktu'];
?>
                   <form name="in_matkul" action="../admin/admin.php?p=C_Jadwal" method="POST">
Kode Ruang : <select name ="kd_ruang" class="form-control">
		<option value="<?php echo "$kd_ruang" ?>"><?php echo "$kd_ruang" ?></option>
<?php
   					// query untuk menampilkan semua jadwal
  					 $query = "SELECT kd_ruang FROM ruang";
   					$hasil = mysql_query($query);
   					while ($kd_ruang = mysql_fetch_array($hasil))
   {
      // setiap negara yang dibaca dari tabel disisipkan ke tag <option></option>
      	echo "<option value='".$kd_ruang['kd_ruang']."'>".$kd_ruang['kd_ruang']."</option>";
   				}
					?></select>
                    Jam : <select name ="jam" class="form-control">
					<option value="<?php echo "$jam" ?>"><?php echo "$jam" ?></option>
					<?php
   					// query untuk menampilkan semua jadwal
  					 $query = "SELECT jam FROM jadwal GROUP BY jam";
   					$hasil = mysql_query($query);
   					while ($jam = mysql_fetch_array($hasil))
   {
      // setiap negara yang dibaca dari tabel disisipkan ke tag <option></option>
      	echo "<option value='".$jam['jam']."'>".$jam['jam']."</option>";
   				}
					?></select>
                    Hari : <select name ="hari" class="form-control">
					<option value="<?php echo "$hari" ?>"><?php echo "$hari" ?></option>
					<?php
   					// query untuk menampilkan semua jadwal
  					 $query = "SELECT hari FROM jadwal GROUP BY hari";
   					$hasil = mysql_query($query);
   					while ($hari = mysql_fetch_array($hasil))
   {
      // setiap negara yang dibaca dari tabel disisipkan ke tag <option></option>
      	echo "<option value='".$hari['hari']."'>".$hari['hari']."</option>";
   				}
					?></select>
                    Waktu : <select name ="waktu" class="form-control">
					<option value="<?php echo "$waktu" ?>"><?php echo "$waktu" ?></option>
					<?php
   					// query untuk menampilkan semua jadwal
  					 $query = "SELECT waktu FROM jadwal GROUP BY waktu";
   					$hasil = mysql_query($query);
   					while ($waktu = mysql_fetch_array($hasil))
   {
      // setiap negara yang dibaca dari tabel disisipkan ke tag <option></option>
      	echo "<option value='".$waktu['waktu']."'>".$waktu['waktu']."</option>";
   				}
					?></select>
                   <input type="submit" value="Cari" class="btn btn-success" />
                   </p>
                    
                    <p>
                    <div class="bg-color-blue fg-color-white padding20">
                        <h3 class="fg-color-white">Data Mata Jadwal.</h3>
                    </div>
                   <table class="table">
                    <thead>
                        <tr class="info">
                            <th>No</th>
                            <th class="right">Kode Matapelajaran</th>
                            <th class="right">Kode Guru</th>
                            <th class="right">Kode Ruang</th>
                            <th class="right">Jam</th>
                            <th class="right">Hari</th>
                            <th class="right">Kelas</th>
                            <th class="right">Waktu</th>
                            <th class="right">Tahun Ajaran</th>
                            <th class="right" colspan="2">Aksi</th>
              
            </td>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
					$kd_ruang=$_POST['kd_ruang'];
					$jam=$_POST['jam'];
					$hari=$_POST['hari'];
					$waktu=$_POST['waktu'];
    $query = mysql_query ("SELECT * FROM jadwal where kd_ruang = '$kd_ruang' and jam = '$jam' and hari = '$hari' and waktu = '$waktu'");
    $no  = 1;
	//$result = mysql_query($query) or die (“gagal”);
   if(mysql_num_rows($query)>0){
   
    while($data = mysql_fetch_array($query)){
		$kode = $data['id']; 
		
		
    ?>
    <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data['kd_matkul'] ?></td>
            <td><?php echo $data['kd_dosen'] ?></td>
            <td><?php echo $data['kd_ruang'] ?></td>
            <td><?php echo $data['jam'] ?></td>
            <td><?php echo $data['hari'] ?></td>
            <td><?php echo $data['kelas'] ?></td>
            <td><?php echo $data['waktu'] ?></td>
            <td><?php echo $data['thn_ajaran'] ?></td>
            <td align="center">
                <a href="admin.php?p=editjadwal&id=<?php echo $data['id'] ?>"><span class="glyphicon glyphicon-edit"></span></a>
                   
                <a href="admin.php?p=hapusjadwal&id=<?php echo $data['id'] ?>" onclick="return confirm('Anda yakin akan menghapus data?')"><span class="glyphicon glyphicon-remove"></span></a>
            </td>
       </tr>
       <?PHP   
$no++;
} 
}else{ ?>
 <tr>
            <td bgcolor="#33CCFF"><?php echo "*" ?></td>
            <td bgcolor="#33CCFF" colspan="2"><?php echo "JAM MASIH KOSONG" ?></td>
            <td bgcolor="#33CCFF"><?php echo "*" ?></td>
            <td bgcolor="#33CCFF"><?php echo "*" ?></td>
            <td bgcolor="#33CCFF"><?php echo "*" ?></td>
            <td bgcolor="#33CCFF"><?php echo "*" ?></td>
            <td bgcolor="#33CCFF"><?php echo "*" ?></td>
            <td bgcolor="#33CCFF"><?php echo "*" ?></td>
            <td bgcolor="#33CCFF"><?php echo "*" ?></td>
            
       </tr>
	<?php   }
?> 
                                                <tr class="info"><td>Jumlah</td><td class="right" colspan="7">0,1 Mb</td></tr>
                    </tbody>

                    <tfoot></tfoot>
                </table>
                            <div class="page-region-content">
                    <div id="pageDiv"></div>
                    <script type="text/javascript" src="js/modern/pagelist.js"></script>
                    <script type="text/javascript">
                    $(document).ready(function(){
                        var page = $("#pageDiv").pagelist();
                        page.total = 10;
                        page.current = 1;
                        page.url = "pagelistresult.php?page={page}";
                        page.ajax = "#pageContent";
                        page.create();
                    });
                </script>
               
            </div>
                   </p>

                    

                    <br />
                    <p>
                       Cek tiap mata jadwal, jam kosong, dan pencarian data jadwal lainnya
                    </p>
                   
                    <p><strong>cara mencari:</strong></p>

                    <ul class="">
                        <li>Pilih Kode Ruang</li>
						<li>Pilih Jam</li>
						<li>Pilih Hari</li>
						<li>Pilih Kode Ruang</li>
						<li>Klik Cari</li>
                       
                    </ul>

                    
                </div>
            </div>
            
            <!--------------------->

