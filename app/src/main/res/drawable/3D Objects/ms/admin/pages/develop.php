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
                                <div class="tile double bg-color-teal" data-role="tile-slider" data-param-period="3000">
                                    <div class="tile-content">
                                        <h2>Dibuat oleh</h2>
                                        <h5>Kelompok Pemrograman Web</h5>
                                        <p>
                                           KELOMPOK 1    </p>
                                    </div>
                                    <div class="tile-content">
                                        <h2>Hubungi Kami di</h2>
                                        <h5>Naufal.syauqi@gmail.com atau <br />kzaack@gmail.com</h5>
                                        <p>
                                            </p>
                                    </div>
                                    <div class="brand">
                                        <div class="badge">12</div>
                                        <img class="icon" src="images/Mail128.png"/>
                                    </div>
                                </div>
                         </div>
                                
                                
                                
                                
                                
                            </div>
                            
