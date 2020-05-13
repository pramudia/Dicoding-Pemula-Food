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
<form name="in_matkul" action="../admin/admin.php?p=L_Dosen" method="POST">
Cari Berdasarkan Nama atau Kode : <input type="text" name="nama" maxlength="30" /></button>
                   <input type="submit" value="Cari" class="btn btn-success" />
                   </p>
                    
                    <p>
                    <div class="bg-color-blue fg-color-white padding20">
                        <h3 class="fg-color-white">Data Guru.</h3>
                    </div>
                   <table class="table">
                    <thead>
                        <tr class="warning">
                            <th>No</th>
                            <th class="right">Kode Guru</th>
                            <th class="right">Nama Guru</th>
                            <th class="right">Telepon</th>
                            <th class="right">Email</th>
                            <th class="right" colspan="2">Aksi</th>
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
					 
					  $nama = $_POST['nama'];
    $query = mysql_query ("SELECT * FROM dosen WHERE nm_dosen LIKE '%$nama%' or kd_dosen like '%$nama%' limit $posisi,$batas");
    $no  = $posisi+1;
	//$result = mysql_query($query) or die (“gagal”);
    while($data = mysql_fetch_array($query)){
		$kode = $data['kd_dosen']; 
    ?>
     <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data['kd_dosen'] ?></td>
            <td><?php echo $data['nm_dosen'] ?></td>
            <td><?php echo $data['no_telp'] ?></td>
            <td><?php echo $data['email'] ?></td>
            <td align="center">
                <a href="admin.php?p=editdosen&kd_dosen=<?php echo $data['kd_dosen'] ?>"><span class="glyphicon glyphicon-edit"></span></a>
                   
                <a href="admin.php?p=hapusdosen&kd_dosen=<?php echo $data['kd_dosen'] ?>" onclick="return confirm('Anda yakin akan menghapus data?')"><span class="glyphicon glyphicon-remove"></span></a>
            </td>
        </tr>
       <?PHP
$no++;
}
?>
                        <tr class="info"><td>Jumlah</td><td class="right" colspan="5">0,1 Mb</td></tr>
                    </tbody>

                    <tfoot></tfoot>
                </table>
          
              <?php        
$file = "$_SERVER[PHP_SELF]?p=L_Dosen";
include "classpaging.php";

$p = new Paging;
// Tentukan limit atau batas
$batas = 10;

// Cek halaman dan posisi data
$posisi = $p->cariPosisi($batas,$halaman);

$jmldata = mysql_num_rows(mysql_query ("SELECT * FROM dosen"));
// Dapatkan jumlah halaman
$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
// Cetak link navigasi halaman
$linkHalaman = $p->navHalaman($halaman, $jmlhalaman, $file,$halaman);
echo $linkHalaman;



					?>