
<?php
$dsn  = "mysql:dbname=ms;host=localhost";
$dbhost ="localhost";
$dbusername ="root";
$dbpassword ="";
$dbname ="ms";

//Koneksi dengan database di server
mysql_connect( $dbhost, $dbusername, $dbpassword) or die ("Koneksi gagal");
mysql_select_db($dbname) or die("Databse tidak bisa di buka");

try {
    $dbh = new PDO($dsn, $dbusername, $dbpassword);
} catch (PDOException $e) {
    echo "Koneksi ke database gagal: ".$e->getMessage();
}

?>