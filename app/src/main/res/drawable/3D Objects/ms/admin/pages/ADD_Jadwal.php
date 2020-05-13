<?php
ini_set("display_errors","Off");
session_start(); //kuncinya ada disini, tulis diawal script sebelum menulis yang lain
?>
<!-------------------------------------------------------------------------->
<link href="amit/css/style.css" rel="stylesheet" type="text/css" />

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
<?php
include ("koneksi.php");
?>
            
          </p>
                    
                    <p>
                    <div class="bg-color-red fg-color-white padding20">
                        <h3 class="fg-color-white">Tambah Data Jadwal.</h3>
                    </div>
                    <div class="border-color-red">.
                       <form name="in_matkul" action="../admin/pages/tambahjadwal.php" method="POST">
                   <table class="table">
                   <tbody>
                        <tr><td >Kode Matapelajaran</td><td >:</td><td class="left"><select class="form-control" name ="kd_matkul"><?php
   					// query untuk menampilkan semua jadwal
  					 $query = "SELECT * FROM matkul";
   					$hasil = mysql_query($query);
   					while ($data = mysql_fetch_array($hasil))
   {
      // setiap negara yang dibaca dari tabel disisipkan ke tag <option></option>
      	echo "<option value='".$data['kd_matkul']."'>".$data['kd_matkul']."</option>";
   				}
					?></select></div>
						</td></tr>
                        <tr><td >Kode Guru</td><td >:</td><td class="left"><select class="form-control" name ="kd_dosen"><?php
   					// query untuk menampilkan semua jadwal
  					 $query = "SELECT * FROM dosen";
   					$hasil = mysql_query($query);
   					while ($data = mysql_fetch_array($hasil))
   {
      // setiap negara yang dibaca dari tabel disisipkan ke tag <option></option>
      	echo "<option value='".$data['kd_dosen']."'>".$data['kd_dosen']."</option>";
   				}
					?></select></div></td></tr>
                        <tr><td >Kode Ruang</td><td >:</td><td class="left"><select class="form-control" name ="kd_ruang"><?php
   					// query untuk menampilkan semua jadwal
  					 $query = "SELECT * FROM ruang";
   					$hasil = mysql_query($query);
   					while ($data = mysql_fetch_array($hasil))
   {
      // setiap negara yang dibaca dari tabel disisipkan ke tag <option></option>
      	echo "<option value='".$data['kd_ruang']."'>".$data['kd_ruang']."</option>";
   				}
					?></select></div></td></tr>
               <tr><td >Jam</td><td >:</td><td</td><td class="right"><select class="form-control" name="jam" id="jam">
  <option value="I">I</option>
  <option value="II">II</option>
  <option value="III">III</option>
</select></div></td></tr>
                        <tr><td >Hari</td><td >:</td><td</td><td class="right"><select class="form-control" name="hari" id="hari">
  <option value="SENIN">SENIN</option>
  <option value="SELASA">SELASA</option>
  <option value="RABU">RABU</option>
  <option value="KAMIS">KAMIS</option>
  <option value="JUMAT">JUMAT</option>
  <option value="SABTU">SABTU</option>
</select></div></td></tr>
                        <tr><td >Kelas</td><td >:</td><td</td><td class="right"><select class="form-control" name="kelas" id="kelas">
  <option value="A1">A1</option>
  <option value="A2">A2</option>
  <option value="B1">B1</option>
  <option value="B2">B2</option>
</select></div></td></tr>
                        <tr><td >Waktu</td><td >:</td><td</td><td class="right"><select class="form-control" name="waktu" id="waktu">
  <option value="PAGI">PAGI</option>
  <option value="SORE">SORE</option>
</select></div></td></tr>
                        <tr><td >Tahun Ajaran</td><td >:</td><td</td><td class="right"><input class="form-control" type="text" name="thn_ajaran" maxlength="20"/></div></td></tr>
                        <tr class="error" ><td colspan="4" class="right">
                         <!--jquery ajax success button-->

                        <input type="submit" value="Submit" class="btn btn-success " /></td></tr>
                   </tbody>
                   <input type="hidden" name="MM_insert" value="input_data">
                      </form>
                    <tfoot></tfoot>
                </table>
                </div>
                   </p>

                    

                    <h2><span class="label important">*</span> Format Pengisian</h2>

                    <p><strong>Jadwal :</strong></p>

                    <ul class="">
                        <li>Pilih sesuai kode yang telah ada</li>
                        <li>Harap Jangan salah menginput Tahun Ajaran</li>
						<li>Harap Jangan ada form yang Dikosongi</li>
                    </ul>

                    
                </div>
</div>
            
            <!--------------------->

