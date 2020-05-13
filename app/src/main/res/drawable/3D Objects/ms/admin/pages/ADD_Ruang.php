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
                   </p>
                    
                    <p>
                    <div class="bg-color-red fg-color-white padding20">
                        <h3 class="fg-color-white">Tambah Data Ruang.</h3>
                    </div>
                    <div class="border-color-red">.
                    <form name="in_ruang" action="../admin/pages/tambahruang.php" method="POST">
                   <table class="table">
                   <tbody>
                        <tr><td >Kode Ruang</td><td >:</td><td class="right"><input type="text" class="form-control" maxlength="10" name="kd_ruang"/></td></tr>
                        <tr><td >Kapasitas</td><td >:</td><td class="right"><input class="form-control" type="text" maxlength="20" name="kapasitas"/></td></tr>
					    <tr class="error" ><td colspan="4" class="right">
                      
                       <input type="submit" value="Submit" class="btn btn-success"/></td></tr>
                   </tbody>

                    <tfoot></tfoot>
                </table>
                
                    </form>
                </div>
                   </p>

                    


                    <h2><span class="label important">*</span> Format Pengisian</h2>

                    <p><strong>Ruang:</strong></p>

                    <ul class="">
                        <li>Format Kode Ruang :</li>
                        <li>Nama Ruang : ""</li>
                        <li>kapasitas</li>                       
                    </ul>

                    
                </div>
            </div>
            
            <!--------------------->

