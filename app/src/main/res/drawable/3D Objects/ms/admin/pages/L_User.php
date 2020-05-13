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
                   </p>
                    
                    <p>
                    <div class="bg-color-blue fg-color-white padding20">
                        <h3 class="fg-color-white">Data User.</h3>
                    </div>
                   <table class="table table-condensed">
                    <thead>
                        <tr class="active">
                            <th>No</th>
                            <th class="right">User Name</th>
                            <th class="right">Password</th>
                            <th class="right" colspan="2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
    $query = mysql_query ("SELECT * FROM user");
    $no  = 1;
	//$result = mysql_query($query) or die (“gagal”);
    while($data = mysql_fetch_array($query)){
		$kode = $data['username']; 
    ?>
     <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data['username'] ?></td>
            <td><?php echo $data['password'] ?></td>
            <td align="center">
                <a href="admin.php?p=edituser&username=<?php echo $data['username'] ?>"><span class="glyphicon glyphicon-edit"></span></a>
                   
                <a href="pages/hapususer.php?username=<?php echo $data['username'] ?>" onclick="return confirm('Anda yakin akan menghapus data?')"><span class="glyphicon glyphicon-remove"></span></a>
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

                    <h2><span class="label important">*</span> Info</h2>

                    <p><strong>User</strong></p>

                    <ul class="">
                        <li>Hanya berlaku untuk 1 hak akses Admin Panel</li>
                    
                    </ul>

                    
                </div>
            </div>
            
            <!--------------------->

