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
                    <div class="bg-color-orange fg-color-white padding20">
                        <h3 class="fg-color-white">Pencarian Data Jadwal.</h3>
                    </div>
                    
                    

<div class="input-control text">
<input type="text" />
<button class="btn-search"></button>
</div>
                            
                   <table >
                    <thead class="bg-color-orange">
                        <tr class="Weather">
                            <th>No</th>
                            <th class="right">Dosen</th>
                            <th class="right">MataKuliah</th>
                            <th class="right">Ruang</th>
                            <th class="right">Hari</th>
                            <th class="right">Jam</th>
                            <th class="right">Semester</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td class="right">GW</td>
                            <td class="right">PW</td>
                            <td class="right">D3.19</td> 
                            <td class="right">Rabu</td> 
                            <td class="right">1</td> 
                            <td class="right">1</td> 
                        <tr class="warning"><td>Ditemukan</td><td class="right" colspan="7">0,1 Mb</td></tr>
                    </tbody>

                    <tfoot></tfoot>
                </table>

                    
                </div>
            </div>
            
            <!--------------------->
