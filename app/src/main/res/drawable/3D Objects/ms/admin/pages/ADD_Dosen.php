<?php
ini_set("display_errors","off");
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

                   </p>
                    
                    <p>
                    <div class="bg-color-red fg-color-white padding20">
                        <h3 class="fg-color-white">Tambah Data Guru.</h3>
                    </div>
                    <div class="border-color-red">.
                       <form name="in_dosen" action="../admin/pages/proses_tambah.php" method="POST">
                   <table class="table">
                   <tbody>
                        <tr>
                          <td >Kode Guru</td>
                          <td >:</td>
                          <td class="right">
                            <div class="input-control text"><input type="text" class="form-control" name="kd_d" maxlength="5" /></div>
                          </td>
                        </tr>
                        <tr>
                          <td >Nama Guru</td><td >:</td><td class="right"><input type="text" class="form-control" name="nm_d" maxlength="50" /></td>
                        </tr>
                        <tr>
                          <td >Telepon </td><td >:</td><td class="right"><input type="text" class="form-control"  name="Telp" maxlength="13"/></td>
                        </tr>
                        <tr>
                          <td >Email </td><td >:</td><td class="right"><input type="text" class="form-control" name="email" maxlength="50"/></td>
                        </tr>
                        <tr class="error" ><td colspan="4" class="right" >
<!--jquery ajax success button-->
<!--script>
function myFunction()
{
alert("Data Dosen Berhasil Ditambahkan");
}
</script-->

                        <input type="submit" value="Submit" class="btn btn-success" /></td></tr>
                   </tbody>

                      </form>
                    <tfoot></tfoot>
                </table>
                </div>
                   </p>

                    

                  

                    <h2><span class="label important">*</span> Format Pengisian</h2>

                    <p><strong>Guru:</strong></p>

                    <ul class="">
                        <li>Format Kode Guru : Isikan dengan Inisial dosen (Gunakan tanda Underscore &quot;_&quot;  sebagai spasi)</li>
                        <li>Nama Guru : ""</li>
                        <li>No Telepon : "085XXXXXXXXX" (12/13 Digit Angka)</li>
						 <li>Email : abc@gmail.com </li>
                                              
                    </ul>

                    
                </div>
            </div>
            
            <!--------------------->
        </div>
            
        
   



