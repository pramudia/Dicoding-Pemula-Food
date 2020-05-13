  <?php include "koneksi.php"?>
 <table width="372" border="0">
   <tr>
     <td colspan="3" align="left" valign="top" bgcolor="#00FF99"><strong>Keterangan : </strong></td>
   </tr>
   <tr>
     <td bgcolor="#00FF99"><div align="left">Kode Guru </div></td>
     <td bgcolor="#00FF99">:</td>
     <td bgcolor="#00FF99"><div align="left">
       <select name ="kd_dosen" kd_dosen = "kd_dosen" onChange="pilih(this.value)">
         <option value="0" selected="selected">Lihat Kode Guru</option>
         <?php
   					// query untuk menampilkan semua jadwal
  					 $query = "SELECT * FROM dosen";
   					$hasil = mysql_query($query);
   					while ($data = mysql_fetch_array($hasil))
   {
      // setiap negara yang dibaca dari tabel disisipkan ke tag <option></option>
      	echo "<option value='".$data['kd_dosen']."'>".$data['kd_dosen']." = ".$data['nm_dosen']."</option>";
		
				}
					?>
       </select>
     </div></td>
   </tr>
   <tr>
     <td bgcolor="#00FF99"><div align="left">Kode Matakuliah</div></td>
     <td bgcolor="#00FF99">:</td>
     <td bgcolor="#00FF99"><div align="left">
       <select name ="kd_matkul">
         <option value="0" selected="selected">Lihat Kode Matakuliah</option>
         <?php
   					// query untuk menampilkan semua jadwal
  					 $query = "SELECT * FROM matkul";
   					$hasil = mysql_query($query);
   					while ($data = mysql_fetch_array($hasil))
   {
      // setiap negara yang dibaca dari tabel disisipkan ke tag <option></option>
      	echo "<option value='".$data['nm_matkul']."'>".$data['kd_matkul']." = ".$data['nm_matkul']."</option>";
   				}
					?>
       </select>
     </div></td>
   </tr>
</table>
