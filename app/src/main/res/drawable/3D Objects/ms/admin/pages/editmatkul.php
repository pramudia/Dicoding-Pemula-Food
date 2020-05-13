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
?>
<?php include("koneksi.php");?>

                   </p>
                    
                    <p>
                    <div class="bg-color-blue fg-color-white padding20">
                        <h3 class="fg-color-white">Data Matapelajaran.</h3>
                    </div>
                   
<?php 
$kd_matkul = $_GET['kd_matkul'];

$query = mysql_query("select * from matkul where kd_matkul ='$kd_matkul'") or die(mysql_error());

$data = mysql_fetch_array($query);
?>

<form name="update_data" action="admin.php?p=updatematkul" method="post">
  <div align="center">
  <input type="hidden" name="kd_matkul" value="<?php echo $kd_matkul; ?>" />
  <table border="0" cellpadding="5" cellspacing="0" class="table">
    <tbody>
      <tr>
        <td></td>
       	    <td></td>
       	    <td><input type="hidden" name="kd_matkul1" class="form-control" maxlength="20" required value="<?php echo $data['kd_matkul']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">Kode Matapelajaran</div></td>
       	    <td>:</td>
       	    <td><input type="text" name="kd_matkul2" class="form-control" maxlength="20" required value="<?php echo $data['kd_matkul']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">Nama Matapelajaran</div></td>
       	    <td>:</td>
       	    <td><input type="text" class="form-control" name="nm_matkul" maxlength="20" required value="<?php echo $data['nm_matkul']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">Kelas</div></td>
       	    <td>:</td>
       	    <td><input type="text" name="sks" class="form-control" maxlength="100" required value="<?php echo $data['sks']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">Semester</div></td>
       	    <td>:</td>
       	    <td><input type="text" name="semester" class="form-control" required value="<?php echo $data['semester']; ?>" /></td>
          </tr>
      <tr>
        <td><div align="left">Jumlah Pengambil</div></td>
       	    <td>:</td>
       	    <td><input type="text" name="jml_pengambil" class="form-control" required value="<?php echo $data['jml_pngambil']; ?>" /></td>
          </tr>
      <tr>
        <td align="right" colspan="3"><input type="submit" class="btn btn-success" name="submit" value="Simpan" /></td>
          </tr>
      </tbody>
  </table>
                
 