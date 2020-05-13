<?php
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
                        <h3 class="fg-color-white">Data Ruang.</h3>
                    </div>
            
			
<?php 
$kd_ruang = $_GET['kd_ruang'];

$query = mysql_query("select * from ruang where kd_ruang ='$kd_ruang'") or die(mysql_error());

$data = mysql_fetch_array($query);
?>

<form name="update_data" action="admin.php?p=updateruang" method="post">
  <div align="center">
  <input type="hidden" name="kd_ruang" value="<?php echo $kd_ruang; ?>" />
  <table border="0" cellpadding="5" cellspacing="0" class="table">
    <tbody>
      <tr>
        <td></td>
       	    <td></td>
       	    <td><input type="hidden" name="kd_ruang1" class="form-control" maxlength="20" required value="<?php echo $data['kd_ruang']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">Kode ruang</div></td>
       	    <td>:</td>
       	    <td><input type="text" name="kd_ruang2" class="form-control" maxlength="20" required value="<?php echo $data['kd_ruang']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">Kapasitas</div></td>
       	    <td>:</td>
       	    <td><input type="text" name="kapasitas" class="form-control" maxlength="20" required value="<?php echo $data['kapasitas']; ?>" /></td>
          </tr>
      
      <tr>
        <td align="right" colspan="3"><input type="submit" class="btn btn-success" name="submit" value="Simpan" /></td>
          </tr>
      </tbody>
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

                    

                   
                    <p><strong>Ruang</strong></p>

                    <ul class="">
                        <li>Kapasitas untuk setiap Orang = max 40 orang</li>
                    
                    </ul>

                    
                </div>
            </div>
            
            <!--------------------->

