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
?><?php include("koneksi.php");?>
                   <form name="in_matkul" action="../admin/admin.php?p=L_Ruang" method="POST">
Cari Berdasarkan Nama : <input type="text" name="nama" maxlength="30" /></button>
                   <input type="submit" value="Cari" class="btn btn-success" />
                   </p>
                    
                    <p>
                    <div class="bg-color-blue fg-color-white padding20">
                        <h3 class="fg-color-white">Data Ruang.</h3>
                    </div>
                   <table class="table">
                    <thead>
                        <tr class="success">
                            <th>No</th>
                            <th class="right">Kode Ruang</th>
                            <th class="right">Kapasitas</th>
                            <th class="right" colspan="2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
   $nama = $_POST['nama'];  
    $query = mysql_query ("SELECT * FROM ruang WHERE kd_ruang LIKE '%$nama%'");
    $no  = 1;
	//$result = mysql_query($query) or die (“gagal”);
    while($data = mysql_fetch_array($query)){
		$kode = $data['kd_ruang']; 
    ?>
     <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $kode ?></td>
            <td><?php echo $data['kapasitas'] ?></td>
            <td align="center">
                <a href="admin.php?p=editruang&kd_ruang=<?php echo $data['kd_ruang'] ?>"><span class="glyphicon glyphicon-edit"></span></a>
                   
                <a href="admin.php?p=hapusruang&kd_ruang=<?php echo $data['kd_ruang'] ?>" onclick="return confirm('Anda yakin akan menghapus data?')"><span class="glyphicon glyphicon-remove"></span></a>
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
                    
                    </p>
                    <br />

                    <p><strong>Ruang</strong></p>

                    <ul class="">
                        <li>Kapasitas untuk setiap Orang = max 40 orang</li>
                    
                    </ul>

                    
                </div>
            </div>
            
            <!--------------------->

