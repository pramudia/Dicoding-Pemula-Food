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
           
<?php 
$id = $_GET['id'];

$query = mysql_query("select * from jadwal where id ='$id'") or die(mysql_error());

$data = mysql_fetch_array($query);
?>

<form name="update_data" action="admin.php?p=updatejadwal" method="post">
  <div align="center">
  <input type="hidden" name="kd_matkul" value="<?php echo $id; ?>" />
  <table border="0" cellpadding="5" cellspacing="0" class="table" >
    <tbody>
      <tr>
        <td></td>
        <td></td>
        <td><input type="hidden" name="id" maxlength="20" required value="<?php echo $data['id']; ?>" /></td>
        </tr>
      <tr>
        <td><div align="left">Kode MataKuliah</div></td>
        <td>:</td>
        <td><input type="text" name="kd_matkul2" class="form-control" maxlength="20" required value="<?php echo $data['kd_matkul']; ?>" /></td>
        </tr>
      <tr>
        <td><div align="left">Kode Dosen</div></td>
        <td>:</td>
        <td><input type="text" name="kd_dosen" class="form-control" maxlength="20" required value="<?php echo $data['kd_dosen']; ?>" /></td>
        </tr>
      <tr>
        <td><div align="left">Kode Ruang</div></td>
        <td>:</td> 
        <td><input type="text" name="kd_ruang" class="form-control" maxlength="20" required value="<?php echo $data['kd_ruang']; ?>" /></td>
        </tr>
      <tr>
        <td><div align="left">Jam</div></td>
        <td>:</td>
        <td><input type="text" name="jam" class="form-control" maxlength="100" required value="<?php echo $data['jam']; ?>" /></td>
        </tr>
      <tr>
        <td><div align="left">Hari</div></td>
        <td>:</td>
        <td><input type="text" name="hari" class="form-control" required value="<?php echo $data['hari']; ?>" /></td>
        </tr>
      <tr>
        <td><div align="left">Kelas</div></td>
        <td>:</td>
        <td><input type="text" name="kelas" class="form-control" required value="<?php echo $data['kelas']; ?>" /></td>
        </tr>
      <tr>
        <td><div align="left">Waktu</div></td>
        <td>:</td>
        <td><input type="text" name="waktu" class="form-control" maxlength="20" required value="<?php echo $data['waktu']; ?>" /></td>
        </tr>
      <tr>
        <td><div align="left">Tahun Ajaran</div></td>
        <td>:</td>
        <td><input type="text" name="thn_ajaran" class="form-control" maxlength="20" required value="<?php echo $data['thn_ajaran']; ?>" /></td>
        </tr>
      <tr>
        <td align="right" colspan="3"><input type="submit" class='btn btn-success' name="submit" value="Simpan" /></td>
        </tr>
      </tbody>
  </table>
