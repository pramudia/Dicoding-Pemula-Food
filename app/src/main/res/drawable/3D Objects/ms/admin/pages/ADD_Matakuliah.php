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

                   </p>
                    
                    <p>
                    <div class="bg-color-red fg-color-white padding20">
                        <h3 class="fg-color-white">Tambah Data Matapelajaran.</h3>
                    </div>
                    <div class="border-color-red">.
                       <form name="in_matkul" action="../admin/pages/tambahmatkul.php" method="POST">
                   <table class="table">
                   <tbody>
                        <tr><td >Kode Matapelajaran</td><td >:</td><td class="right"><input type="text" class="form-control" name="kd_matkul" maxlength="5" /></td></tr>
                        <tr><td >Nama Pelajaran</td><td >:</td><td class="right"><input type="text" name="nm_matkul" class="form-control" maxlength="20"/></td></tr>
                        <tr><td >Kelas</td><td >:</td><td class="right"><input type="text" name="sks" class="form-control" maxlength="20"/></td></tr>
                        <tr><td >Semester </td><td >:</td><td</td><td class="right"><input type="text" class="form-control" name="semester" maxlength="20"/></td></tr>
                        <tr><td >Jumlah Pengambil </td><td >:</td><td</td><td class="right"><input type="text" class="form-control" name="jml_pngambil" maxlength="20"/></td></tr>
                        <tr class="error" ><td colspan="4" class="right">
                         <!--jquery ajax success button-->

                        <input type="submit" value="Submit" class="btn btn-success" /></td></tr>
                   </tbody>
                   <input type="hidden" name="MM_insert" value="input_data">
                      </form>
                    <tfoot></tfoot>
                </table>
                </div>
                   </p>

                    

                   

                    <h2><span class="label important">*</span> Format Pengisian</h2>

                    <p><strong>Matapelajaran:</strong></p>

                    <ul class="">
                        <li>Format Kode Matapelajaran : Isikan dengan Inisial Matapelajaran (Gunakan tanda Underscore &quot;_&quot;  sebagai spasi)</li>
                        <li>Nama Matapelajaran : ""</li>
                    </ul>

                    
                </div>
            </div>
            
            <!--------------------->

