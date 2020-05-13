

<!-------------------------------------------------------------------------->
<div class="page-region">
<div class="page-region-content">
        

<?php
ini_set("display_errors","Off");
session_start(); //kuncinya ada disini, tulis diawal script sebelum menulis yang lain
?>

<?php
/*
session_is_registered() sebaiknya tidak digunakan (Deprecated Function)
if( session_is_registered( 'ID' ) || session_is_registered( 'PASS' ) )
*/
if( isset($_SESSION['ID']) || isset($_SESSION['PASS']) ) {
 //session_unregister( 'ID' ); Deprecated Function
 //session_unregister( 'PASS' ); Deprecated Function
 //unset( $ID, $PASS );
 
 // kembalikan variabel session ke kondisi null (kosong)
$_SESSION = array();
 
 // terakhir, hancurkan session
 session_destroy();
 
 echo "
		<script>
			alert ('ANDA TELAH KELUAR..!!!');
			location.href='../admin';
		</script>";
}
?>
                         </div>
                         </div>
                                
                                
                                
                        
