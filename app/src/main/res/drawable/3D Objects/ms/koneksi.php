
<?php
$dbhost ="localhost";
$dbusername ="root";
$dbpassword ="";
$dbname ="ms";

//Koneksi dengan database di server
mysql_connect( $dbhost, $dbusername, $dbpassword) or die ("Koneksi gagal");
mysql_select_db($dbname) or die("Databse tidak bisa di buka");
?>