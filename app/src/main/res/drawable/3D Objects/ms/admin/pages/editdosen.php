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
                        <h3 class="fg-color-white">Data Dosen.</h3>
                    </div>
                   
<?php 
$kd_dosen = $_GET['kd_dosen'];

$query = mysql_query("select * from dosen where kd_dosen ='$kd_dosen'") or die(mysql_error());

$data = mysql_fetch_array($query);
?>

<form name="update_data" action="admin.php?p=updatedosen&kd_dosen1=<?php echo $data['kd_dosen1']; ?>" method="post">
  <div align="center">
  <input type="hidden" name="kd_dosen" value="<?php echo $kd_dosen; ?>" />
  <table border="0" cellpadding="5" cellspacing="0" class="table">
    <tbody>
      <tr>
        <td><div align="center"></div></td>
       	    <td></td>
       	    <td><input type="hidden" name="kd_dosen1" maxlength="20" required value="<?php echo $data['kd_dosen']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">Kode Dosen</div></td>
       	    <td>:</td>
       	    <td><input type="text" name="kd_dosen2" class="form-control" maxlength="20" required value="<?php echo $data['kd_dosen']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">Nama Dosen</div></td>
       	    <td>:</td>
       	    <td><input type="text" name="nm_dosen" class="form-control" maxlength="75" required value="<?php echo $data['nm_dosen']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">Telepon</div></td>
       	    <td>:</td>
       	    <td><input type="text" name="no_telp" class="form-control" maxlength="100" required value="<?php echo $data['no_telp']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">Email</div></td>
       	    <td>:</td>
       	    <td><input type="text" name="email" class="form-control" required value="<?php echo $data['email']; ?>" /></td>
          </tr>
      
      <tr>
        <td align="right" colspan="3"><div align="center">
          <input type="submit" name="submit" class="btn btn-success" value="Simpan" />
          </div></td>
          </tr>
      </tbody>
  </table>
          
              <?php        


					?>