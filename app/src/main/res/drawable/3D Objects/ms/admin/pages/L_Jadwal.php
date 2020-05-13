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
<?php include("koneksi.php");?>
                   </p>
                    
                    <p>
                    <div class="bg-color-blue fg-color-white padding20">
                        <h3 class="fg-color-white">Data Mata Jadwal.</h3>
                    </div>
                   <table class="table">
                    <thead>
                        <tr class="warning">
                            <th>No</th>
                            <th class="right">Kode Matapelajaran    </th>
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
$batas   = 10;//banyaknya data yang ditampilkan 
$halaman = $_GET['halaman']; 
if(empty($halaman)){ 
    $posisi=0; 
    $halaman=1; 
} 
else{ 
    $posisi = ($halaman-1) * $batas; 
}  
					
    $query = mysql_query ("SELECT * FROM jadwal limit $posisi,$batas");
    $no  = $posisi+1;
	//$result = mysql_query($query) or die (“gagal”);
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

?>
                                                <tr class="info"><td>Jumlah</td><td class="right" colspan="7">0,1 Mb</td></tr>
                    </tbody>

                    <tfoot></tfoot>
                </table>
           <?php        
$file = "$_SERVER[PHP_SELF]?p=L_Jadwal";
include "classpaging.php";

$p = new Paging;
// Tentukan limit atau batas
$batas = 10;

// Cek halaman dan posisi data
$posisi = $p->cariPosisi($batas,$halaman);

$jmldata = mysql_num_rows(mysql_query ("SELECT * FROM jadwal"));
// Dapatkan jumlah halaman
$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
// Cetak link navigasi halaman
$linkHalaman = $p->navHalaman($halaman, $jmlhalaman, $file,$halaman);
echo $linkHalaman;



					?>